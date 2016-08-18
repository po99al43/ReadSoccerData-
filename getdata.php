<?php
header("content-type: text/html; charset=utf8");

require_once("connect.php");

$type = true;
ignore_user_abort($type);//關掉瀏覽器，PHP腳本也可以繼續執行.

set_time_limit(0);// 通過set_time_limit(0)可以讓程式無限制的執行下去

$interval=60;//設定運行1分鐘

do {

    //設定url
    $url = "http://www.228365365.com/app/member/FT_browse/body_var.php?uid=test00&rtype=r&langx=zh-cn&mtype=3&delay=&league_id=";
    $ch = curl_init();

    //先取得所需要的cookie
    curl_setopt($ch, CURLOPT_URL,"http://www.228365365.com/sports.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_exec($ch);

    //傳回cookie取得所需要的資料
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch, CURLOPT_HEADER, 0);

    //執行，取回 response 結果存入text.txt中
    $pageContent = curl_exec($ch);
    $fo = fopen ('text.txt' , 'w');
    fwrite ($fo, $pageContent );

    //關閉與釋放資源
    curl_close($ch);
    fclose($fo);

    //將text.txt讀出並做解析
    $fo = fopen ('text.txt', 'r' );
    $result;
    while (! feof($fo)) {
        $line = fgets($fo);
        if(preg_match("/parent.GameFT/",$line)) {
            $line = str_replace("parent.","$",$line);
            $line = str_replace("new ","",$line);
            $line = str_replace("<br>","",$line);
            $line = str_replace("<font color=red>Running Ball</font>","",$line);
            $result .= $line;
        }
    }

    //對解析內容做php語法判斷
    eval($result);

    fclose($fo);

    //判斷是否有解析後的內容
    if ($GameFT) {
    //將內容寫進資料庫
    $conn = new Connect();
    $conn->savegame($GameFT);
    }

    sleep($interval);// 等待1分鐘
} while (true);




