<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title>changken-phpforum-安裝導引-網站參數設定</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h2>changken-phpforum-安裝導引-網站參數設定</h2>
<hr><size=5>
<!--內容-->
<p>網站參數設定</p>
<p>請填寫正確！</p>
<form action="settingc.php" method="post">
<table border=1>
<tr>
<th>網站參數設定</th>
</tr>
<tr>
<td>網站名稱:<input type="text" name="sitename"></td>
</tr>
<tr>
<td>網站網址:<input type="text" name="url">(http(s)://網址)</td>
</tr>
<tr>
<td>是否開放註冊:<input type="text" name="reg">(開放true，關閉false)</td>
</tr>
<tr>
<td>是否開放會員討論區:<input type="text" name="forum">(開放true，關閉false)</td>
</tr>
<tr>
<td>是否開放檔案上傳:<input type="text" name="upload">(開放true，關閉false)</td>
</tr>
<tr>
<td>檔案上傳最大限制:<input type="text" name="upload_max_size">(單位為B，102400000B為100MB)</td>
</tr>
<tr>
<td>是否開放會員私人短消息:<input type="text" name="user_pm">(開放true，關閉false)</td>
</tr>
<tr>
<td>是否開啟會員討論區版塊、會員討論區版塊帖子、部落格文章(外掛)網址偽靜態:<input type="text" name="url_static">(開放true，關閉false)</td>
</tr>
<tr>
<td><button type="submit" name="setting">設定</button></td>
</tr>
</table>
</form>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>