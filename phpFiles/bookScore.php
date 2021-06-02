<?php
$conn = new mysqli("localhost", "root", "123");
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
mysqli_select_db($conn, 'webdb');
$bookName = $_POST["bookName"];
$bookScore = $_POST["score"];
$sql = "update book set score=(score*scoreNum + $bookScore)/(scoreNum + 1),scoreNum=scoreNum+1 where bname = '$bookName'";
$res = $conn->query($sql);
if ($res == true){
    echo "<script>alert('评分已提交');location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
}
else{
    echo"<script>alert('发生未知错误，评分提交失败'); location.href='".$_SERVER["HTTP_REFERER"]."'; </script>"; 
}
$conn->close();

?>