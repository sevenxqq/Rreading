<?php
header('Content-type: application/json');
//获取回调函数名
$jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);
$reading = $_COOKIE["reading"];
$json_data = "['$reading'] "; 
//输出jsonp格式的数据
echo $jsoncallback . "(" . $json_data . ")";
?>