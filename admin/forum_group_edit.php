<?php  
session_start();
require_once("../mysql_connect.inc.php"); 
require_once('../config.php');
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員討論區編輯版塊</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-會員討論區編輯版塊</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php
	if($_SESSION[$config['cookie_prefix'].'admin'] != null)
	{
        //將$_GET['groupid']丟給$groupid
        //這樣在下SQL語法時才可以給搜尋的值
        $groupid = $_GET['groupid'];
        //若以下$NO直接用$_GET['groupid']將無法使用
        $sql = "SELECT * FROM `".$prefix."forum_group` WHERE `groupid`='$groupid';";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_row($result);
	?>
        <form name="form" method="post" action="forum_group_editc.php">
			<table border="1">		
				<tr>
					<td>版塊id</td>
					<td><input type="text" name="groupid" value="<?php echo $row[0];?>" readonly="readonly"/></td>
				</tr>
				<tr>
					<td>版塊名稱</td>
					<td><input type="text" name="groupname" value="<?php echo $row[1];?>" /></td>
				</tr>
				<tr>
					<td>版主</td>
					<td><input type="text" name="moderators" value="<?php echo $row[2];?>" /></td>
				</tr>
				<tr>
					<td>排序</td>
					<td><input type="text" name="order_id" value="<?php echo $row[3];?>" /></td>
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