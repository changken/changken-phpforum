<?php 
session_start();
require_once("../mysql_connect.inc.php");
require_once("../config.php"); 
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
	<hr><size=5>
	<!--內容-->
	<?php 
	if($_SESSION[$config["cookie_prefix"].'mod'] != null or $_SESSION[$config["cookie_prefix"].'admin'] != null)
	{ 
		if($_GET['action']=="reply")
		{
			$NO = $_GET['NO'];
			$sql = "SELECT * FROM `".$prefix."forum_posts_reply` WHERE `NO`='$NO';";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($result);
	?>
		<form name="form" method="post" action="forum_posts_deletec.php?action=reply">
			<table width="500" border="1" cellspacing="0" cellpadding="0">
				<tr>
					<td>要刪除的回覆</td>
					<td><input type="text" name="NO" value="<?php echo $_GET['NO'];?>" readonly="readonly" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="hidden" name="posts_id" value="<?php echo $row['posts_id'];?>"></td>
				</tr>
				<tr>			
					<td colspan="2"><input type="submit" name="button" value="刪除"/></td>
				</tr>
			</table>
		</form>
	<?php 
		}
		else
		{
			$NO = $_GET['NO'];
			$sql = "SELECT * FROM `".$prefix."forum_posts` WHERE `NO`='$NO';";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($result);
	?>
		<form name="form" method="post" action="forum_posts_deletec.php">
			<table width="500" border="1" cellspacing="0" cellpadding="0">
				<tr>
					<td>要刪除的帖子</td>
					<td><input type="text" name="NO" value="<?php echo $_GET['NO'];?>" readonly="readonly" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="hidden" name="groupid" value="<?php echo $row['groupid'];?>"></td>
				</tr>
				<tr>			
					<td colspan="2"><input type="submit" name="button" value="刪除"/></td>
				</tr>
			</table>
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
	<?php include_once("../cpf-footer.php");?>
</body>

</html>