<?php 
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php"); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-首頁</title>
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
		<h1 class="text-center"><?php echo $config["sitename"];?>-首頁</h1>
		<?php include_once("nav.php");?><!--嵌入nav.php-->
		<hr>
		<!--內容-->
		<div class="jumbotron">
			<?php echo $config["homepage_welcome"];?><br />
			<p><a class="btn btn-primary btn-lg" href="reg.php" role="button">註冊</a></p>
		</div>
		<?php if($config["news"] == "true") {?>
		<h2>最新消息:</h2>
		<?php
		$sql = "SELECT * FROM `".$prefix."news` ORDER BY `NO` DESC;";
		$result = mysqli_query($conn,$sql);
		?>
		<table class="table">
			<tr>
				<td>標題</td>
				<td>內容</td>
				<td>時間</td>
			</tr>
		<?php
		$num = mysqli_num_rows($result);
		if($num>0) //檢查列數是否足夠
		{
			for($i=0;$i<$num;$i++)
			{
				$row = mysqli_fetch_array($result);
				echo "<tr>";
					echo "<td>".$row['title']."</td>";
					echo "<td>".$row['content']."</td>";
					echo "<td>".$row['time']."</td>";
				echo "</tr>";
			}
		}
		?>
		</table>
		<?php }else{} ?>
		<hr>
		<!--頁尾-->
		<?php include_once("cpf-footer.php");?>
	</div>
</body>

</html>