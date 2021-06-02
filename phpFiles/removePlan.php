<?php

    removePlan();
    //函数具体实现
    function removePlan()
    {
        //连接本地mysql
        $conn = new mysqli("localhost", "root", "123");
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        mysqli_select_db($conn, 'webdb');
        //从cookie中获取用户名
        $user = $_COOKIE["curUser"];
        $book = $_POST["bookName"];
        $sql = "SELECT* FROM plan where uname = '$user' and bname= '$book'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            echo "<script> alert('该书不在阅读计划中'); location.href='../home.html';</script> ";
        } else {
            $sql = "DELETE FROM plan where uname = '$user' and bname= '$book'";
            $res = $conn->query($sql);
            if ($res == true) {
                echo "<script>alert('移出成功');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
            } else {
                echo "<script>alert('发生了未知错误，移出失败');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
            }
        }
        $conn->close();
    }
?>

