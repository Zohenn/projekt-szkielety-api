<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CartController extends Controller {
    public function index(Request $request) {
        $cartItems = $request->session()->get('cart.items');
        $assembly = $request->session()->get('cart.assembly');
        $osInstallation = $request->session()->get('cart.osInstallation');
        $cartProducts = Product::query()->whereIn('id', $cartItems)->get();
        $cartValue = array_reduce($cartProducts->toArray(), function($acc, array $item) {
            return $acc + $item['price'];
        }, 0);
        $services = Service::all();
        $orderValue = $cartValue + ($assembly ? $services->find('assembly')->price : 0) + ($osInstallation ? $services->find('os_installation')->price : 0);
        return view('cart.index', [
            'cartProducts' => $cartProducts,
            'cartValue' => $cartValue,
            'orderValue' => $orderValue,
            'paymentTypes' => PaymentType::all(),
            'services' => $services,
        ]);
    }

    private function validateAddRemove(Request $request, $add = false) {
        $validation = Validator::make($request->all(), [
            'id' => [
                'required',
                'numeric',
                function($attribute, $value, $fail) use ($add) {
                    $product = Product::find($value);
                    if (!$product || ($add && $product->amount === 0)) {
                        $fail();
                    }
                }
            ],
        ]);

        return !$validation->fails();
    }

    public function add(Request $request) {
        if (!$this->validateAddRemove($request, true)) {
            throw new BadRequestHttpException();
        }

        $id = intval($request->input('id'));

        $request->session()->push('cart.items', $id);

        return response('', 200);
    }

    public function remove(Request $request) {
        if (!$this->validateAddRemove($request)) {
            throw new BadRequestHttpException();
        }

        $id = intval($request->input('id'));

        $index = array_search($id, $request->session()->get('cart.items'));

        if ($index !== false) {
            $items = $request->session()->pull('cart.items');
            unset($items[$index]);
            $request->session()->put("cart.items", $items);
        }

        return response('', 200);
    }

    public function services(Request $request) {
        $assembly = $request->input('assembly');
        $osInstallation = $request->input('osInstallation');
        if ($assembly !== null && ($assembly == 1 || $assembly == 0)) {
            $request->session()->put('cart.assembly', $assembly);
            Log::info($request->session()->get('cart'));
            return response('', 200);
        } else if ($osInstallation !== null && ($osInstallation == 1 || $osInstallation == 0)) {
            $request->session()->put('cart.osInstallation', $osInstallation);
            Log::info($request->session()->get('cart'));
            return response('', 200);
        }

        throw new BadRequestHttpException;
    }
}
