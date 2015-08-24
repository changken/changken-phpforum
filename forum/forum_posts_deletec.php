<?php 
header("Content-Type:text/html; charset=utf-8");
session_start();

include("../mysql_connect.inc.php");

if($_SESSION['mod'] != null or $_SESSION['admin'] != null)
{
	if($_GET['action']=="reply")
	{
        $NO = $_POST['NO'];

        //刪除資料庫資料語法
        $sql = "DELETE FROM forum_posts_reply WHERE NO='$NO';";
        if(mysql_query($sql))
        {
                echo '刪除成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        else
        {
                echo '刪除失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_posts_delete.php>';
        }
	}
	else
	{
        $NO = $_POST['NO'];

        //刪除資料庫資料語法
        $sql = "DELETE FROM forum_posts WHERE NO='$NO';";
        if(mysql_query($sql))
        {
                echo '刪除成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        else
        {
                echo '刪除失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_posts_delete.php>';
        }
	}
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>