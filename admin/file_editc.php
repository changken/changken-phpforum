<?php 
header("Content-Type:text/html; charset=utf-8");
session_start();
include("../mysql_connect.inc.php");

$NO = $_POST['NO'];
$filename = $_POST['filename'];
$username = $_POST['username'];
$filetype = $_POST['filetype'];
$filesize = $_POST['filesize'];
$ifshare = $_POST['ifshare'];
$old_filename = $_POST['old_filename'];
 
if($_SESSION['admin'] != null)
{   
        //更新資料庫資料語法
        $sql = "UPDATE file SET filename='$filename', username='$username', filetype='$filetype', filesize='$filesize', ifshare='$ifshare' WHERE NO='$NO';";
        if(mysql_query($sql))
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=file.php>';
                rename("../file/$old_filename","../file/$filename");
        }
        else
        {
                echo '修改失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=file.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>