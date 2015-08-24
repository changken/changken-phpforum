<?php 
session_start();
include('config.php'); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-會員註冊</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-會員註冊</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php if($config["reg"]=="true"){ ?>
<?php if($_GET['a']=="err1"){?>
<font color="red">錯誤！！使用者名稱絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="err2"){?>
<font color="red">錯誤！！密碼絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="err3"){?>
<font color="red">錯誤！！密碼(再輸入一次)絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="err4"){?>
<font color="red">錯誤！！密碼輸入不一致！！！</font>
<?php }elseif($_GET['a']=="err5"){?>
<font color="red">錯誤！！該名稱已被使用了！！！</font>
<?php }else{}?>
<form name="form" method="post" action="regc.php">
<table border=1>
<tr>
<th>會員註冊</th>
</tr>
<tr>
<td>帳號：<input type="text" name="username" /></td>
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
<td><input type="submit" name="button" value="註冊" /></td>
</tr>
</table>
</form>
<hr><size=5>
<?php if($_GET['a']=="check1"){?>
<font color="red">錯誤！！使用者名稱絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="check2"){?>
<font color="green">使用者名稱可用！！！</font>
<?php }elseif($_GET['a']=="check3"){?>
<font color="red">使用者名稱不可用！！！</font>
<?php }else{}?>
<form name="form" method="post" action="member_check.php">
<table border=1>
<tr>
<th>帳號檢查是否可用</th>
</tr>
<tr>
<td>帳號：<input type="text" name="username" /></td>
</tr>
<tr>
<td><input type="submit" name="button" value="檢查" /></td>
</tr>
</table>
</form>
<?php }else{echo "很抱歉，".$config["sitename"]."已經關閉註冊";} ?>
<hr><size=5>
<!--頁尾-->
<?php include("cpf-footer.php");?>
</body>

</html>