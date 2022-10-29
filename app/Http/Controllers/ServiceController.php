<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditServicesRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        return Service::all();
    }

    public function update(EditServicesRequest $request)
    {
        $data = $request->safe()->all()['services'];
        $data = array_reduce($data, function($arr, $d) {
            $arr[$d['id']] = $d['price'];
            return $arr;
        }, array());
        $services = Service::query()->whereIn('id', array_keys($data))->get();

        DB::transaction(function() use ($data, $services) {
            foreach ($data as $id => $price){
                $service = $services->find($id);
                $service->price = $price;
                $service->save();
            }
        });

        return response(null, 204);
    }
}
