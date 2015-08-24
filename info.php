<?php 
session_start();
include('config.php'); 
include("mysql_connect.inc.php");
$adminname = $_SESSION['admin'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-會員帳號資訊</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-會員帳號資訊</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php 
if($_SESSION['admin']!=null)
{
?>
	<b>帳號:</b><?php echo $adminname;?><br />
	<?php   
	$sql = "SELECT * FROM user WHERE username='$adminname';";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	?>
	<b>email:</b><?php echo $row[2];?><br />
	<b>帳號權限:</b>管理員(<?php echo $row[4];?>)<br />
<?php 
}
elseif($_SESSION['mod']!=null)
{
?>
	<b>帳號:</b><?php echo $username;?><br />
	<?php   
	$sql = "SELECT * FROM user WHERE username='$username';";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	?>
	<b>email:</b><?php echo $row[2];?><br />
	<b>帳號權限:</b>會員討論區版塊版主(<?php echo $row[4];?>)<br />
<?php 
}
elseif($_SESSION['username']!=null)
{
?>
	<h2>帳號:</b><?php echo $username;?><br />
	<?php   
	$sql = "SELECT * FROM user WHERE username='$username';";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	?>
	<b>email:</b><?php echo $row[2];?><br />
	<b>帳號權限:</b>一般會員(<?php echo $row[4];?>)<br />
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
<?php include("cpf-footer.php");?>
</body>

</html>