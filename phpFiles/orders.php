<?php

    addOrder();

    //函数具体实现
    function addOrder()
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
        $sql = "SELECT num FROM orders where uname = '$user' and bname= '$book'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            $insertSql = "INSERT INTO orders (uname,bname,num) VALUES ('$user','$book',1)";
            $res = $conn->query($insertSql);
            if ($res == true)
                echo "<script> alert('添加成功'); location.href='".$_SERVER["HTTP_REFERER"]."'; </script> ";
            else
                echo "<script> alert('加入订单失败'); location.href='".$_SERVER["HTTP_REFERER"]."';</script> ";
        } else {
            $updateSql = "UPDATE orders SET num = num + 1 where uname='$user' AND bname='$book'";
            $res = $conn->query($updateSql);
            if ( $res == true)
                echo "<script> alert('订单更新成功'); location.href='".$_SERVER["HTTP_REFERER"]."';</script> ";
            else
                echo "<script> alert('订单更新失败！'); location.href='".$_SERVER["HTTP_REFERER"]."';</script> ";
            
        }
        $conn->close();
    }


?>

