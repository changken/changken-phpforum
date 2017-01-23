<?php
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php");
require_once("inc/function.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-帳號檢查是否可用</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-帳號檢查是否可用</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php
	$code = cpf_check($_POST['username']);
	switch($code)
		{
			case 0:
				echo "使用者名稱為空";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=reg.php>";
			break;
			case 1:
				echo "用戶名可使用";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=reg.php>";
			break;
			case 2:
				echo "用戶名已被使用";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=reg.php>";
			break;
			case 3:
				echo "系統有問題！";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=reg.php>";
			break;
		}
	?>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("cpf-footer.php");?>
</body>

</html>