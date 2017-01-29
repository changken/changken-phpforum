<?php 
session_start();
require_once("../mysql_connect.inc.php");
require_once("../config.php"); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員討論區刪除帖子</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 最新編譯和最佳化的 CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- 選擇性佈景主題 -->
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<!--引入Jquery-->
	<script src="../js/jquery-3.1.1.min.js"></script>
	<!-- 最新編譯和最佳化的 JavaScript -->
	<script src="../js/bootstrap.min.js"></script>
	<!--自訂義css-->
	<link rel="stylesheet" href="../style.css" />
</head>

<body>
	<div class="container">
		<!--標題-->
		<h1><?php echo $config["sitename"];?>-會員討論區刪除帖子</h1>
		<hr><size=5>
		<!--內容-->
		<?php 
		if($_SESSION[$config["cookie_prefix"].'mod'] != null or $_SESSION[$config["cookie_prefix"].'admin'] != null)
		{ 
		?>
			<div class="alert alert-danger" role="alert">
				<b>請注意！此動作不可回逆！</b>
			</div>
		<?php
			if($_GET['action']=="reply")
			{
				$NO = $_GET['NO'];
				$sql = "SELECT * FROM `".$prefix."forum_posts_reply` WHERE `NO`='$NO';";
				$result = mysqli_query($conn,$sql);
				$row = mysqli_fetch_array($result);
		?>
			<form name="form" method="post" action="forum_posts_deletec.php?action=reply" class="form-horizontal">
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
						<div class="form-group">
							<label for="fr_posts_id">所屬帖子:</label>
							<input type="text" name="posts_id" value="<?php echo $row['posts_id'];?>" class="form-control" id="fr_posts_id" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">			
						<div class="form-group">
							<label for="fr_NO">要刪除的回覆:</label>
							<input type="text" name="NO" value="<?php echo $_GET['NO'];?>" class="form-control" id="fr_NO" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-primary">刪除</button>
						</div>
					</div>
				</div>
			</form>
		<?php 
			}
			else
			{
				$NO = $_GET['NO'];
				$sql = "SELECT * FROM `".$prefix."forum_posts` WHERE `NO`='$NO';";
				$result = mysqli_query($conn,$sql);
				$row = mysqli_fetch_array($result);
		?>
			<div class="alert alert-danger" role="alert">
				<b>請注意！刪除帖子意味著連同回覆都會一併刪除！</b>
			</div>
			<form name="form" method="post" action="forum_posts_deletec.php" class="form-horizontal">
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
						<div class="form-group">
							<label for="f_groupid">所屬版塊:</label>
							<input type="text" name="groupid" value="<?php echo $row['groupid'];?>" class="form-control" id="f_groupid" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">			
						<div class="form-group">
							<label for="f_NO">要刪除的帖子:</label>
							<input type="text" name="NO" value="<?php echo $_GET['NO'];?>" class="form-control" id="f_NO" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-primary">刪除</button>
						</div>
					</div>
				</div>
			</form>
		<?php 
			}
		}
		else
		{
			echo '您無權限觀看此頁面!!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
		}
		?>
		<hr><size=5>
		<!--頁尾-->
		<?php include_once("../cpf-footer.php");?>
	</div>
</body>

</html>