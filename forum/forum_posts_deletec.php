<?php 
session_start();
require_once("../mysql_connect.inc.php");
require_once("../config.php"); 

if($_SESSION[$config["cookie_prefix"].'mod'] != null or $_SESSION[$config["cookie_prefix"].'admin'] != null)
{
	if($_GET['action']=="reply")
	{
        $NO = $_POST['NO'];
		$posts_id = $_POST['posts_id'];
		
        //刪除資料庫資料語法
        $sql = "DELETE FROM `".$prefix."forum_posts_reply` WHERE `NO`='$NO';";
        if(mysqli_query($conn,$sql))
        {
            echo '刪除成功!';
			if($config['url_static']=="true")
			{
				echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_posts-'.$posts_id.'.html>';	
			}
			else
			{
				echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_posts.php?NO='.$posts_id.'>';						
			}
        }
        else
        {
            echo '刪除失敗!';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_posts_delete.php?action=reply&NO='.$NO.'>';
        }
	}
	else
	{
        $NO = $_POST['NO'];
		$groupid = $_POST['groupid'];

        //刪除帖子
        $sql = "DELETE FROM `".$prefix."forum_posts` WHERE `NO`='$NO';";
        if(mysqli_query($conn,$sql))
        {
            echo '刪除成功!<br />';
        }
        else
        {
			echo '刪除失敗!<br />';
        }
		
        //刪除與帖子相關的回覆
        $sql = "DELETE FROM `".$prefix."forum_posts_reply` WHERE `posts_id`='$NO';";
        if(mysqli_query($conn,$sql))
        {
            echo '回覆刪除成功!<br />';
			if($config['url_static']=="true")
			{
				echo '<meta http-equiv=REFRESH CONTENT=2;url=forum-'.$groupid.'.html>';	
			}
			else
			{
				echo '<meta http-equiv=REFRESH CONTENT=2;url=forum.php?NO='.$groupid.'>';						
			}
        }
        else
        {
                echo '回覆刪除失敗!<br />';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_posts_delete.php?NO='.$NO.'>';
        }
	}
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>