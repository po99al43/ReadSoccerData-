<?php
header("content-type: text/html; charset=utf8");

require_once("connect.php");

// ignore_user_abort();//關掉瀏覽器，PHP腳本也可以繼續執行.

// set_time_limit(0);// 通過set_time_limit(0)可以讓程式無限制的執行下去

$interval=60;// 每隔半小時運行

// do {
    $agent = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';

    $ch = curl_init();

    //設定 / 調
    //curl_setopt($ch, CURLOPT_URL, "http://www.228365365.com/app/member/FT_browse/body_var.php?uid=test00&rtype=r&langx=zh-cn&mtype=3&delay=&league_id=");
    curl_setopt($ch, CURLOPT_URL, "http://www.228365365.com/app/member/FT_future/body_var.php?uid=test00&rtype=r&langx=zh-cn&mtype=3&page_no=0&league_id=&hot_game=");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    // 3. 執行，取回 response 結果
    $pageContent = curl_exec($ch);
    $fo = fopen ('text.txt' , 'w');
    fwrite ($fo, $pageContent );

    // 4. 關閉與釋放資源
    curl_close($ch);
    fclose($fo);

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

    eval($result);
    fclose($fo);
    echo "<hr>";
    $conn = new Connect();
    $conn->savegame($GameFT);
    foreach($GameFT as $k => $v)
    {
        echo $k."<br>" ;
        foreach($GameFT[$k] as $j => $g){
        echo "\t[".$j."]".$GameFT[$k][$j]."<br>";}
    }

    sleep($interval);// 等待5分鐘
// } while (true);





