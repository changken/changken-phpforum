<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title>changken-phpforum-安裝導引-網站設定-完成</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h2>changken-phpforum-安裝導引-網站設定-完成</h2>
<hr><size=5>
<!--內容-->
<?php
include("../mysql_connect.inc.php");
$sitename = $_POST['sitename'];
$url = $_POST['url'];
$reg = $_POST['reg'];
$forum = $_POST['forum'];
$upload = $_POST['upload'];
$upload_max_size = $_POST['upload_max_size'];
$user_pm = $_POST['user_pm'];
$url_static = $_POST['url_static'];

$sql="INSERT INTO `setting` (`NO`, `name`, `value`, `note`) VALUES
(1, 'sitename', '$sitename', '網站名稱，純文字'),
(2, 'url', '$url', '網站網址'),
(3, 'reg', '$reg', '是否開放註冊，開放為true，關閉為false'),
(4, 'forum', '$forum', '是否開啟會員討論區，開啟為true，關閉為false'),
(5, 'upload', '$upload', '是否開啟檔案上傳，開啟為true，關閉為false'),
(6, 'upload-max-size', '$upload_max_size', '檔案上傳最大限制，單位為B，102400000B為100MB'),
(7, 'user_pm', '$user_pm', '是否開啟會員私人短消息，開啟為true，關閉為false'),
(8, 'url_static', '$url_static', '是否開啟會員討論區版塊、會員討論區版塊帖子、部落格文章(外掛)網址偽靜態，開啟為true，關閉為false');";
if(mysql_query($sql))
{
echo"設定成功！";
echo"<a href='add-admin.php'>下一步，新增管理員</a>";
}
else
{
echo"設定失敗！";
echo"<a href='install.php'>上一步，安裝</a>";
}
?>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>