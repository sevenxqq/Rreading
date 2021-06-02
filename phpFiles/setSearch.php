<?php
$search = $_POST["search"];
$expire=time()+60*60*24*30;
setcookie('search',$search,$expire);
echo "<script> open('../search.html'); location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 

?>

