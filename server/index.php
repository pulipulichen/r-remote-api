<?php
// ---------------------------------
// 設定部分

// R執行的路徑，如果是Linux則免設
// $rscript_exec = 'C:/Program Files/R/R-3.0.2/bin/RScript.exe';
$rscript_exec = "Rscript";

// 白名單：只有以下IP才能使用
$whitelist = array("::1", "192.168.56.*", "192.168.11.*");

// ---------------------------------
// 執行部分

// 白名單檢查的函式
function isAllowed($ip, $whitelist){
    # If the ip is matched, return true
    if(in_array($ip, $whitelist)) {
        return true;
    }
    else{
        foreach($whitelist as $i){
            $wildcardPos = strpos($i, "*");
            # Check if the ip has a wildcard
            if($wildcardPos !== false && substr($_SERVER['REMOTE_ADDR'], 0, $wildcardPos) . "*" == $i) {
                return true;
            }
        }
    }

    return false;
}

// 白名單檢查
if (!isAllowed($_SERVER["REMOTE_ADDR"], $whitelist)) {
	header('HTTP/1.0 403 Forbidden');
    echo "Permission denied";	
    exit;
}

// Linux自動取得編碼
if (DIRECTORY_SEPARATOR === "/" && is_file("/usr/bin/Rscript")) {
	$rscript_exec = "Rscript";
}
// ------------------------------------------------

// 取得R script
if (isset($_POST["r"])) {
    $r = $_POST["r"];
}
else {
	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo "Need R script";
    exit;
}

// 取得參數
$p = NULL;
if (isset($_POST["p"])) {
    $p = $_POST["p"];
    $p = implode(" ", $p);
}

if (strpos($rscript_exec, " ") !== 0) {
    $rscript_exec = '"' . $rscript_exec . '"';
}

// 處理圖片的檔案
$plotname = tempnam(sys_get_temp_dir(), "rplot");

// 把$d寫入檔案
$filename = tempnam(sys_get_temp_dir(), "rscript");
file_put_contents($filename, $r);

$exec_cmd = $rscript_exec . " " . $filename . " " . $plotname;
if (is_null($p) === FALSE) {
    $exec_cmd = $exec_cmd . " " . $p;
}
//$exec_cmd = "sudo -u rstudio " . $exec_cmd;

//echo $exec_cmd;
setlocale(LC_ALL, 'en_US.utf8');
exec($exec_cmd , $output);

if (filesize($plotname) > 0) {

	// Code from https://www.webteach.tw/?p=181
    $pic = file_get_contents($plotname); // 讀取圖片
    $type = getimagesize($plotname); // 取得圖片資訊
    $file_content = base64_encode($pic); // base64編碼
    switch($type[2]){ // 判斷圖片的類型
        case 1:$img_type="gif";break;  
        case 2:$img_type="jpg";break;  
        case 3:$img_type="png";break;  
    }  
    $img = 'data:image/'.$img_type.';base64,'.$file_content; // data url 格式
    $result = $img;
	//echo "aaa";
}
else {
    $result = implode("\n", $output);
	//echo "bbb";
}

header("Content-Type:text/html; charset=utf-8");
echo $result;

unlink($plotname);
unlink($filename);