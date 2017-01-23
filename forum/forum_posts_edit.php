<?php
session_start();
require_once("../mysql_connect.inc.php");
require_once("../config.php"); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員討論區編輯帖子</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style.css">
	<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-會員討論區編輯帖子</h1>
	<hr><size=5>
	<!--內容-->
	<?php
	if($_SESSION[$config["cookie_prefix"].'mod'] != null or $_SESSION[$config["cookie_prefix"].'admin'] != null)
	{
		if($_GET['action']=="reply")
		{
			//將$_GET['NO']丟給$NO
			//這樣在下SQL語法時才可以給搜尋的值
			$NO = $_GET['NO'];
			//若以下$NO直接用$_GET['NO']將無法使用
			$sql = "SELECT * FROM `".$prefix."forum_posts_reply` WHERE `NO`='$NO';";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($result);
	?>
		<form name="form" method="post" action="forum_posts_editc.php?action=reply">
			<table width="500" border="1" cellspacing="0" cellpadding="0">
				<tr>
					<td>NO</td>
					<td><input type="text" name="NO" value="<?php echo $row['NO'];?>" readonly="readonly" /></td>
				</tr>
				<tr>
					<td>所屬帖子</td>
					<td><input type="text" name="posts_id" value="<?php echo $row['posts_id'];?>" /></td>
				</tr>
				<tr>				
					<td>作者</td>
					<td><input type="text" name="name" value="<?php echo $row['name'];?>" /></td>
				</tr>
				<tr>				
					<td>email</td>
					<td><input type="text" name="email" value="<?php echo $row['email'];?>" /></td>
				</tr>
				<tr>
					<td>標題</td>
					<td><input type="text" name="title" value="<?php echo $row['title'];?>" /></td>
				</tr>
				<tr>
					<td>內容</td>
					<td><textarea name="content" cols="45" rows="5" id="posts_edit"><?php echo $row['content'];?></textarea></td>
				</tr>
				<tr>
					<td>發表時間</td>
					<td><input type="text" name="time" value="<?php echo $row['time'];?>" readonly="readonly" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="button" value="確定" /></td>
				</tr>
			</table>
		</form>
		<?php	
		}
		else
		{
			//將$_GET['NO']丟給$NO
			//這樣在下SQL語法時才可以給搜尋的值
			$NO = $_GET['NO'];
			//若以下$NO直接用$_GET['NO']將無法使用
			$sql = "SELECT * FROM `".$prefix."forum_posts` WHERE `NO`='$NO';";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($result);
		?>
		<form name="form" method="post" action="forum_posts_editc.php">
			<table width="500" border="1" cellspacing="0" cellpadding="0">
				<tr>
					<td>NO</td>
					<td><input type="text" name="NO" value="<?php echo $row['NO'];?>" readonly="readonly" /></td>
				</tr>
				<tr>
					<td>所屬版塊</td>
					<td><input type="text" name="groupid" value="<?php echo $row['groupid'];?>" /></td>
				</tr>
				<tr>				
					<td>作者</td>
					<td><input type="text" name="name" value="<?php echo $row['name'];?>" /></td>
				</tr>
				<tr>				
					<td>email</td>
					<td><input type="text" name="email" value="<?php echo $row['email'];?>" /></td>
				</tr>
				<tr>
					<td>標題</td>
					<td><input type="text" name="title" value="<?php echo $row['title'];?>" /></td>
				</tr>
				<tr>
					<td>內容</td>
					<td><textarea name="content" cols="45" rows="5" id="posts_edit"><?php echo $row['content'];?></textarea></td>
				</tr>
				<tr>
					<td>發表時間</td>
					<td><input type="text" name="time" value="<?php echo $row['time'];?>" readonly="readonly" /></td>
				</tr>
				<tr>
					<td>是否置頂(是，填true；否，留空或填false)</td>
					<td><input type="text" name="top" value="<?php echo $row['top'];?>" /></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="button" value="確定" /></td>
				</tr>
			</table>
		</form>
	<?php
		}
	}
	else
	{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
	}
	?>
		<script>
			CKEDITOR.replace('posts_edit');
		</script>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("../cpf-footer.php");?>
</body>

</html>