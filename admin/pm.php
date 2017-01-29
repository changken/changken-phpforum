<?php  
session_start();
require_once("../mysql_connect.inc.php"); 
require_once('../config.php');
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員私人短消息管理後台</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-會員私人短消息管理後台</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php 
	if($_SESSION[$config['cookie_prefix'].'admin'] != null)
	{
		$sql = "SELECT * FROM `".$prefix."user_pm` ORDER BY `NO` DESC;";
		$result = mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result)>0)
		{
	?>
			<p><a href="pm.php?a=open">清空會員私人短消息</a><br>
			<font color="red">警告！這將會員私人短消息清空，此動作無法回覆！！！</font></p>
	<?php 
		}
		else
		{
			echo"您目前不需要清理會員私人短消息！";
		}
		
		if($_GET['a']=="open")
		{			
			$sql="TRUNCATE TABLE `".$prefix."user_pm`;";
			if(mysqli_query($conn,$sql))
			{
				echo"執行成功！";
				echo"<meta http-equiv=REFRESH CONTENT=2;url=pm.php>";
			}
			else
			{
				echo"執行失敗！";
				echo"<meta http-equiv=REFRESH CONTENT=2;url=pm.php>";
			}
		}
		else
		{
		}
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