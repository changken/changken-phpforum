<?php
session_start();

require_once("../mysql_connect.inc.php");
require_once('../config.php');

//設定時區為台北
date_default_timezone_set('Asia/Taipei');

if($_GET['action']=="reply") //判斷是否為回覆
{
	$posts_id = $_POST['posts_id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$title = htmlentities($_POST['title'],ENT_QUOTES,"UTF-8");
	$content = $_POST['content'];
	$time = date("Y-m-d H:i:s");

	if($_SESSION[$config['cookie_prefix'].'username'] != null) //檢查cookie
	{
        //新增資料進資料庫語法
        $sql = "INSERT INTO `".$prefix."forum_posts_reply` (`posts_id`, `name`, `email`, `title`, `content`, `time`) VALUES ('$posts_id', '$name', '$email', '$title', '$content', '$time');";
        if(mysqli_query($conn,$sql))
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
}
else //如果是發新帖
{
	$groupid = $_POST['groupid'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$title = htmlentities($_POST['title'],ENT_QUOTES,"UTF-8");
	$content = $_POST['content'];
	$time = date("Y-m-d H:i:s");

	if($_POST['top']==null) //檢查是否為置頂
	{
		$top = "false"; //如果沒有填就不置頂！
	}
	else
	{
		$top = $_POST['top']; //有填就比照POST值
	}
	
	if($_SESSION[$config['cookie_prefix'].'username'] != null)
	{
        //新增資料進資料庫語法
        $sql = "INSERT INTO `".$prefix."forum_posts` (`groupid`, `name`, `email`, `title`, `content`, `time`, `top`) VALUES ('$groupid', '$name', '$email', '$title', '$content', '$time', '$top');";
        if(mysqli_query($conn,$sql))
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