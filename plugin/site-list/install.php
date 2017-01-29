<?php
session_start();
require_once("../../mysql_connect.inc.php");
require_once("info.php");
?>
<!DOCTYPE html>
<html lang="zh_TW">

<head>
	<title>changken-phpforum-交換連結系統-安裝導向</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../../style.css">
</head>

<body>
	<!--標題-->
	<h1>changken-phpforum-交換連結系統-安裝導向</h1>
	<hr><size=5>
	<!--內容-->
	<p>歡迎使用changken-phpforum-交換連結系統-安裝導向！</p>
	<p>本安裝導向可以幫助您安裝交換連結系統外掛！</p>
	<p>安裝完，請將install.php刪除！</p>
	<p><a href="install.php?a=install">開始安裝</a></p>
	<?php 
	if($_GET['a']=="install")
	{
		$sql[] = "CREATE TABLE IF NOT EXISTS `".$prefix."site_list` (
		`NO` int(6) NOT NULL AUTO_INCREMENT,
		`sitename` char(30) COLLATE utf8_unicode_ci NOT NULL,
		`siteurl` char(100) COLLATE utf8_unicode_ci NOT NULL,
		`siteinfo` text COLLATE utf8_unicode_ci NOT NULL,
		PRIMARY KEY (`NO`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;";
		foreach($sql as $val)
		{
			if(mysqli_query($conn,$val))
			{
				echo"安裝成功！本安裝程序會自動改名為install.lock！若需要再次安裝請改名為install.php！";
				rename("install.php","install.lock");
			}
			else
			{
				echo"安裝失敗！<a href='install.php'>返回，上一頁</a>";
			}
		}
	}
	else
	{}
	?>
	<hr><size=5>
	<!--頁尾-->
	Powered By 交換連結系統 <?php echo $cpf_plugin['version'];?> (Made by Changken)<br />
	<?php include_once('../../cpf-footer.php');?>
</body>

</html>