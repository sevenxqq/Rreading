<?php
//从数据库中查询数据
$conn = new mysqli("localhost", "root", "123");
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
mysqli_select_db($conn, 'webdb');
$curuser = $_COOKIE["curUser"];
$total = $_COOKIE["totalPrice"];
$sql = "select ticket from user where name='$curuser'";
$res = $conn->query($sql);
//json数据
if ($res->num_rows > 0 ){
    $row = $res->fetch_assoc();
    $myticket = $row["ticket"];
    if ($myticket >= $total){
        $left = $myticket - $total;
        $sql = "UPDATE user set ticket=$left where name='$curuser' ";
        $res = $conn->query($sql);
        $delSql ="DELETE from orders where uname='$curuser' ";
        $conn->query($delSql);
        if ($res == true){
            echo "<script> alert('订单结算成功'); location.href='".$_SERVER["HTTP_REFERER"]."'; </script>";
        }
        else{  
            echo"<script>alert('发生未知错误，结算失败'); location.href='".$_SERVER["HTTP_REFERER"]."'; </script>";
        }
    }
    else{
        echo"<script>alert('书票不足，请到个人中心充值'); location.href='".$_SERVER["HTTP_REFERER"]."'; </script>";
    }
}
$conn->close();

?>