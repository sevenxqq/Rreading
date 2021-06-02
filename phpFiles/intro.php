<?php
header('Content-type: application/json');
//获取回调函数名
$jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);
//从数据库中查询数据
$conn = new mysqli("localhost", "root", "123");
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
mysqli_select_db($conn, 'webdb');
$curuser = $_COOKIE["curUser"];
$sql = "select intro from user where name='$curuser'";
$res = $conn->query($sql);
//json数据
if ($res->num_rows > 0 ){
    $json_data = "['" . $curuser . "'"; 
    while($row = $res->fetch_assoc()) {
        $json_data.= ","  . "'" . $row["intro"] . "'";  
    }
    $json_data .= " ]";
    //输出jsonp格式的数据
    echo $jsoncallback . "(" . $json_data . ")";
}
$conn->close();

?>