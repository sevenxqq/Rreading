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
$user = $_COOKIE["curUser"];
$sql = "select imgurl,orders.bname AS mybook,price,num from orders,book where orders.bname = book.bname and orders.uname='$user'";
$res = $conn->query($sql);
$totalPrice = 0;
//json数据
if ($res->num_rows > 0 ){
    $json_data = "[ 'fill' "; //做一个填充值，之后就可以直接 , + data   避免最后判断
    while($row = $res->fetch_assoc()) {
        $json_data.= ","  . "'" . $row["imgurl"] ."'" .","  . "'" . $row["mybook"] ."'" .", " . $row["price"] . ", " . $row["num"];  
        $totalPrice += $row["price"] * $row["num"];
    }
    $json_data .= " ]";
    //输出jsonp格式的数据
    $expire=time()+60*60*24*30;
    setcookie('totalPrice',$totalPrice,$expire);
    echo $jsoncallback . "(" . $json_data . ")";
}
$conn->close();

?>