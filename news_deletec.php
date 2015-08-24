<?php 
header("Content-Type:text/html; charset=utf-8"); 
session_start(); 

include("mysql_connect.inc.php");
$NO = $_POST['NO'];

if($_SESSION['admin'] != null)
{
        //刪除資料庫資料語法
        $sql = "DELETE FROM news WHERE NO='$NO';";
        if(mysql_query($sql))
        {
                echo '刪除成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        else
        {
                echo '刪除失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>