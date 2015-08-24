<?php 
header("Content-Type:text/html; charset=utf-8");
session_start();
include("../mysql_connect.inc.php");

$NO = $_POST['NO'];
$name = $_POST['name'];
$value = $_POST['value'];
$note = $_POST['note'];
 
if($_SESSION['admin'] != null)
{   
        //更新資料庫資料語法
        $sql = "UPDATE setting SET name='$name', value='$value', note='$note' WHERE NO='$NO';";
        if(mysql_query($sql))
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=site_setting.php>';
        }
        else
        {
                echo '修改失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=site_setting.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
}
?>