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
		<h1 class="text-center"><?php echo $config["sitename"];?>-會員註冊</h1>
		<?php include_once("nav.php");?><!--嵌入nav.php-->
		<hr><size=5>		
		<!--內容-->
		<?php if($config["reg"]=="true"){ ?>
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
				<b>密碼(再輸入一次)不能為空！</b>
			</div>
		<?php }elseif($_GET['err'] == 4){?>
			<div class="alert alert-danger" role="alert">
				<b>密碼不一致！</b>
			</div>
		<?php }elseif($_GET['err'] == 5){?>
			<div class="alert alert-info" role="alert">
				<b>用戶名已被使用！</b>
			</div>
		<?php }elseif($_GET['err'] == 6){?>
			<div class="alert alert-danger" role="alert">
				<b>註冊失敗！請聯繫管理員！</b>
			</div>
		<?php }else{} ?>
		<form name="form" method="post" action="regc.php" class="form-horizontal">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
					<p class="text-center">註冊</p>
				</div>
			</div>			
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
					<div class="form-group">
						<label for="r_username">帳號</label>
						<input type="text" name="username" class="form-control" id="r_username"/>
					</div>
				</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
					<div class="form-group">
						<label for="r_email">email</label>
						<input type="text" name="email" class="form-control" id="r_email"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
					<div class="form-group">
						<label for="r_password">密碼</label>
						<input type="password" name="password" class="form-control" id="r_password"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
					<div class="form-group">
						<label for="r_password2">再一次輸入密碼</label>
						<input type="password" name="password2" class="form-control" id="r_password2"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
					<div class="form-group">
						<button type="submit" name="reg" class="btn btn-primary">註冊</button>
					</div>
				</div>
			</div>
		</form>
		<hr><size=5>
		<?php if($_GET['info'] == 1){?>
			<div class="alert alert-danger" role="alert">
				<b>使用者名稱不能為空！</b>
			</div>
		<?php }elseif($_GET['info'] == 2){?>
			<div class="alert alert-success" role="alert">
				<b>用戶名可使用！</b>
			</div>
		<?php }elseif($_GET['info'] == 3){?>
			<div class="alert alert-danger" role="alert">
				<b>用戶名已被使用！</b>
			</div>
		<?php }elseif($_GET['info'] == 4){?>
			<div class="alert alert-danger" role="alert">
				<b>檢查失敗！請聯繫管理員！</b>
			</div>
		<?php }else{} ?>
		<form name="form" method="post" action="member_check.php" class="form-horizontal">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
					<p class="text-center">帳號檢查是否可用</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
					<div class="form-group">
						<label for="c_username">帳號</label>
						<input type="text" name="username" class="form-control" id="c_username"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
					<div class="form-group">
						<button type="submit" name="check" class="btn btn-primary">檢查</button>
					</div>
				</div>	
			</div>
		</form>
		<?php }else{echo "很抱歉，".$config["sitename"]."已經關閉註冊";} ?>
		<hr><size=5>
		<!--頁尾-->
		<?php include_once("cpf-footer.php");?>
	</div>
</body>

</html>