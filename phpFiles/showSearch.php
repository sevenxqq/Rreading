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
$search = $_COOKIE["search"];
$sql = "select bname,imgurl,author,score from book where bname like '%$search%'";
$res = $conn->query($sql);
//json数据
if ($res->num_rows > 0 ){
    $json_data = "[ 'fill' "; //做一个填充值，之后就可以直接 , + data   避免最后判断
    while($row = $res->fetch_assoc()) {
        $json_data.= ","  . "'" . $row["bname"] ."'" . ","  . "'" . $row["imgurl"] ."'".","  . "'" . $row["author"] ."'". ","  . "'" . $row["score"] ."'";  
    }
    $json_data .= " ]";
    //输出jsonp格式的数据
    echo $jsoncallback . "(" . $json_data . ")";
}
$conn->close();

?>