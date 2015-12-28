<?php

namespace App\Http\Controllers;

use App\Connected;
use App\Device;
use App\Http\Controllers\Controller;
use App\Zkaccess\zkcom;

class PagesController extends Controller
{
    /**
     * [$tad description]
     * @var object Holds the TAD object
     */
    private $tad;

    /**
     * [$connected_device description]
     * @var array Holds the connected device table
     */
    private $connected_device;

    /**
     * Here is the inicialization of the tad object depending
     * on the connected table state.
     */
    public function __construct()
    {
        $this->connected_device = Connected::find(1);
    }

    public function logs()
    {
        $zk = new zkcom();
        return view("pages.logs", compact('zk'));
    }

}

// $logs = DB::table('logs')
//     ->where('datetime', '>=', '2015-12-01 08:00:00')
//     ->where('datetime', '<=', '2015-12-04 18:00:00')
//     ->join('devices', 'logs.device_id', '=', 'devices.id')
//     ->join('employees', function ($join) {
//         $join->on('logs.emp_id', '=', 'employees.pin')
//             ->where('employees.device_id', '=', 2)
//         ;})
//     ->where('logs.device_id', '=', 2)
//     ->select('logs.id', 'employees.name', 'logs.datetime', 'logs.status', 'logs.workcode', 'devices.device_name')
//     ->orderBy('logs.id', 'desc')
//     ->get();

// $logs = DB::table('logs')->where('datetime', '>', '2015-12-01')->where('datetime', '<=', '2015-12-02')->join('devices', 'logs.device_id','=', 'devices.id')->join('employees', function($join){$join->on('logs.emp_id', '=', 'employees.pin')->where('employees.device_id', '=', $this->connected_device['device_id']);})->where('logs.device_id', '=', $this->connected_device['device_id'])->select('logs.id','employees.name','logs.datetime', 'logs.status','logs.workcode', 'devices.device_name')->orderBy('logs.id', 'desc')->get();

// $logs = DB::table('logs')->where('datetime', '>=', '2015-12-01 08:00:00')->where('datetime', '<=', '2015-12-04 18:00:00')->join('devices', 'logs.device_id','=', 'devices.id')->join('employees', function($join){$join->on('logs.emp_id', '=', 'employees.pin')->where('employees.device_id', '=', 2);})->where('logs.device_id', '=', 2)->select('logs.id','employees.name','logs.datetime', 'logs.status','logs.workcode', 'devices.device_name')->orderBy('logs.id', 'desc')->count()
