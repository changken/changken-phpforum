﻿<?php
session_start();
include('../config.php'); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-控制後台登入</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-控制後台登入</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php if($_GET['a']=="err1"){?>
<font color="red">錯誤！！管理員名稱絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="err2"){?>
<font color="red">錯誤！！密碼絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="err3"){?>
<font color="red">錯誤！！密碼錯誤！！！</font>
<?php }elseif($_GET['a']=="err4"){?>
<font color="red">錯誤！！查無此管理員！！！</font>
<?php }elseif($_GET['a']=="err5"){?>
<font color="red">錯誤！！查無此管理員！！！</font>
<?php }else{}?>
<form name="form" method="post" action="loginc.php">
<table border=1>
<tr>
<th>控制後台登入</th>
</tr>
<tr>
<td>管理員帳號：<input type="text" name="adminname" /></td>
</tr>
<tr>
<td>密碼：<input type="password" name="password" /></td>
</tr>
<tr>
<td><input type="submit" name="button" value="登入" /></td>&nbsp;&nbsp;
</tr>
</table>
</form>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>