<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use TADPHP\TADFactory;
use TADPHP\TAD;
use App\Device;
use App\Connected;
use Cache;

class DeviceController extends Controller
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

        if ($this->connected_device['connected'] == 1) {
            $tadf = new TADFactory(['ip' => $this->connected_device['ip_address']]);
            $this->tad = $tadf->get_instance();
        } else {
            $this->tad = null;
        }
    }

    // needs further work...
    public function connectToIp($ip = '127.0.0.1')
    {
        $tadf = new TADFactory(['ip' => $ip]);
        $this->tad = $tadf->get_instance();

        $status = $this->tad->is_alive();

        $device = Device::where('ip_address', $ip)->first();

        $connected_device = Connected::find(1);

        $connected_device->ip_address = $ip;
        $connected_device->device_id = $device->id;
        if ($status) {
            $connected_device->connected = 1;
        } else {
            $connected_device->connected = 0;
        }
        $connected_device->save();

        return array($status);
    }

    public function addNewDevice(Request $request)
    {
        //store device in database

        $inputDeviceName = $request->input('inputDeviceName');
        $inputDeviceIP = $request->input('inputDeviceIP');
        $inputDeviceComPass = $request->input('inputDeviceComPass');

        $device = Device::create(['device_name' => $inputDeviceName, 'ip_address' => $inputDeviceIP, 'com_key' => $inputDeviceComPass]);

        $device->save();

        return redirect()->action('HomeController@index');
    }

    /**
     * Checks the list of all devices and return 1 if the device
     * with the specified ip is found, or 0 othewise
     * @param  string $ip - ip address to search
     * @return integer $result - the result of the operation
     */
    public function checkIp($ip)
    {
        $result = Device::all()->where('ip_address', $ip)->count();

        return $result;
    }

    public function showInfo()
    {
        return view('pages.logs');
    }
}
