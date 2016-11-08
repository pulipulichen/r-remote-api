<?php

include 'r-remote-api-client.php';

//$remote_api_url = "http://localhost/r-remote-api/server/?";
$remote_api_url = "http://192.168.56.152/r-remote-api.php";

// ---------------------------
// 計算資料的展示
$rscript = file_get_contents("demo-message.R");
$parameters = array(20, 80);

echo "Result: " . rRemoteAPI($remote_api_url, $rscript, $parameters);

// ---------------------------
// 顯示圖表的展示
$rscript_plot = file_get_contents("demo-plot.R");

echo '<img src="' . rRemoteAPI($remote_api_url, $rscript_plot) . '" />';
