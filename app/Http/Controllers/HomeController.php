<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditServicesRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::user()?->admin){
            $lastOrders = Order::with(['paymentType', 'orderStatus'])->orderBy('date', 'desc')->limit(5)->get();
            $nonAvailableProducts = Product::with('category')->where('amount', 0)->limit(5)->get();
            $services = Service::all();

            return view('home_admin', ['lastOrders' => $lastOrders, 'nonAvailableProducts' => $nonAvailableProducts, 'services' => $services]);
        }

        return view('home');
    }

    public function editServices(EditServicesRequest $request) {
        $services = Service::all();
        $assembly = $services->find('assembly');
        $assembly->price = $request->input('assembly');
        $assembly->save();
        $osInstallation = $services->find('os_installation');
        $osInstallation->price = $request->input('os_installation');
        $osInstallation->save();

        $request->session()->flash('success', 'Zapisano zmiany');

        return redirect()->route('home');
    }
}
