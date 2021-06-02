<?php
//连接本地mysql
$conn = new mysqli("localhost", "root", "123");
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
//核对数据库已有信息
mysqli_select_db($conn, 'webdb');
$userEmail = $_POST["useremail"];
$userName = $_POST["username"];
$pw = $_POST["userpassword"];
$sql = "SELECT email FROM user where email = '$userEmail'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<script>alert('该邮箱已被注册');
        location.href='../register.html';</script>";
} else {
    $sql = "SELECT name FROM user where name = '$userName'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<script>alert('该用户名已被注册');
            location.href='../register.html';</script>";
    } else {
        //注册成功，插入数据库，自动跳转到登录页面
        $sql = "insert into user(email,name,password) values ( '$userEmail','$userName','$pw')";
        $result = $conn->query($sql);
        if ($result) {
            echo "<script>alert('注册成功');
                location.href='../login.html';</script>";
        } else {
            echo "<script>alert('注册失败，请重试');
                location.href='../register.html';</script>";
        }
    }
}
$conn->close();
?>