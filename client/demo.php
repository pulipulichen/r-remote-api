<?php
// 載入R Remote API Client端函式
include 'r-remote-api-client.php';

// R Remote API Server端接口
//$remote_api_url = "http://192.168.56.152/r-remote-api.php";
$remote_api_url = "http://192.168.11.115/r-remote-api.php";

// ---------------------------
// 計算資料的展示
$rscript = file_get_contents("demo-message.R"); // 取得R Script
$parameters = array(20, 80); // 計算兩個數值的平均

// 取得平均數計算結果
echo "Result: " . rRemoteAPI($remote_api_url, $rscript, $parameters);

// ---------------------------
// 顯示圖表的展示
$rscript_plot = file_get_contents("demo-plot.R"); // 取得R Script

// 取得圖表結果
echo '<img src="' . rRemoteAPI($remote_api_url, $rscript_plot) . '" />';
