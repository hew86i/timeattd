<?php 

public function storeLogsAll()
    {
    	// DB::connection()->disableQueryLog();
    	// get the device_id from the device table
    	$device = null; //Device::where('ip_address', $this->connected_device['ip_address'])->first();

    	// request object here
    	$all_logs = $_POST['logs'];
    	// dd(($all_logs));
    	$log = new Log();

    	// get the last entery for the specified device and convert its datetime to Carbon
    	// $last_log = Log::where('device_id',$device->id)->orderBy('id','desc')->first();
    	$last_log = Log::where('device_id',2)->orderBy('id','desc')->first();
    	$last_log_datetime = Carbon::now()->addDays(-1);
    	if($last_log)
    	{
    		$last_log_datetime = Carbon::parse($last_log->datetime);
    	};

		//A single array with all your CSV data
		// $products;
		//Number of rows to insert per query
		$rowsPerChunk = 50;

		$all_logsChunks = array_chunk($all_logs, $rowsPerChunk);
		// dd($all_logsChunks);
		foreach($all_logsChunks as $chunk) {
			// var_dump($chunk[0][0]);
		    DB::table('logs')->insert($chunk);
		}
		// var_dump($all_logs);
		// DB::table('logs')->insert($all_logs);
		// foreach($all_logs as $log_ent) {
		//     DB::table('logs')->insert($log_ent);
		// 	// dd($log_ent);
		// }
		// dd($all_logs);

		// foreach ($all_logs as $log_ent)
		// {
		// 	if(1) //$last_log_datetime->lt(Carbon::parse($log_ent['DateTime']))
		// 	{
		// 		$log->create([
		// 				'emp_id' => $log_ent['PIN'],
		// 				'datetime' => $log_ent['DateTime'],
		// 				'verified' => $log_ent['Verified'],
		// 				'status' => $log_ent['Status'],
		// 				'workcode' => $log_ent['WorkCode'],
		// 				'device_id' => 2
		// 			]);
		// 	}
		// }
		// return "ok";
    }