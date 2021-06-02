<?php
// $reading = $_POST["bookName"];
$reading = "fake.txt";
$expire=time()+60*60*24*30;
setcookie('reading',$reading,$expire);
echo "<script> open('../content.html'); location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 

?>

