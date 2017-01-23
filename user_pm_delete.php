<?php
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php"); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員私人短消息刪除消息</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-會員私人短消息刪除消息</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php if($_SESSION[$config['cookie_prefix'].'username'] != null) { ?>
		<form name="form" method="post" action="user_pm_deletec.php">
			<table width="500" border="1" cellspacing="0" cellpadding="0">
				<tr>
					<td>要刪除的消息</td>
					<td><input type="text" name="NO" value="<?php echo $_GET['NO'];?>" readonly="readonly" /></td>
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
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
	}
	?>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("cpf-footer.php");?>
</body>

</html>