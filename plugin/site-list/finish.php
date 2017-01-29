<?php
session_start();
require_once("../../mysql_connect.inc.php");
require_once("../../config.php");
require_once("info.php");
?>
<!DOCTYPE html>
<html lang="zh_TW">

<head>
	<title><?php echo $config["sitename"];?>-交換連結系統-新增中</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../../style.css">
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-交換連結系統-新增中</h1>
	<hr><size=5>
	<!--內容-->
	<?php
	$sitename = mysqli_real_escape_string($conn,$_POST['sitename']);
	$siteurl = mysqli_real_escape_string($conn,$_POST['siteurl']);
	$siteinfo = mysqli_real_escape_string($conn,$_POST['siteinfo']);

		$sql="INSERT INTO `".$prefix."site_list` (`sitename`,`siteurl`,`siteinfo`) VALUES ('$sitename','$siteurl','$siteinfo');";
        if(mysqli_query($conn,$sql))
        {
			echo '新增成功!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        else
        {
			echo '新增失敗!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
	?>
	<hr><size=5>
	<!--頁尾-->
	Powered By 交換連結系統 <?php echo $cpf_plugin['version'];?> (Made by Changken)<br />
	<?php include_once('../../cpf-footer.php');?>
</body>

</html>