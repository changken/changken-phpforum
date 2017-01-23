<?php 
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php"); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員私人短消息編輯消息</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
	<script src="//cdn.ckeditor.com/4.4.7/basic/ckeditor.js"></script>
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-會員私人短消息編輯消息</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php
	if($_SESSION[$config['cookie_prefix'].'username'] != null)
	{
        //將$_GET['NO']丟給$NO
        //這樣在下SQL語法時才可以給搜尋的值
        $NO = $_GET['NO'];
        //若以下$NO直接用$_GET['NO']將無法使用
        $sql = "SELECT * FROM `".$prefix."user_pm` WHERE `NO`='$NO';";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_row($result);
    ?>
		<form name="form" method="post" action="user_pm_editc.php">
			<table width="500" border="1" cellspacing="0" cellpadding="0">
				<tr>
					<td>NO</td>
					<td><input type="text" name="NO" value="<?php echo $row[0];?>" readonly="readonly" /></td>
				</tr>
				<tr>
					<td>寄件人帳號</td>
					<td><input type="text" name="send_from" value="<?php echo $row[1];?>" /></td>
				</tr>
				<tr>				
					<td>收件人帳號</td>
					<td><input type="text" name="send_to" value="<?php echo $row[2];?>" /></td>
				</tr>
				<tr>
					<td>標題</td>
					<td><input type="text" name="title" value="<?php echo $row[3];?>" /></td>
				</tr>
				<tr>
					<td>內容</td>
					<td><textarea name="content" cols="45" rows="5" id="pm"><?php echo $row[4];?></textarea></td>
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
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
	}
	?>
	<script>
		CKEDITOR.replace('pm');
	</script>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("cpf-footer.php");?>
</body>

</html>