<?php  
session_start();
require_once("../mysql_connect.inc.php"); 
require_once('../config.php');
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員討論區刪除版塊</title>
	<meta charset="utf-8" />
	<link rel="stylesheet"  href="../style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-會員討論區刪除版塊</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php 
	if($_SESSION[$config['cookie_prefix'].'admin'] != null)
	{
	?>
	<form name="form" method="post" action="forum_group_deletec.php">
		<table border="1">
			<tr>
				<td>要刪除的版塊</td>
				<td><input type="text" name="groupid" value="<?php echo $_GET['groupid'];?>" readonly="readonly"/></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="button" value="刪除"/></td>
			</tr>
		</table>
	</form>
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