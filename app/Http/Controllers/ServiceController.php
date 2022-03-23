<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditServicesRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return Service::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(EditServicesRequest $request)
    {
        $services = Service::all();
        $assembly = $services->find('assembly');
        $assembly->price = $request->input('assembly');
        $assembly->save();
        $osInstallation = $services->find('os_installation');
        $osInstallation->price = $request->input('os_installation');
        $osInstallation->save();

        return response(null, 204);
    }

    public function destroy($id)
    {
        //
    }
}
