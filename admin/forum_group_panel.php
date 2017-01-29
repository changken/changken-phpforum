<?php  
session_start();
require_once("../mysql_connect.inc.php"); 
require_once('../config.php');
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員討論區-管理後台</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-會員討論區-管理後台</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php 
	if($_SESSION[$config['cookie_prefix'].'admin'] != null)
	{
		$sql="SELECT * FROM `".$prefix."forum_group` ORDER BY `order_id` ASC;";
		$result = mysqli_query($conn,$sql);
	?>
		<table width="500" border="1" cellspacing="0" cellpadding="0">
			<tr>
				<td>版塊名稱</td>
				<td>版主</td>
				<td>排序</td>
				<td>編輯</td>
				<td>刪除</td>
			</tr> 
	<?php
	$num = mysqli_num_rows($result);
	if($num>0)
	{
        for($i=0;$i<$num;$i++)
		{
            $row = mysqli_fetch_array($result);
	?>
			<tr>
				<td><?php echo $row['groupname'];?></td>
				<td><?php echo $row['moderators'];?></td>
				<td><?php echo $row['order_id'];?></td>
				<td><a href="forum_group_edit.php?groupid=<?php echo $row['groupid'];?>"><b>編輯</b></a></td>
				<td><a href="forum_group_delete.php?groupid=<?php echo $row['groupid'];?>"><b>刪除</b></a></td>
			</tr>
	<?php 
		}
	}
	?>
		</table>
	<hr><size=5>
	<form name="form" method="post" action="forum_group_panelc.php">
		<table border="1">
			<tr>
				<th colspan="2">新增版塊</th>
			</tr>
			<tr>
				<td>版塊名稱:</td>
				<td><input type="text" name="groupname"></td>
			</tr>
			<tr>
				<td>版主:</td>
				<td><input type="text" name="moderators"></td>
			</tr>
			<tr>
				<td>排序:</td>
				<td><input type="text" name="order_id"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="新增"><input type="reset" value="重新填寫" ></td>
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