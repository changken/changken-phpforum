<?php
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php");
require_once("inc/function.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-登出中...</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-登出中...</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php 
		cpf_logout();
		echo "登出成功！";
		echo "<meta http-equiv=REFRESH CONTENT=1;url=login.php>";
	?>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("cpf-footer.php");?>
</body>

</html>