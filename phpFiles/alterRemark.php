<?php
//没有则插入，否则更新评论
$conn = new mysqli("localhost", "root", "123");
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
mysqli_select_db($conn, 'webdb');
$curuser = $_COOKIE["curUser"];
$bname =$_POST["submit"];
$bremark = $_POST["remark"];
$sql = "select * from remark where uname='$curuser' and bname ='$bname'";
$res = $conn->query($sql);
if ($res->num_rows == 0) {
    $sql = "INSERT into remark (uname,bname,content) VALUES ('$curuser','$bname','$bremark')";
    if ($conn->query($sql) == true){
        echo "<script>location ='".$_SERVER["HTTP_REFERER"]."';</script> ";
    }
    else{
        echo "<script> alert('发生未知错误'); location.href='".$_SERVER["HTTP_REFERER"]."';</script> ";
    }
}
else{
    $sql = "UPDATE remark SET content='$bremark' where uname='$curuser' and bname ='$bname'";
    if ($conn->query($sql) == true){
        echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script> ";
    }
    else{
        echo "<script> alert('发生未知错误'); location.href='".$_SERVER["HTTP_REFERER"]."';</script> ";
    }
}
$conn->close();

?>