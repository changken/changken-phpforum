<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title>changken-phpforum-安裝導引-資料庫連接檔設定</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h2>changken-phpforum-安裝導引-資料庫連接檔設定</h2>
<hr><size=5>
<!--內容-->
<p>MySQL資料庫連線檔設定</p>
<p>請填寫正確！否則無法進行下一步安裝！</p>
<?php
$files="../mysql_connect.inc_setting.php";
if(!is_writable($files)){
echo "<font color=red>不可寫！！！</font>";
}else{
echo "<font color=green>可寫</font>";
}
?>
<form action="mysql-settingc.php" method="post">
<table border=1>
<tr>
<th>資料庫連接檔設定</th>
</tr>
<tr>
<td>MySQL資料庫地址:<input type="text" name="db_hostname"></td>
</tr>
<tr>
<td>MySQL資料庫名:<input type="text" name="db_name"></td>
</tr>
<tr>
<td>MySQL資料庫用戶名:<input type="text" name="db_username"></td>
</tr>
<tr>
<td>MySQL資料庫用戶密碼:<input type="password" name="db_password"></td>
</tr>
<tr>
<td><button type="submit" name="mysql-setting">下一步</button></td>
</tr>
</table>
</form>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>