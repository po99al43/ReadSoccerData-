<?php

require_once("connect.php");

$type = true;
ignore_user_abort();//關掉瀏覽器，PHP腳本也可以繼續執行.

set_time_limit(0);// 通過set_time_limit(0)可以讓程式無限制的執行下去

$interval=120;//設定運行1分鐘

do {

    $conn = new Connect;
    $alldat = $conn->getgame();

    $mc = new Memcached();
    $mc->addServer("localhost", 11211);

    $mc->set("data", json_encode($alldat));
    sleep($interval);// 等待1分鐘

} while (true);
