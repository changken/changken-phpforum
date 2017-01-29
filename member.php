<?php 
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php"); 
//從session變數中取得使用者帳號資訊
$user = $_SESSION[$config['cookie_prefix'].'username'];
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員中心</title>
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
	<script src="//cdn.ckeditor.com/4.4.7/basic/ckeditor.js"></script>
</head>

<body>
	<div class="container">
		<!--標題-->
		<h1 class="text-center"><?php echo $config["sitename"];?>-會員中心</h1>
		<?php include_once("nav.php");?><!--嵌入nav.php-->
		<hr><size=5>
		<!--內容-->
		<?php 
		if($_SESSION[$config["cookie_prefix"].'username'] != null or $_SESSION[$config["cookie_prefix"].'admin'] != null)
		{
			$sql = "SELECT * FROM `".$prefix."user` ORDER BY `NO` DESC;";
			$result = mysqli_query($conn,$sql);
		?>
		<table class="table">
			<tr>
				<td>帳號</td>
				<td>email</td>
				<td>權限</td>
			</tr>
		<?php
		$num = mysqli_num_rows($result);
		if($num>0)
		{
			for($i=0;$i<$num;$i++)
			{
				$row = mysqli_fetch_array($result);
				if($row['level'] == 100)
				{
		?>
			<tr class="info">
				<td><?php echo $row['username'];?></td>
				<td><?php echo $row['email'];?></td>
				<td>管理員(100)</td>
			</tr>
		<?php }elseif($row['level'] == 50){ ?>
			<tr class="warning">
				<td><?php echo $row['username'];?></td>
				<td><?php echo $row['email'];?></td>
				<td>版主(50)</td>
			</tr>
		<?php }else{?>
			<tr>
				<td><?php echo $row['username'];?></td>
				<td><?php echo $row['email'];?></td>
				<td>一般會員(10)</td>
			</tr>
		<?php
				}
			}
		}
		?>
		</table>
		<hr><size=5>
		<?php if($config["user_pm"]=="true"){?>
			<h1>會員私人短消息:</h1>
		<?php 
				include_once("pm_nav.php");
				$pm_sql = "SELECT * FROM `".$prefix."user_pm` WHERE `send_to`='$user' AND `state`='inbox' AND `if_read` = 0;";
				$pm_result = mysqli_query($conn,$pm_sql);
				$pm_num = mysqli_num_rows($pm_result);
				if($pm_num>0)
				{
				?>
					<div class="alert alert-warning" role="alert">
						<b>您有<?php echo $pm_num;?>封短消息未讀！</b>
					</div>
				<?php
				}
				else
				{
				?>
					<div class="alert alert-info" role="alert">
						<b>您目前沒有任何新的短消息！</b>
					</div>					
				<?php	
				}
				if($_GET['action']=="send")
				{ 
					include_once("inc/pm_form.php");
				}
				else if($_GET['action']=="inbox")
				{
					include_once("inc/pm_inbox.php");
				}
				else if($_GET['action']=="outbox")
				{
					include_once("inc/pm_outbox.php");			
				}
				else if($_GET['action']=="view")
				{
					include_once("inc/pm.php");			
				}
				else{} 
			}
			else
			{
				echo "很抱歉，".$config["sitename"]."的會員私人短消息已經關閉";
			} 
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