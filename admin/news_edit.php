<?php 
session_start();
require_once("../mysql_connect.inc.php");
require_once('../config.php');
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-最新消息編輯</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style.css" />
	<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-最新消息編輯</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php
	if($_SESSION[$config["cookie_prefix"].'admin'] != null)
	{
        //將$_GET['NO']丟給$NO
        //這樣在下SQL語法時才可以給搜尋的值
        $NO = $_GET['NO'];
        //若以下$NO直接用$_GET['NO']將無法使用
        $sql = "SELECT * FROM `".$prefix."news` WHERE `NO`='$NO';";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_row($result);
	?>
		<form name="form" method="post" action="news_editc.php">
			<table border="1">
				<tr>
					<td>NO:</td>
					<td><input type="text" name="NO" value="<?php echo $row[0];?>" readonly="readonly"></td>
				</tr>
				<tr>
					<td>標題:</td>
					<td><input type="text" name="title" value="<?php echo $row[1];?>"></td>
				</tr>
				<tr>
					<td>內容:</td> 
					<td><textarea cols="60" rows="6" name="content" id="news"><?php echo $row[2];?></textarea></td>
				</tr>
				<tr>
					<td>時間:</td>
					<td><input type="text" name="time" value="<?php echo $row[3];?>" readonly="readonly"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="編輯"></td>
				</tr>
			</table>
		</form>
	<?php
	}
	else
	{
		header("location:../login.php");
	}
	?>
	<script>
		CKEDITOR.replace('news');
	</script>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("../cpf-footer.php");?>
</body>

</html>