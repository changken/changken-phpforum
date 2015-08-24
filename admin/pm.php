<?php  
session_start();
include('../config.php');
include("../mysql_connect.inc.php"); 
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
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php 
	if($_SESSION['admin'] != null)
	{
		$sql="SELECT * FROM user_pm ORDER BY NO DESC;";
		$result=mysql_query($sql);
		if(mysql_num_rows($result)>0)
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
			$sql="TRUNCATE TABLE user_pm;";
			if(mysql_query($sql))
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
		echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
	}
?>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>