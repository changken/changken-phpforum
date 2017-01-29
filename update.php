<?php 
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php");
require_once("inc/function.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員個人資訊修改</title>
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
		<h1><?php echo $config["sitename"];?>-會員個人資訊修改</h1>
		<?php include_once("nav.php");?><!--嵌入nav.php-->
		<hr><size=5>
		<!--內容-->
		<?php
		if($_SESSION[$config['cookie_prefix'].'username'] != null)
		{
			//套用查詢使用者資訊函數
			$username = $_SESSION[$config['cookie_prefix'].'username'];
			$row = cpf_getUserInfo($username,1);
		?>
		<div class="alert alert-info" role="alert">
			<p>註:密碼及密碼(再輸入一次)<b>皆留空</b>為不修改密碼。</p>
		</div>
		<?php if($_GET['err'] == 1){ ?>
			<div class="alert alert-danger" role="alert">
				<p>密碼不能為空！</p>
			</div>
		<?php }elseif($_GET['err'] == 2){?>
			<div class="alert alert-danger" role="alert">
				<p>密碼(再輸入一次)不能為空！</p>
			</div>
		<?php }elseif($_GET['err'] == 3){?>
			<div class="alert alert-danger" role="alert">
				<p>密碼不一致！</p>
			</div>
		<?php }elseif($_GET['err'] == 4){?>
			<div class="alert alert-danger" role="alert">
				<p>修改失敗！</p>
			</div>
		<?php }else{} ?>
			<form name="form" method="post" action="updatec.php" class="form-horizontal">
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
						<div class="form-group">
							<label for="u_NO">NO:</label>
							<input type="text" name="NO" value="<?php echo $row['NO'];?>" class="form-control" id="u_NO" readonly />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
						<div class="form-group">
							<label for="u_username">帳號:</label>
							<input type="text" name="username" value="<?php echo $row['username'];?>" class="form-control" id="u_username" readonly />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
						<div class="form-group">
							<label for="u_email">email:</label>
							<input type="email" name="email" value="<?php echo $row['email'];?>" class="form-control" id="u_email"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
						<div class="form-group">
							<label for="u_password">密碼:</label>
							<input type="password" name="password" class="form-control" id="u_password"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
						<div class="form-group">
							<label for="u_password2">密碼(再輸入一次):</label>
							<input type="password" name="password2" class="form-control" id="u_password2"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
						<div class="form-group">
							<label for="u_level">權限值:</label>
							<input type="text" name="level" value="<?php echo $row['level'];?>" class="form-control" id="u_level" readonly />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
						<div class="form-group">
							<p><b>權限:</b>
							<?php if($row['level'] == 100){ ?>
								管理員
							<?php }elseif($row['level'] == 50){ ?>
								會員討論區版主
							<?php }elseif($row['level'] == 10){ ?>
								一般會員
							<?php } ?>
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
						<div class="form-group">
							<button type="submit" name="update" class="btn btn-primary">修改</button>
						</div>
					</div>
				</div>
			</form>
		<?php
		}
		else
		{
			echo '您無權限觀看此頁面!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
		}
		?>
		<hr><size=5>
		<!--頁尾-->
		<?php include_once("cpf-footer.php");?>
	</div>
</body>

</html>