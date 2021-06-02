<?php
    $conn = new mysqli("localhost", "root", "123");
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    mysqli_select_db($conn, 'webdb');
    $user = $_COOKIE["curUser"];
    $bookName = $_POST["bookName"];
    $newNum = $_POST["orderNum"];
    if ($_POST["pattern"] == "删除订单"){
        $sql = "DELETE from orders where uname = '$user' and bname = '$bookName'";
        $res = $conn->query($sql);
        if ($res == true){
            echo "<script> alert('订单删除成功'); location='../cart.html'; </script>";
        }
        else{
            echo "<script> alert('发生未知错误，订单删除失败'); location='../cart.html'; </script>";
        }
    }
    else if ($_POST["pattern"] == "修改订单"){    
        $sql = "UPDATE orders SET num = $newNum where uname = '$user' and bname = '$bookName'";
        $res = $conn->query($sql);
        if ($res == true){
            echo "<script> alert('订单修改成功'); location='../cart.html'; </script>";
        }
        else{
            echo "<script> alert('发生未知错误，订单修改失败'); location='../cart.html'; </script>";
        }
    }
    $conn->close();
?>