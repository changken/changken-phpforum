<?php
include("../mysql_connect.inc.php");
$adminname = $_POST['adminname'];

//搜尋資料庫資料
$sql = "SELECT * FROM user WHERE username = '$adminname';";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);

if($_POST['adminname']==null || $_POST['adminname']=="")//檢查使用者名稱是否為空
{
header("Location:add-admin.php?a=check1");
}
elseif($row[1]==null)//檢查使用者名稱是否已經被使用了
{
header("Location:add-admin.php?a=check2");
}
elseif($row[1]!=null)//檢查使用者名稱是否已經被使用了
{
header("Location:add-admin.php?a=check3");
}
else
{
header("Location:add-admin.php");
}
?>
