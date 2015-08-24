<?php
header("Content-Type:text/html; charset=utf-8"); 
session_start();

include("../config.php");
include("../mysql_connect.inc.php");

//設定時區為台北
date_default_timezone_set('Asia/Taipei');

if($_GET['action']=="reply")
{
$posts_id = $_POST['posts_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$title = htmlentities($_POST['title'],ENT_QUOTES,"UTF-8");
$content = $_POST['content'];
$time = date("Y-m-d H:i:s");

	if($_SESSION['username'] != null)
	{
        //新增資料進資料庫語法
        $sql = "INSERT INTO forum_posts_reply (posts_id, name, email, title, content, time) VALUES ('$posts_id', '$name', '$email', '$title', '$content', '$time');";
        if(mysql_query($sql))
        {
                echo '回覆成功!';
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
                echo '回覆失敗!';
					if($config['url_static']=="true")
					{
						echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_posts-'.$posts_id.'.html>';
					}
					else
					{
						echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_posts.php?NO='.$posts_id.'>';
					}
        }
	}
	else
	{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=../login.php>';
	}
}else{
$groupid = $_POST['groupid'];
$name = $_POST['name'];
$email = $_POST['email'];
$title = htmlentities($_POST['title'],ENT_QUOTES,"UTF-8");
$content = $_POST['content'];
$time = date("Y-m-d H:i:s");
if($_POST['top']==null)
{
$top = "false";
}
else
{
$top = $_POST['top'];
}
	if($_SESSION['username'] != null)
	{
        //新增資料進資料庫語法
        $sql = "INSERT INTO forum_posts (groupid, name, email, title, content, time, top) VALUES ('$groupid', '$name', '$email', '$title', '$content', '$time', '$top');";
        if(mysql_query($sql))
        {
                echo '發帖成功!';
					if($config['url_static']=="true")
					{
						echo '<meta http-equiv=REFRESH CONTENT=2;url=forum-'.$groupid.'.html>';	
					}
					else
					{
						echo '<meta http-equiv=REFRESH CONTENT=2;url=forum.php?groupid='.$groupid.'>';						
					}
        }
        else
        {
                echo '發帖失敗!';
					if($config['url_static']=="true")
					{
						echo '<meta http-equiv=REFRESH CONTENT=2;url=forum-'.$groupid.'.html>';	
					}
					else
					{
						echo '<meta http-equiv=REFRESH CONTENT=2;url=forum.php?groupid='.$groupid.'>';					
					}
        }
	}
	else
	{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=../login.php>';
	}
}
?>