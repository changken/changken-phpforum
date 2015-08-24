<?php
session_start();
include('config.php'); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-會員私人短消息刪除消息</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-會員私人短消息刪除消息</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php
if($_SESSION['username'] != null)
{
?>
	<form name="form" method="post" action="user_pm_deletec.php">
	要刪除的消息：<input type="text" name="NO" value="<?php echo $_GET['NO'];?>" readonly="readonly" /> <br />
	<input type="submit" name="button" value="刪除"/>
	</form>
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