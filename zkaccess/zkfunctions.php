<?php

function zk()
{
    $zk = new COM("zkemkeeper.ZKEM");

    $ip = "192.168.0.201";

    if ($zk->Connect_Net($ip, 4370)) {
        echo "connected" . "<br>";
    }

    $ip_addr = "ip:";
    $mac = "mac:";

    $zk->ACUnlock(1, 2000);
    $zk->GetDeviceIP(1, $ip_addr);
    $zk->GetDeviceMAC(1, $mac);

    echo $ip_addr . " " . $mac;
}
