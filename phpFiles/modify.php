<?php
$conn = new mysqli("localhost", "root", "123");
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
mysqli_select_db($conn, 'webdb');
$user = $_COOKIE["curUser"];
$pattern = $_POST["submit"];

if ($pattern == "个人介绍"){
    $myintro = $_POST["intro"];
    $sql = "update user set intro='$myintro' where name = '$user'";
    $res = $conn->query($sql);
    if ($res == true){
        echo "<script>alert('修改成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
    }
    else{
        echo"<script>alert('发生未知错误，修改失败'); location.href='".$_SERVER["HTTP_REFERER"]."'; </script>"; 
    }
}
else if ($pattern== "个人信息"){     
    $mypw = $_POST["userpassword"];
    $myemail = $_POST["myemail"];
    $sql = "update user set password='$mypw',email='$myemail' where name ='$user'";
    $res = $conn->query($sql);
    if ($res == true){ 
        echo "<script>alert('个人信息修改成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
    }
    else{
        echo"<script>alert('发生未知错误，修改失败'); location.href='".$_SERVER["HTTP_REFERER"]."'; </script>"; 
    }
   
}
else if ($pattern=="我的书票"){
    $charge =$_POST["recharge"];
    $sql = "update user set ticket=ticket+$charge where name ='$user'";
    $res = $conn->query($sql);
    if ($res == true){ 
        echo "<script>alert('充值成功  注意：此为功能模拟，不含真实付款过程');location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
    }
    else{
        echo"<script>alert('发生未知错误，充值失败'); location.href='".$_SERVER["HTTP_REFERER"]."'; </script>"; 
    }
}


$conn->close();

?>