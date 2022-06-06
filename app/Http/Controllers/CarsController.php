<?php

namespace App\Http\Controllers;

use App\Services\Cars\Cars;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarsController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('vehicles.index');
    }

    /**
     * @param Request $request
     * @param Cars $cars
     * @return array
     */
    public function list(Request $request, Cars $cars)
    {
        if (!$request->has('make')) {
            return $cars->getCars();
        }

        return $cars->getCars($request->input('make'));
    }

    /**
     * @param Request $request
     * @param $id
     * @param Cars $cars
     * @return array|mixed
     */
    public function show(Request $request, $id, Cars $cars)
    {
        return $cars->getCar($id, $request->input('token'));
    }
}
