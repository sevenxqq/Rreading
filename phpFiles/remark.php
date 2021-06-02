<?php
header('Content-type: application/json');
//获取回调函数名
$jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);
$bookName = htmlspecialchars($_REQUEST ['bookName']);
//测试使用
$bookName = '傲慢与偏见';
//
//从数据库中查询数据
$conn = new mysqli("localhost", "root", "123");
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
mysqli_select_db($conn, 'webdb');
$curuser = $_COOKIE["curUser"];
//获取自己的评论
$sql = "select content from remark where uname='$curuser' and bname='$bookName'";
$res = $conn->query($sql);
$json_data = "['" . $curuser . "'";
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $json_data .= ","  . "'" . $row["content"] . "'";
    }
}
else{
    $json_data .= ","  . "'空空如也'" ;
}
//加入其他评论
$sql = "SELECT content,uname from remark where bname='$bookName' and uname != '$curuser' limit 5";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $json_data .= ","  . "'" . $row["content"] . "'" . ","  . "'" . $row["uname"] . "'";
    }
}
$json_data .= " ]";
//输出jsonp格式的数据
echo $jsoncallback . "(" . $json_data . ")";
$conn->close();

?>