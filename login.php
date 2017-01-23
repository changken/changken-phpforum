<?php 
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員登入</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-會員登入</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<form name="form" method="post" action="loginc.php">
		<table border=1>
			<tr>
				<th>會員登入</th>
			</tr>
			<tr>
				<td>帳號：<input type="text" name="username" /></td>
			</tr>
			<tr>
				<td>密碼：<input type="password" name="password" /></td>
			</tr>
			<tr>
				<td><input type="submit" name="button" value="登入" />&nbsp;&nbsp;
				<a href="reg.php">申請帳號</a></td>
			</tr>
		</table>
	</form>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("cpf-footer.php");?>
</body>

</html>