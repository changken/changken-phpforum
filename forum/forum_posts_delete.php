<?php 
session_start();
include('../config.php'); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-會員討論區刪除帖子</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css">
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-會員討論區刪除帖子</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php 
if($_SESSION['mod'] != null or $_SESSION['admin'] != null)
{ 
	if($_GET['action']=="reply")
	{
?>
<form name="form" method="post" action="forum_posts_deletec.php?action=reply">
要刪除的回覆：<input type="text" name="NO" value="<?php echo $_GET['NO'];?>" readonly="readonly" /> <br />
<input type="submit" name="button" value="刪除"/>
</form>
<?php 
	}
	else
	{
?>
<form name="form" method="post" action="forum_posts_deletec.php">
要刪除的帖子：<input type="text" name="NO" value="<?php echo $_GET['NO'];?>" readonly="readonly" /> <br />
<input type="submit" name="button" value="刪除"/>
</form>
<?php 
	}
}
else
{
	echo '您無權限觀看此頁面!!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>