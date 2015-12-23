<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Device;
use App\Connected;
use TADPHP\TADFactory;
use TADPHP\TAD;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Device::all();
        $connected_device = Device::find(1);

        if (Connected::find(1) == null) {
            $connected_device = Connected::Create(['ip_address' => '127.0.0.1', 'device_id' => 0, 'connected' => 0]);
        }
        $connected_device = Connected::find(1);
        return view('pages.home', compact('devices', 'connected_device'));
        // ->with(['devices' => $devices, 'conne']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pin = $request->input('PIN');
        $password = $request->input('password');
        $card = $request->input('card');
        $name = $request->input('name');

        $tadf = app()->make('TADF', [['ip'=>'192.168.0.201']]);
        $tad = $tadf->get_instance();

        $tad->set_user_info([
                "pin" => $pin,
                "password" => $password,
                'card' => $card,
                'name' => $name,
                "group" => "1",

            ]);

        return redirect()->action('HomeController@index');
    }
}
