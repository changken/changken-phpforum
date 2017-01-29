<?php
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php"); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-外掛列表頁面</title>
	<meta charset="utf-8"/>
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
		<h1 class="text-center"><?php echo $config["sitename"];?>-外掛列表頁面</h1>
		<?php include_once("nav.php");?><!--嵌入nav.php-->
		<hr><size=5>
		<!--內容-->
			<table class="table table-bordered">
				<tr>
					<td>外掛名稱</td>
					<td>網址</td>
				</tr>
		<?php
			$source = glob('plugin/*/info.php');
			$j = count($source);
			for($i=0;$i<$j;$i++)
			{
				include_once($source[$i]);
		?>
				<tr>
					<td><?php echo $cpf_plugin['name'];?></td>
					<td><a href="plugin/<?php echo $cpf_plugin['filename'];?>" target="_blank"><b>網址</b></a></td>
				</tr>
		<?php
			}
		?>
			</table>
		<hr><size=5>
		<!--頁尾-->
		<?php include_once("cpf-footer.php");?>
	</div>
</body>

</html>