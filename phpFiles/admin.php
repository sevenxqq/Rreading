<?php
$conn = new mysqli("localhost", "root", "123");
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
mysqli_select_db($conn, 'webdb');
$curuser = $_COOKIE["curUser"];
$sql = "select priority from user where name='$curuser'";
$res = $conn->query($sql);
if ($res->num_rows > 0 ){
    $row = $res->fetch_assoc();
    $pri = $row["priority"];
    if ($pri == 0){
        echo"<script> open('../../phpmyadmin'); location.href='".$_SERVER["HTTP_REFERER"]."'; </script>"; 
    }
    else{
        echo"<script>alert('对不起，您不是管理员，没有相应权限'); location.href='".$_SERVER["HTTP_REFERER"]."'; </script>"; 
    }
}
$conn->close();

?>