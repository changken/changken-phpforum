<?php
include("mysql_connect.inc.php");
$username = $_POST['username'];

//搜尋資料庫資料
$sql = "SELECT * FROM user WHERE username = '$username';";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);

if($_POST['username']==null || $_POST['username']=="")//檢查使用者名稱是否為空
{
header("Location:reg.php?a=check1");
}
elseif($row[1]==null)//檢查使用者名稱是否已經被使用了
{
header("Location:reg.php?a=check2");
}
elseif($row[1]!=null)//檢查使用者名稱是否已經被使用了
{
header("Location:reg.php?a=check3");
}
else
{
header("Location:reg.php");
}
?>