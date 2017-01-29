<?php 
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php"); 
require_once("inc/function.php");
$username = $_SESSION[$config['cookie_prefix'].'username'];
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員帳號資訊</title>
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
		<h1 class="text-center"><?php echo $config["sitename"];?>-會員帳號資訊</h1>
		<?php include_once("nav.php");?><!--嵌入nav.php-->
		<hr><size=5>
		<!--內容-->
		<?php   
		$row = cpf_getUserInfo($username,1);
		if($_SESSION[$config['cookie_prefix'].'admin']!=null)
		{ 
		?>
			<table class="table">
				<tr>
					<td><b>帳號:</b></td>
					<td><?php echo $username;?></td>
				</tr>
				<tr>
					<td><b>email:</b></td>
					<td><?php echo $row['email'];?></td>
				</tr>
				<tr>
					<td><b>帳號權限:</b></td>
					<td>管理員(100)</td>
				</tr>
			</table>
			<table class="table table-bordered">
				<tr>
					<td>權限</td>
					<td>支援度</td>
				</tr>
				<tr>
					<td>控制後台</td>
					<td><span style="color:green;">V</span></td>
				</tr>
				<tr>
					<td>更新帳號資訊</td>
					<td><span style="color:green;">V</span></td>
				</tr>
				<tr>
					<td>短消息(發送、編輯/刪除)</td>
					<td><span style="color:green;">V</span></td>
				</tr>
				<tr>
					<td>討論區(發帖、編輯/刪除)</td>
					<td><span style="color:green;">V</span></td>
				</tr>
				<tr>
					<td>討論區(回覆、編輯/刪除)</td>
					<td><span style="color:green;">V</span></td>
				</tr>
			</table>
		<?php 
		}
		elseif($_SESSION[$config['cookie_prefix'].'mod']!=null)
		{
		?>
			<table class="table">
				<tr>
					<td><b>帳號:</b></td>
					<td><?php echo $username;?></td>
				</tr>
				<tr>
					<td><b>email:</b></td>
					<td><?php echo $row['email'];?></td>
				</tr>
				<tr>
					<td><b>帳號權限:</b></td>
					<td>會員討論區版主(50)</td>
				</tr>
			</table>
			<table class="table table-bordered">
				<tr>
					<td>權限</td>
					<td>支援度</td>
				</tr>
				<tr>
					<td>控制後台</td>
					<td><span style="color:red;">X</span></td>
				</tr>
				<tr>
					<td>更新帳號資訊</td>
					<td><span style="color:green;">V</span></td>
				</tr>
				<tr>
					<td>短消息(發送、編輯/刪除)</td>
					<td><span style="color:green;">V</span></td>
				</tr>
				<tr>
					<td>討論區(發帖、編輯/刪除)</td>
					<td><span style="color:green;">V，限自己管理的版區</span></td>
				</tr>
				<tr>
					<td>討論區(回覆、編輯/刪除)</td>
					<td><span style="color:green;">V，限自己管理的版區</span></td>
				</tr>
			</table>
		<?php 
		}
		elseif($_SESSION[$config['cookie_prefix'].'username']!=null)
		{
		?>
			<table class="table">
				<tr>
					<td><b>帳號:</b></td>
					<td><?php echo $username;?></td>
				</tr>
				<tr>
					<td><b>email:</b></td>
					<td><?php echo $row['email'];?></td>
				</tr>
				<tr>
					<td><b>帳號權限:</b></td>
					<td>一般會員(10)</td>
				</tr>
			</table>
			<table class="table table-bordered">
				<tr>
					<td>權限</td>
					<td>支援度</td>
				</tr>
				<tr>
					<td>控制後台</td>
					<td><span style="color:red;">X</span></td>
				</tr>
				<tr>
					<td>更新帳號資訊</td>
					<td><span style="color:green;">V</span></td>
				</tr>
				<tr>
					<td>短消息(發送、編輯/刪除)</td>
					<td><span style="color:green;">V</span></td>
				</tr>
				<tr>
					<td>討論區(發帖、編輯/刪除)</td>
					<td><span style="color:green;">V，限發帖</span></td>
				</tr>
				<tr>
					<td>討論區(回覆、編輯/刪除)</td>
					<td><span style="color:green;">V，限回覆</span></td>
				</tr>
			</table>
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