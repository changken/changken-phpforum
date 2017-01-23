<?php 
session_start(); 
require_once("mysql_connect.inc.php");
require_once("config.php");
require_once("inc/function.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-登入中...</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-登入中...</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php
		$code = cpf_login($_POST['username'],$_POST['password']);
		switch($code)
		{
			case 0:
				echo "使用者名稱為空";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=login.php>";
			break;
			case 1:
				echo "密碼為空";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=login.php>";
			break;
			case 2:
			case 3:
				echo "用戶名or密碼不對";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=login.php>";
			break;
			case 4:
				echo "登入成功!會員權限:一般會員！";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=member.php>";
			break;
			case 5:
				echo "登入成功!會員權限:管理員！";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=member.php>";
			break;
			case 6:
				echo "登入成功!會員權限:會員討論區版塊版主！";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=member.php>";
			break;
			case 7:
				echo "請聯繫管理員！";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=login.php>";
			break;
		}
	?>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("cpf-footer.php");?>
</body>

</html>