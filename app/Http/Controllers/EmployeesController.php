<?php

namespace App\Http\Controllers;

use App\Connected;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TADPHP\TAD;
use TADPHP\TADFactory;

class EmployeesController extends Controller
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

    /**
     * Retreives the employes from DB
     * @return mixed View for the Employees page
     */
    public function index()
    {

        // $all_users = Employee::all();
        $all_users = Employee::where('device_id', $this->connected_device['device_id'])->get();

        return view('pages.employees', compact('all_users'));
    }

    public function getAllEmployees()
    {
        $all_users = [];

        if ($this->tad && $this->tad->is_alive()) {
            $all_user_info = $this->tad->get_all_user_info()->to_array();
            $all_users = $all_user_info['Row'];
        }

        return $all_users;
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $password = $request->input('password');
        $card = ($request->input('card') == "") ? 0 : $request->input('card');
        $name = $request->input('name');

        $all_users = Employee::where('device_id', $this->connected_device['device_id'])->orderBy('pin')->get();

        $next_pin = $this->unused_id($all_users);

        // send the employee to device and store it
        $this->tad->set_user_info([
            "pin" => $next_pin,
            "password" => $password,
            'card' => $card,
            'name' => $name,
            "group" => "1",

        ]);

        // store the employee to DB
        $employee = Employee::create([
            'pin' => $next_pin,
            'name' => $name,
            'device_id' => $this->connected_device['device_id'],
            'password' => $password,
            'card' => $card]
        );

        $employee->save();

        return redirect()->action('EmployeesController@index');
    }

    public function unused_id($arr)
    {
        $i = 1;
        $unused = 1;
        foreach ($arr as $user) {
            if (intval($user["pin"]) != $i) {
                $unused = $i;
                break;
            }
            $unused++;
            $i++;
        }
        return $unused;
    }
}
