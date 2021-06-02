<?php

    addPlan();
    //函数具体实现
    function addPlan()
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
        $sql = "SELECT* FROM plan where uname = '$user'";
        $res = $conn->query($sql);
        if ($res->num_rows >= 7){
            echo "<script>alert('已经有七个计划了，过满则亏哦');location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
        }
        else{
            $sql = "SELECT* FROM plan where uname = '$user' and bname= '$book'";
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                $insertSql = "INSERT INTO plan (uname,bname) VALUES ('$user','$book')";
                $res = $conn->query($insertSql);
                if ($res == true)
                    echo "<script> alert('添加成功'); location.href='".$_SERVER["HTTP_REFERER"]."'; </script> ";
                else
                    echo "<script> alert('发生了未知错误，添加失败'); location.href='".$_SERVER["HTTP_REFERER"]."';</script> ";
            } else {
                echo "<script>alert('该书已在计划中，请勿重复添加！');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";      
            }
        }    
        $conn->close();
    }
?>

