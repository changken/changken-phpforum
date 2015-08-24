<?php  
session_start();
include('../config.php');
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-新增管理員</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-新增管理員</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<?php 
if($_SESSION['admin'] != null)
{
?>  
<!--內容-->
<?php if($_GET['a']=="err1"){?>
<font color="red">錯誤！！管理員名稱絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="err2"){?>
<font color="red">錯誤！！密碼絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="err3"){?>
<font color="red">錯誤！！密碼(在輸入一次)絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="err4"){?>
<font color="red">錯誤！！密碼輸入不一致！！！</font>
<?php }elseif($_GET['a']=="err5"){?>
<font color="red">錯誤！！該名稱已被使用了！！！</font>
<?php }else{}?>
<form name="form" method="post" action="add-adminc.php">
<table border=1>
<tr>
<th>新增管理員</th>
</tr>
<tr>
<td>帳號：<input type="text" name="adminname" /></td>
</tr>
<tr>
<td>email：<input type="text" name="email" /></td>
</tr>
<tr>
<td>密碼：<input type="password" name="password" /></td>
</tr>
<tr>
<td>再一次輸入密碼：<input type="password" name="password2" /></td>
</tr>
<tr>
<td>
會員權限:
<select name="level">
<option value="10">一般會員</option>
<option value="50">會員討論區版主</option>
<option value="100">管理員</option>
</select>
</td>
</tr>
<tr>
<td><input type="submit" name="button" value="確定" /></td>
</tr>
</table>
</form>
<hr><size=5>
<?php if($_GET['a']=="check1"){?>
<font color="red">錯誤！！管理員名稱絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="check2"){?>
<font color="green">管理員名稱可用！！！</font>
<?php }elseif($_GET['a']=="check3"){?>
<font color="red">管理員名稱不可用！！！</font>
<?php }else{}?>
<form name="form" method="post" action="admin_check.php">
<table border=1>
<tr>
<th>帳號檢查是否可用</th>
</tr>
<tr>
<td>帳號：<input type="text" name="adminname" /></td>
</tr>
<tr>
<td><input type="submit" name="button" value="檢查" /></td>
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
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>