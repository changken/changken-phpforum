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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 最新編譯和最佳化的 CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- 選擇性佈景主題 -->
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<!--引入Jquery-->
	<script src="js/jquery-3.1.1.min.js"></script>
	<!-- 最新編譯和最佳化的 JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<!--自訂義css-->
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<div class="container">
		<!--標題-->
		<h1 class="text-center"><?php echo $config["sitename"];?>-登入中...</h1>
		<?php include_once("nav.php");?><!--嵌入nav.php-->
		<hr><size=5>
		<!--內容-->
		<?php
			$code = cpf_login($_POST['username'],$_POST['password']);
			switch($code)
			{
				case 0:
					echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php?err=1>";
				break;
				case 1:
					echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php?err=2>";
				break;
				case 2:
				case 3:
					echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php?err=3>";
				break;
				case 4:
					echo "<div class='alert alert-success' role='alert'>
							<b>登入成功!會員權限:一般會員！</b>
						</div>";
					echo "<meta http-equiv=REFRESH CONTENT=2;url=member.php>";
				break;
				case 5:
					echo "<div class='alert alert-success' role='alert'>
							<b>登入成功!會員權限:管理員！</b>
						</div>";
					echo "<meta http-equiv=REFRESH CONTENT=2;url=member.php>";
				break;
				case 6:
					echo "<div class='alert alert-success' role='alert'>
							<b>登入成功!會員權限:會員討論區版塊版主！</b>
						</div>";
					echo "<meta http-equiv=REFRESH CONTENT=2;url=member.php>";	
				break;
				case 7:
					echo "<meta http-equiv=REFRESH CONTENT=0;url=login.php?err=4>";
				break;
			}
		?>
		<hr><size=5>
		<!--頁尾-->
		<?php include_once("cpf-footer.php");?>
	</div>
</body>

</html>