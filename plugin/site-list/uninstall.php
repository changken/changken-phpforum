<?php
session_start();
require_once("../../mysql_connect.inc.php");
require_once("info.php");
?>
<!DOCTYPE html>
<html lang="zh_TW">

<head>
	<title>changken-phpforum-交換連結系統-卸載導向</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../../style.css">
</head>

<body>
	<!--標題-->
	<h1>changken-phpforum-交換連結系統-卸載導向</h1>
	<hr><size=5>
	<!--內容-->
	<p>歡迎使用changken-phpforum-交換連結系統-卸載導向！</p>
	<p>本卸載導向可以幫助您卸載交換連結系統外掛！</p>
	<p>卸載完，會自動刪除外掛在資料庫內的相關資料，但不包含外掛本身資料(請自行手動刪除)！</p>
	<p><a href="uninstall.php?a=uninstall">開始卸載</a></p>
	<?php 
	if($_GET['a']=="uninstall")
	{
		$sql[] = "DROP TABLE `".$prefix."site_list`;";
		foreach($sql as $val)
		{
			if(mysqli_query($conn,$val))
			{
				echo"卸載成功！本卸載程序會自動改名為uninstall.lock！若需要再次卸載請改名為uninstall.php！";
				rename("uninstall.php","uninstall.lock");
			}
			else
			{
				echo"卸載失敗！<a href='uninstall.php'>返回，上一頁</a>";
			}
		}
	}
	else
	{}
	?>
	<hr><size=5>
	Powered By 交換連結系統 <?php echo $cpf_plugin['version'];?> (Made by Changken)<br />v
	<?php include_once('../../cpf-footer.php');?>
</body>

</html>