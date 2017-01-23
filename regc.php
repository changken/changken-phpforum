<?php
require_once("mysql_connect.inc.php");
require_once("config.php");
require_once("inc/function.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員註冊中...</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-會員註冊中...</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php
		$code = cpf_reg($_POST['username'],$_POST['email'],$_POST['password'],$_POST['password2'],10);
		switch($code)
		{
			case 0:
				echo "使用者名稱為空";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=reg.php>";
			break;
			case 1:
				echo "密碼為空";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=reg.php>";
			break;
			case 2:
				echo "密碼(再輸入一次)為空";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=reg.php>";
			break;
			case 3:
				echo "密碼不一致";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=reg.php>";
			break;
			case 4:
				echo "用戶名已被使用";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=reg.php>";
			break;
			case 5:
				echo "註冊成功！";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=login.php>";
			break;
			case 6:
				echo "註冊失敗！";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=reg.php>";
			break;
		}
	?>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("cpf-footer.php");?>
</body>

</html>