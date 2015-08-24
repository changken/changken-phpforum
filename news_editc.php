<?php 
header("Content-Type:text/html; charset=utf-8"); 
session_start();

include("mysql_connect.inc.php");

$NO = $_POST['NO'];
$title = mysql_real_escape_string($_POST['title']);
$content = mysql_real_escape_string($_POST['content']);
$time = $_POST['time'];
 
if($_SESSION['admin'] != null)
{   
        //更新資料庫資料語法
        $sql = "UPDATE news SET title='$title', content='$content', time='$time' WHERE NO='$NO';";
        if(mysql_query($sql))
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        else
        {
                echo '修改失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>