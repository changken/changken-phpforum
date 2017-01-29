<?php 
session_start();
require_once("../../mysql_connect.inc.php");
require_once("../../config.php");
require_once("info.php");
?>
<!DOCTYPE html>
<html lang="zh_TW">

<head>
	<title><?php echo $config["sitename"];?>-交換連結系統</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../style.css">
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-交換連結系統</h1>
	<p><a href="<?php echo $config["url"];?>/index.php">回首頁</a></p>
	<hr><size=5>
	<!--內容-->
	<h1>網站列表:</h1>
	<?php
	if(file_exists('install.lock'))
	{
		$sql = "SELECT * FROM `".$prefix."site_list` ORDER BY `NO` DESC;";
		$result = mysqli_query($conn,$sql);
	?>
		<table width="500" border="1" cellspacing="0" cellpadding="0">
			<tr>
				<td>網站名稱</td>
				<td>網站網址</td>
				<td>網站簡介</td>
			</tr>
	<?php
	$num = mysqli_num_rows($result);
	if($num>0)
	{
        for($i=0;$i<$num;$i++)
		{
			$row = mysqli_fetch_array($result);
			echo "<tr>";
				echo "<td>".$row['sitename']."</td>";
				echo "<td><a href='".$row['siteurl']."' target='_blank'>".$row['siteurl']."</a></td>";
				echo "<td>".$row['siteinfo']."</td>";
			echo "</tr>";
        }
	}
	?>
		</table>
	<hr><size=5>
	<form action="finish.php" method="post">
		<table border="1">
			<tr>
				<td>網站名稱</td>
				<td><input type="text" name="sitename"></td>
			</tr>
			<tr>
				<td>網站網址</td>
				<td><input type="text" name="siteurl"></td>
			</tr>
			<tr>
				<td>網站簡介</td>
				<td><textarea name="siteinfo" cols="45" rows="5"></textarea></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="submit" value="新增" ></td>
			</tr>
		</table>
	</form>
	<?php }else{echo "本外掛沒有被安裝！";} ?>
	<hr><size=5>
	<!--頁尾-->
	Powered By 交換連結系統 <?php echo $cpf_plugin['version'];?> (Made by Changken)<br />
	<?php include_once('../../cpf-footer.php');?>
</body>

</html>