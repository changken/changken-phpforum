<?php
session_start();
require_once("../mysql_connect.inc.php");
require_once('../config.php');
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-外掛管理頁面</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-外掛管理頁面</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php 
	if($_SESSION[$config["cookie_prefix"].'admin'] != null)
	{
	?>
		<table width="500" border="1" cellspacing="0" cellpadding="0">
			<tr>
				<td>外掛名稱</td>
				<td>外掛作者</td>
				<td>外掛版本</td>
				<td>外掛更新日期</td>
				<td>前台網址</td>
				<td>後台網址</td>
				<td>安裝</td>
				<td>卸載</td>
				<td>升級</td>
			</tr>
	<?php
		$source = glob('../plugin/*/info.php');
		$j = count($source);
		for($i=0;$i<$j;$i++)
		{
			include_once($source[$i]);
	?>
            <tr>
				<td><?php echo $cpf_plugin['name'];?></td>
				<td><?php echo $cpf_plugin['author'];?></td>
				<td><?php echo $cpf_plugin['version'];?></td>
                <td><?php echo $cpf_plugin['update_date'];?></td>
				<td><a href="../plugin/<?php echo $cpf_plugin['filename'];?>"><b>前台網址</b></a></td>
				<td><a href="../plugin/<?php echo $cpf_plugin['filename'];?>/admin"><b>後台網址</b></a></td>
				<?php if(file_exists('../plugin/'.$cpf_plugin['filename'].'/install.php')){?>
					<td><a href="../plugin/<?php echo $cpf_plugin['filename'];?>/install.php"><b>安裝</b></a></td>
				<?php }else{?>
					<td><span style="color:red;">X</span></td>
				<?php }?>
				<td><a href="../plugin/<?php echo $cpf_plugin['filename'];?>/uninstall.php"><b>卸載</b></a></td>
				<?php if(file_exists('../plugin/'.$cpf_plugin['filename'].'/upgrade.php')){?>
					<td><a href="../plugin/<?php echo $cpf_plugin['filename'];?>/upgrade.php"><b>升級</b></a></td>
				<?php }else{?>
					<td><span style="color:red;">X</span></td>
				<?php }?>
			</tr>
	<?php
		}
	?>
		</table>
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