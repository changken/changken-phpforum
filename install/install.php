<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title>changken-phpforum-安裝導引-安裝</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h1>changken-phpforum-安裝導引-安裝</h1>
<hr><size=5>
<!--內容-->
<?php
include '../mysql_connect.inc.php';//MySQL資料庫連接
$sql=file_get_contents("changkenphpforum.sql");    //把SQL語句以字符串讀入$SQL 
$a=explode(";",$sql);                       //用explode()函數把$SQL字符串以“;”分割為數組 

foreach($a as $b){                         //遍歷數組 
$c=$b.";";                                      //分割後是沒有“;”的，因為SQL語句以“;”結束，所以在執行SQL前把它加上 
mysql_query($c);                         //執行SQL語句 
}
?>
<p>安裝成功！</p>
<p><a href="setting.php">下一步，網站參數設定</a></p>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>