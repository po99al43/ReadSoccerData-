<?php
header("content-type: text/html; charset=utf8");
// 1. 初始設定
$ch = curl_init();

//2. 設定 / 調整參數
curl_setopt($ch, CURLOPT_URL, "http://www.228365365.com/app/member/FT_browse/body_var.php?uid=test00&rtype=r&langx=zh-cn&mtype=3&delay=&league_id=");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=3tga2sugh5q20ni83uv90fsed7");
curl_setopt($ch, CURLOPT_HEADER, 0);

// 3. 執行，取回 response 結果
$pageContent = curl_exec($ch);
$fo = fopen ( 'text.txt' , 'w' );
fwrite ($fo, $pageContent );
// 4. 關閉與釋放資源
curl_close($ch);
fclose($fo);

$fo = fopen ( 'text.txt' , 'r' );
$result;
while(!feof($fo))//feof
{
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
//print_r($GameFT) ;
fclose($fo);
echo "<hr>";
foreach($GameFT as $k => $v)
{
    echo $k."<br>" ;
    foreach($GameFT[$k] as $j => $g){
    echo "\t[".$j."]".$GameFT[$k][$j]."<br>";}
}
