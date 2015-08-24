<?php
header("Content-Type:text/html; charset=utf-8"); 
session_start(); 
//將session清空
unset($_SESSION['admin']);
unset($_SESSION['mod']);
unset($_SESSION['username']);
echo '登出中......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
?>