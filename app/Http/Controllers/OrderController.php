<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeOrderStatusRequest;
use App\Http\Requests\SaveOrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderService;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller {
    public function index(Request $request) {
        if ($request->user()->admin) {
            $orders = Order::with(['paymentType', 'orderStatus']);
            $orderStatusIds = $request->query('order_status');
            if (!empty($orderStatusIds)) {
                $orders = $orders->whereIn('order_status_id', $orderStatusIds);
            }
            $paymentTypeIds = $request->query('payment_type');
            if (!empty($paymentTypeIds)) {
                $orders = $orders->whereIn('payment_type_id', $paymentTypeIds);
            }

            $sortOptions = ['date', 'value'];
            $sort = $request->query('sort');
            $sortDir = $request->query('sort_dir') === 'desc' ? 'desc' : 'asc';
            if (in_array($sort, $sortOptions)) {
                $orders = $orders->orderBy($sort, $sortDir);
            } else {
                $orders = $orders->orderBy('id', 'desc');
            }

            $orders = $orders->paginate(20);
            return $orders;
        }

        $orders = Order::with([
            'paymentType',
            'orderStatus',
            'details',
            'details.product',
            'services',
            'services.service'
        ])->where('user_id', $request->user()->id)->orderBy('date', 'desc')->paginate(5);

        return $orders;
    }

    public function show(Request $request, $id) {
        return Order::with(['paymentType', 'orderStatus', 'details', 'details.product', 'services', 'services.service'])
                    ->findOrFail($id);
    }

    public function changeStatus(ChangeOrderStatusRequest $request, $id) {
        $order = Order::with([
            'paymentType',
            'orderStatus',
            'details',
            'details.product',
            'services',
            'services.service'
        ])->findOrFail($id);

        $status = $request->input('status');

        $orderStatus = OrderStatus::findOrFail($status);

        $order->orderStatus()->associate($orderStatus);
        $order->save();

        return $order;
    }

    public function store(SaveOrderRequest $request) {
        $data = $request->safe()->all();
        $data['user_id'] = $request->user()->id;

        $services = Service::query()->whereIn('id', $data['services'])->get();
        $products = Product::query()->whereIn('id', $data['products'])->get();
        foreach ($products as $product) {
            if ($product->amount === 0) {
                return response()->json([
                    'message' => "Produkt $product->name nie jest dostępny na stanie.",
                ], 422);
            }
        }
        $data['value'] = array_reduce($products->toArray(), function($sum, $product) {
                return $sum + $product['price'];
            }, 0) + array_reduce($services->toArray(), function($sum, $service) {
                return $sum + $service['price'];
            }, 0);

        $order = null;
        DB::transaction(function() use ($products, $services, $data, $order) {
            $order = Order::create($data);

            $orderDetails = array_map(function($product) use ($order) {
                return new OrderDetail([
                    'order_id' => $order->id,
                    'product_id' => $product['id'],
                    'price' => $product['price']
                ]);
            }, $products->toArray());

            $order->details()->saveMany($orderDetails);

            $orderServices = array_map(function($service) use ($order) {
                return new OrderService([
                    'order_id' => $order['id'],
                    'service_id' => $service['id'],
                ]);
            }, $services->toArray());

            $order->services()->saveMany($orderServices);

            foreach ($products as $product) {
                $product->amount--;
                $product->save();
            }
        });

        return response()->json($order, 201);
    }

    public function last() {
        return Order::with(['paymentType', 'orderStatus'])->orderBy('date', 'desc')->limit(5)->get();
    }
}
