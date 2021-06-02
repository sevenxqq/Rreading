
<?php
    //连接本地mysql
    $conn = new mysqli("localhost", "root", "123");
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    //核对用户及密码,登录成功设置一个月的cookie
    mysqli_select_db($conn, 'webdb');
    $userName = $_POST["username"];
    $pw = $_POST["password"];
    $sql = "SELECT name, password FROM user where name = '$userName' and password = '$pw'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        echo "<script>alert('用户名或密码错误');location.href='../login.html';</script>";
    } else {
        $expire=time()+60*60*24*30;
        setcookie('curUser',$userName,$expire);
        header('Location:../home.html');
    }
    $conn->close();
?>









