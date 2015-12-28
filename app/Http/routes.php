<?php

// Authentication routes...
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/login', 'Auth\AuthController@getLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

// Route::controller('auth', 'Auth\AuthController');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index');
    Route::post('/', 'HomeController@store');
    Route::get('/employess', 'EmployeesController@index');
    Route::post('/employess', 'EmployeesController@store');
    Route::get('/logs', 'PagesController@logs');

    Route::get('connect/device', 'DeviceController@init_object');
    Route::post('device/add', 'DeviceController@addNewDevice');
    Route::get('device/add', 'DeviceController@showInfo');
    Route::get('connect/{ip}', 'DeviceController@connectToIp'); // store connection info to DB
    Route::post('device/check-ip/{ip}', 'DeviceController@checkIp');

/**
 * ------ API routes -------------
 */
    Route::group(['prefix' => 'api'], function () {

        // this route returns unsorted data from the device
        Route::get('get/record/', 'ApiController@getAll');
        Route::get('get/record/bigdata', 'ApiController@getBig');

        Route::get('get/employees/', 'EmployeesController@getAllEmployees');

        Route::get('get/record/all', 'ApiController@getRecordAll')->name('allRecords');
        Route::get('get/record/all-html', 'ApiController@getRecordAllHtml')->name('allRecordsHtml');

        Route::get('get/record/today', 'ApiController@getRecordToday')->name('recordToday');
        Route::get('get/record/today-html', 'ApiController@getRecordTodayHtml')->name('recordTodayHtml');

        Route::get('get/record/24h', 'ApiController@getRecord24h')->name('record24h');
        Route::get('get/record/24h-html', 'ApiController@getRecord24hHtml')->name('Record24hHtml');
    });

/**
 * ------ API routes -------------
 */

/**
 * ------ Database routes -------------
 */
    Route::group(['prefix' => 'db'], function () {

        Route::post('store/logs/all', 'DatabaseController@storeLogsAll');
        Route::get('get/device/all-html', 'DatabaseController@getDeviceAllHtml');

        Route::post('store/employees/all', 'DatabaseController@storeEmployeesAll');

        Route::get('/date/{from}/{to}', 'DatabaseController@getLogsFromTo');
    });

});

Route::get('/tad', function () {

    $options = ['ip' => '192.168.0.201', 'udp_port' => 4370, 'connection_timeout' => 2];
    $zk = new TADPHP\Providers\TADZKLib($options);

    return $zk->get_commands_available();
    $zk->connect();
// dd(hex2bin("70"));
    return $zk->send_command_to_device(31, 'aa');

});

/**
 * PDF test route. Will use latter in app
 */
Route::get('/pdf', function () {

    $pdf = PDF::loadHTML('<h1>Test PDF</h1>');
    return $pdf->loadHTML('<h1>Test PDF</h1>')->setPaper('a4')->setOrientation('portrait')->setWarnings(false)->stream();

});

Route::get('/tt', function () {

    $tadf = new TADPHP\TADFactory(['ip' => '192.168.0.201']);
    $tad = $tadf->get_instance();

    return $fs = $tad->get_free_sizes()->to_array();

});

// ZKCOM Demo
Route::get('zkcom', function () {
    $zk = new zkcom();
    $zk->init();
    // $zk->RestartDevice();
});
