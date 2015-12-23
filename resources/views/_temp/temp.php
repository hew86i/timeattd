<?php

/**
 * Se koristi za dobivanje na narednoto slobodno id
 * mora da bide sortirana nizata za da se dobijat
 * pravilni rezultati
 *
 * @param   $arr niza od useri koi sodrzat PIN
 * @return \Illuminate\Http\Response
 */
public function unused_id($arr)
{
    $i=1;
    $unused = 1;
    foreach ($arr as $user) {

        if(intval($user["PIN"]) != $i)
        {
            $unused = $i;
            break;
        }
        $unused++;
        $i++;
    }
    return $unused;
}

// $app = app();
        // $tadf = $app->make('TADF',[['ip' => $first_device->ip_address]]);
        // $tad = $tadf->get_instance();

        $dev_status = $tad->is_alive();

        if($dev_status){
            // get all users info
            $all_users_info = $tad->get_all_user_info()->to_array();
            asort($all_users_info['Row']);
            $next_pin = $this->unused_id($all_users_info['Row']);
        }
        $status = ($dev_status) ? "Online" : "Offline";

        if($dev_status == true) {
            return view('pages.home')->with(['tad' => $tad,
                                             'user_info' => $all_users_info['Row'],
                                             'next_pin' => $next_pin,
                                             'status' => $status,
                                             'devices' => $devices],
                                             'dev_status');
        }
            return view('pages.home')->with(['status' => $status, 'ip' => $tad->get_ip(), 'devices' => $devices]);


}

    // $('#btn_save_new_device').click(function() {
    //  $.ajax({
    //         type: "POST",
    //         url: "/device/add",
    //         // async: false,
    //         crossDomain: true,
    //         data:{'inputDeviceName':$('.modal #inputDeviceName').val(),
    //            'inputDeviceIP':$('.modal #inputDeviceIP').val(),
    //            'inputDeviceComPass':$('.modal #inputDeviceComPass').val()},
    //         success : function(data) {
    //          // console.log(data);
    //          $("#add-new-device").modal('toggle');
    //         }
    //     });
    // });

    $("#a_get_today_logs").click(function(){
        $.ajax({
            type: "GET",
            url: "/api/get/record/today-html",
            async: false,
            success : function(data) {
                // console.log(data);
                $('#get-all-data > tbody').html(data);
            }
        });
    });

    $("#a_get_24h_logs").click(function(){
        $.ajax({
            type: "GET",
            url: "/api/get/record/24h-html",
            async: false,
            success : function(data) {
                // console.log(data);
                $('#get-all-data > tbody').html(data);
            }
        });
    });