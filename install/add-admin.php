<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title>changken-phpforum-安裝導引-新增管理員</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h1>changken-phpforum-安裝導引-新增管理員</h1>
<hr><size=5>
<!--內容-->
<p>新增管理員，以便進入控制後台進行管理！</p>
<?php if($_GET['a']=="err1"){?>
<font color="red">錯誤！！管理員名稱絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="err2"){?>
<font color="red">錯誤！！密碼絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="err3"){?>
<font color="red">錯誤！！密碼(再輸入一次)絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="err4"){?>
<font color="red">錯誤！！密碼輸入不一致！！！</font>
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
<td><input type="hidden" name="level" value="100"/></td>
</tr>
<tr>
<td><input type="submit" name="button" value="確定" /></td>
</tr>
</table>
</form>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>