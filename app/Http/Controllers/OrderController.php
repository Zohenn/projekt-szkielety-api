<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Cart;
use App\Http\Requests\SaveOrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller {
    public function index(Request $request) {
        if (Auth::user()->admin) {
            $orders = Order::with(['paymentType', 'orderStatus']);
            $orderStatusIds = $request->query('orderStatus');
            if (!empty($orderStatusIds)) {
                $orders = $orders->whereIn('order_status_id', $orderStatusIds);
            }
            $paymentTypeIds = $request->query('paymentType');
            if (!empty($paymentTypeIds)) {
                $orders = $orders->whereIn('payment_type_id', $paymentTypeIds);
            }

            $sortOptions = ['date', 'value'];
            $sort = $request->query('sort');
            $sortDir = $request->query('sort_dir') === 'desc' ? 'desc' : 'asc';
            if(in_array($sort, $sortOptions)){
                $orders = $orders->orderBy($sort, $sortDir);
            } else {
                $orders = $orders->orderBy('id', 'desc');
            }

            $orders = $orders->paginate(20);
            return view('orders.admin', ['orders' => $orders, 'orderStatuses' => OrderStatus::all(), 'paymentTypes' => PaymentType::all()]);
        }

        $orders = Order::with(['paymentType', 'orderStatus', 'details', 'details.product'])
                       ->where('user_id', $request->user()->id)
                       ->orderBy('date', 'desc')
                       ->paginate(5);

        return $orders;
    }

    public function details(Request $request, $id) {
        $order = Order::with(['paymentType', 'orderStatus', 'details', 'details.product'])->findOrFail($id);

        $orderStatuses = OrderStatus::query()->where('id', '!=', $order->order_status_id)->get();

        return view('orders.details', ['order' => $order, 'orderStatuses' => $orderStatuses]);
    }

    public function changeStatus(Request $request, $id, $status) {
        $order = Order::findOrFail($id);

        $orderStatus = OrderStatus::findOrFail($status);

        $order->orderStatus()->associate($orderStatus);
        $order->save();

        return redirect()->route('order.details', ['id' => $id]);
    }

    public function create(SaveOrderRequest $request) {
        $data = $request->safe()->all();
        $data['user_id'] = $request->user()->id;
//        $cart = $request->session()->get('cart');
//        $data['assembly'] = $cart['assembly'];
//        $data['os_installation'] = $cart['osInstallation'];

        $services = Service::all();
        $products = Product::query()->whereIn('id', $data['products'])->get();
        foreach($products as $product){
            if($product->amount === 0){
//                $request->session()->flash('error', "Produkt $product->name nie jest dostępny na stanie.");
//                return redirect()->route('cart.index');
                return response()->json([
                    'message' => "Produkt $product->name nie jest dostępny na stanie.",
                ], 422);
            }
        }
        $data['value'] = array_reduce($products->toArray(), function($sum, $product) {
                return $sum + $product['price'];
            }, 0) + ($data['assembly'] ? $services->find('assembly')->price : 0) + ($data['os_installation'] ? $services->find('os_installation')->price : 0);

        $order = null;
        DB::transaction(function() use ($products, $data, $order) {
            $order = Order::create($data);

            $orderDetails = array_map(function($product) use ($order) {
                return new OrderDetail(['order_id' => $order->id, 'product_id' => $product['id'], 'price' => $product['price']]);
            }, $products->toArray());

            $order->details()->saveMany($orderDetails);

            foreach ($products as $product) {
                $product->amount--;
                $product->save();
            }
        });

//        $request->session()->put('cart', Cart::getEmptyCart());

        return response()->json($order, 201);
    }

    public function last() {
        return Order::with(['paymentType', 'orderStatus'])->orderBy('date', 'desc')->limit(5)->get();
    }
}
