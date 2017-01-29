<?php  
session_start();
require_once("../mysql_connect.inc.php"); 
require_once('../config.php'); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-網站參數編輯</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-網站參數編輯</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php
	if($_SESSION[$config['cookie_prefix'].'admin'] != null)
	{
        //將$_GET['NO']丟給$NO
        //這樣在下SQL語法時才可以給搜尋的值
        $NO = $_GET['NO'];
        //若以下$NO直接用$_GET['NO']將無法使用
        $sql = "SELECT * FROM `".$prefix."setting` WHERE `NO`='$NO';";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_row($result);
	?>
        <form name="form" method="post" action="site_setting_editc.php">
        	<table border="1">
				<tr>
					<td>NO</td>
					<td><input type="text" name="NO" value="<?php echo $row[0];?>" readonly="readonly"/></td>
				</tr>
				<tr>
					<td>參數名稱</td>
					<td><input type="text" name="name" value="<?php echo $row[1];?>" readonly="readonly"/></td>
				</tr>
				<tr>
					<td>數值</td>
					<td><input type="text" name="value" value="<?php echo $row[2];?>" /></td>
				</tr>
				<tr>
					<td>參數說明</td>
					<td><textarea cols="60" rows="6" name="note" readonly="readonly"><?php echo $row[3];?></textarea></td>
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
		header("location:../login.php");
	}
	?>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("../cpf-footer.php");?>
</body>

</html>