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
		<h1><?php echo $config["sitename"];?>-會員私人短消息刪除消息</h1>
		<?php include_once("nav.php");?><!--嵌入nav.php-->
		<hr><size=5>
		<!--內容-->
		<?php if($_SESSION[$config['cookie_prefix'].'username'] != null) { ?>
			<div class="alert alert-danger" role="alert">
				<b>請注意！此動作不可回逆！</b>
			</div>
			<div class="alert alert-danger" role="alert">
				<b>請注意！如果您是刪除「已寄出」的短消息的話！<br />
				對方仍舊會看到您的短消息！(您只是刪除掉備份的！)
				</b>
			</div>
			<form name="form" method="post" action="user_pm_deletec.php" class="form-horizontal">
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
						<div class="form-group">
							<label for="pm_NO">要刪除的消息</label>
							<input type="text" name="NO" value="<?php echo $_GET['NO'];?>" class="form-control" id="pm_NO" readonly />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-4 col-md-offset-4">
						<div class="form-group">
							<button type="submit" name="delete" class="btn btn-danger">刪除</button>
						</div>
					</div>
				</div>
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
	</div>
</body>

</html>