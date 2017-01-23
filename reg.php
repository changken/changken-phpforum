<?php 
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員註冊</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-會員註冊</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php if($config["reg"]=="true"){ ?>
	<form name="form" method="post" action="regc.php">
		<table border=1>
			<tr>
				<th>會員註冊</th>
			</tr>
			<tr>
				<td>帳號：<input type="text" name="username" /></td>
			</tr>
			<tr>
				<td>email：<input type="text" name="email" /></td>
			</tr>
			<tr>
				<td>密碼：<input type="password" name="password" /></td>
			</tr>
			<tr>
				<td>再一次輸入密碼：<input type="password" name="password2" /></td>
			</tr>
			<tr>
				<td><input type="submit" name="button" value="註冊" /></td>
			</tr>
		</table>
	</form>
	<hr><size=5>
	<form name="form" method="post" action="member_check.php">
		<table border=1>
			<tr>
				<th>帳號檢查是否可用</th>
			</tr>
			<tr>
				<td>帳號：<input type="text" name="username" /></td>
			</tr>
			<tr>
				<td><input type="submit" name="button" value="檢查" /></td>
			</tr>
		</table>
	</form>
	<?php }else{echo "很抱歉，".$config["sitename"]."已經關閉註冊";} ?>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("cpf-footer.php");?>
</body>

</html>