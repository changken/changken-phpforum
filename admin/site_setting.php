<?php  
session_start();
require_once("../mysql_connect.inc.php"); 
require_once('../config.php'); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-網站參數設定</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-網站參數設定</h1>
	<?php include("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php 
	if($_SESSION[$config['cookie_prefix'].'admin'] != null)
	{
		$sql = "SELECT * FROM `".$prefix."setting` ORDER BY `NO` ASC;";
		$result = mysqli_query($conn,$sql);
	?>
		<table width="500" border="1" cellspacing="0" cellpadding="0">
			<tr>
				<td>參數名稱</td>
				<td>數值</td>
				<td>參數說明</td>
				<td>編輯</td>
			</tr>
	<?php
	$num = mysqli_num_rows($result);
	if($num>0)
	{
        for($i=0;$i<$num;$i++)
		{
			$row = mysqli_fetch_array($result);
	?>
			<tr>
				<td><?php echo $row['name'];?></td>
                <td><?php echo $row['value'];?></td>
				<td><?php echo $row['note'];?></td>
				<td><a href="site_setting_edit.php?NO=<?php echo $row['NO']?>"><b>編輯</b></a></td>
			</tr>
    <?php    
		}
	}
	?>
		</table>
	<?php
	}
	else
	{
		header("location:../login.php");
	}
	?>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("../cpf-footer.php");?>
</body>

</html>