<?php

namespace App\Http\Controllers;

use App\Connected;
use App\Device;
use App\Employee;
use App\Http\Controllers\Controller;
use App\LastLog;
use App\Log;
use DB;
use TADPHP\TAD;
use TADPHP\TADFactory;

class DatabaseController extends Controller
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
     * This method gets the POST data and stores in chunks. Comparation
     * is made so that only new records are stored in DB. Also, the last
     * log's id, datetime and device_id is stored to DB.
     * @return null or string for javascript if it need futher handling
     */
    public function storeLogsAll()
    {
        DB::connection()->disableQueryLog();
        // request object here
        $all_logs = (isset($_POST["logs"]) && !empty($_POST["logs"])) ? $_POST["logs"] : [];

        if (empty($all_logs)) {
            return null;
        }
        //Number of rows to insert per query
        $rowsPerChunk = 100;
        $last_log;

        $all_logsChunks = array_chunk($all_logs, $rowsPerChunk);
        $i = 0;
        foreach ($all_logsChunks as $chunk) {
            $i++;
            if ($i == count($all_logsChunks)) {
                $last_log = array_pop($chunk);
                DB::table('logs')->insert($chunk);
                $last_log['log_id'] = DB::table('logs')->insertGetId($last_log);
            } else {
                DB::table('logs')->insert($chunk);
            }
        }
        if (isset($last_log)) {
            LastLog::create(['datetime' => $last_log['datetime'],
                'log_id' => $last_log['log_id'],
                'device_id' => $last_log['device_id'],
            ]);
        }

        return "ima zapisi";
    }

    /**
     * This method stores only new employess to DB.
     * @return null [description]
     */
    public function storeEmployeesAll()
    {
        DB::connection()->disableQueryLog();

        $all_emp = (isset($_POST["emp"]) && !empty($_POST["emp"])) ? $_POST["emp"] : [];

        if (empty($all_emp)) {
            return null;
        }

        foreach ($all_emp as $emp) {

            $values = ['pin' => $emp['PIN'],
                'name' => array_key_exists("Name", $emp) ? $emp['Name'] : "",
                'device_id' => $this->connected_device['device_id'],
                'password' => array_key_exists("Password", $emp) ? substr($emp['Password'], 0, 5) : "", // to check fro zk responce
                'card' => $emp['Card'],
                'group' => $emp['Group'],
                'privilege' => $emp['Privilege'],
                'pin2' => $emp['PIN2'],
                'tz1' => $emp['TZ1'],
                'tz2' => $emp['TZ2'],
                'tz3' => $emp['TZ3'],
            ];

            if (Employee::where('pin', $emp['PIN'])->where('device_id', $this->connected_device['device_id'])->first()) {
                echo "pin:" . $emp['PIN'] . "   ";
                Employee::where('pin', $emp['PIN'])->where('device_id', $this->connected_device['device_id'])
                    ->update($values);
            } else {
                echo "new pin:" . $emp['PIN'] . "   ";
                Employee::Create($values);
            }

        }

        return "ok";
    }

    public function getLogsFromTo($from, $to)
    {
        $logs = DB::table('logs')
            ->where('datetime', '>=', $from)
            ->where('datetime', '<=', $to)
            ->join('devices', 'logs.device_id', '=', 'devices.id')
            ->join('employees', function ($join) {
                $join->on('logs.emp_id', '=', 'employees.pin')
                    ->where('employees.device_id', '=', $this->connected_device['device_id']);})
            ->where('logs.device_id', '=', $this->connected_device['device_id'])
            ->select('logs.id', 'employees.name', 'logs.datetime', 'logs.status', 'logs.workcode', 'devices.device_name')
            ->orderBy('logs.id', 'desc')
            ->get();

        return $logs;
        // return Response::json($logs);
    }

    public function getDeviceAllHtml()
    {
        $devices = Device::all();
        $i = 1;
        foreach ($devices as $row) {
            echo '<tr>' .
            '<td>' . $i++ . '</td>' .
                '<td>' . $row['id'] . '</td>' .
                '<td>' . $row['device_name'] . '</td>' .
                '<td>' . $row['ip_address'] . '</td>' .
                '<td>' . $row['soap_port'] . '</td>' .
                '</tr>';
        }
    }
}
