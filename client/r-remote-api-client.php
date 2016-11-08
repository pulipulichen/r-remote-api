<?php

if (function_exists("rRemoteAPI") === FALSE) {

function rRemoteAPI($remote_api_url, $rscript, $parameters = array()) {
    
    $ch = curl_init($remote_api_url);

    curl_setopt($ch, CURLOPT_POST, 1);
    $params = array(
        "r" => $rscript,
        "p" => $parameters
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

}   // if (function_exists("rRemoteAPI") === FALSE) {