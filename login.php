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
		<h1 class="text-center"><?php echo $config["sitename"];?>-會員登入</h1>
		<?php include_once("nav.php");?><!--嵌入nav.php-->
		<hr><size=5>
		<!--內容-->
		<?php if($_GET['err'] == 1){?>
			<div class="alert alert-danger" role="alert">
				<b>使用者名稱不能為空！</b>
			</div>
		<?php }elseif($_GET['err'] == 2){?>
			<div class="alert alert-danger" role="alert">
				<b>密碼不能為空！</b>
			</div>
		<?php }elseif($_GET['err'] == 3){?>
			<div class="alert alert-danger" role="alert">
				<b>使用者名稱or密碼不對！</b>
			</div>
		<?php }elseif($_GET['err'] == 4){?>
			<div class="alert alert-danger" role="alert">
				<b>登入失敗！請聯繫管理員！</b>
			</div>
		<?php }else{} ?>
		<form name="form" method="post" action="loginc.php" class="form-horizontal">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
					<div class="form-group">
						<label for="l_username">帳號:</label>
						<input type="text" name="username" class="form-control" id="l_username"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
					<div class="form-group">
						<label for="l_password">密碼:</label>
						<input type="password" name="password" class="form-control" id="l_password" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
					<div class="form-group">
						<button type="submit" name="login" class="btn btn-primary">登入</button>
						<a href="reg.php" class="btn btn-info">申請帳號</a>
					</div>
				</div>
			</div>
		</form>
		<hr><size=5>
		<!--頁尾-->
		<?php include_once("cpf-footer.php");?>
	</div>
</body>

</html>