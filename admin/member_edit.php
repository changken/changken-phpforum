<?php
session_start();
require_once("../mysql_connect.inc.php");
require_once('../config.php');
require_once("../inc/function.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-帳號編輯</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-帳號編輯</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php
	if($_SESSION[$config["cookie_prefix"].'admin'] != null)
	{
        $NO = $_GET['NO'];
		//套用取得帳號資訊函數
		$row = cpf_getUserInfo($NO,2);
	?>
		<form name="form" method="post" action="member_editc.php">
			<table width="500" border="1" cellspacing="0" cellpadding="0">
				<tr>
					<td>NO</td>
					<td><input type="text" name="NO" value="<?php echo $row['NO'];?>" readonly="readonly" /></td>
				</tr>
				<tr>
					<td>帳號</td>
					<td><input type="text" name="username" value="<?php echo $row['username'];?>" readonly="readonly" /></td>
				</tr>
				<tr>				
					<td>email</td>
					<td><input type="text" name="email" value="<?php echo $row['email'];?>" /></td>
				</tr>
				<tr>
					<td>密碼</td>
					<td><input type="password" name="password" value="" /></td>
				</tr>
				<tr>
					<td>密碼(再輸入一次)</td>
					<td><input type="password" name="password2" value="" /></td>
				</tr>
				<tr>
					<td>權限</td>
					<td><input type="text" name="level" value="<?php echo $row['level'];?>" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="button" value="確定" /></td>
				</tr>
			</table>
		</form>
		<p>註:密碼及密碼(再輸入一次)留空為不修改密碼。</p>
	<?php
	}
	else
	{
		header("location:../login.php");
	}
	?>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("../cpf-footer.php");?>
</body>

</html>