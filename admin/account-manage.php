<?php  
session_start();
require_once("../mysql_connect.inc.php"); 
require_once('../config.php'); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-帳號管理</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-帳號管理</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php 
	if($_SESSION[$config['cookie_prefix'].'admin'] != null)
	{
		$sql = "SELECT * FROM `".$prefix."user` ORDER BY `NO` DESC;";
		$result = mysqli_query($conn,$sql);
	?>
	<table width="500" border="1" cellspacing="0" cellpadding="0">
		<tr>
			<td>帳號</td>
			<td>email</td>
			<td>權限</td>
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
                <td><?php echo $row['username'];?></td>
				<td><?php echo $row['email'];?></td>
                <td><?php echo $row['level'];?></td>
				<td><a href="member_edit.php?NO=<?php echo $row['NO'];?>"><b>編輯</b></a></td>
				<td><a href="member_delete.php?NO=<?php echo $row['NO'];?>"><b>刪除</b></a></td>
            </tr>
	<?php
		}
	}
	?>
	</table>
	<hr><size=5>
		<form name="form" method="post" action="account-managec.php">
			<table border="1">
				<tr>
					<th colspan="2">新增帳號</th>
				</tr>
				<tr>
					<td>帳號</td>
					<td><input type="text" name="username" /></td>
				</tr>
				<tr>
					<td>email</td>
					<td><input type="text" name="email" /></td>
				</tr>
				<tr>
					<td>密碼</td>
					<td><input type="password" name="password" /></td>
				</tr>
				<tr>
					<td>再一次輸入密碼</td>
					<td><input type="password" name="password2" /></td>
				</tr>
				<tr>
					<td>會員權限:</td>
					<td>
						<select name="level">
							<option value="10">一般會員</option>
							<option value="50">會員討論區版主</option>
							<option value="100">管理員</option>
						</select>
					</td>
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