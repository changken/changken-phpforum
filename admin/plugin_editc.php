<?php 
header("Content-Type:text/html; charset=utf-8");
session_start();
include("../mysql_connect.inc.php");

$NO = $_POST['NO'];
$name = $_POST['name'];
$writer = $_POST['writer'];
$version = $_POST['version'];
$update_date = $_POST['update_date'];
$mode = $_POST['mode'];
$filename = $_POST['filename'];
 
if($_SESSION['admin'] != null)
{   
        //更新資料庫資料語法
        $sql = "UPDATE plugin SET name='$name', writer='$writer', version='$version', update_date='$update_date', mode='$mode', filename='$filename' WHERE NO='$NO';";
        if(mysql_query($sql))
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=plugin.php>';
        }
        else
        {
                echo '修改失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=plugin.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
}
?>