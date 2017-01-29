<?php
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php"); 

//設定時區為台北
date_default_timezone_set('Asia/Taipei');

$send_from = htmlentities($_POST['send_from'],ENT_QUOTES,"UTF-8");
$send_to = htmlentities($_POST['send_to'],ENT_QUOTES,"UTF-8");
$title = htmlentities($_POST['title'],ENT_QUOTES,"UTF-8");
$content = $_POST['content'];
$time = date("Y-m-d H:i:s");

	if($_SESSION[$config['cookie_prefix'].'username'] != null)
	{
        //寄送備份
        $sql = "INSERT INTO `".$prefix."user_pm` (`send_from`, `send_to`, `title`, `content`, `state`, `if_read`, `time`) VALUES ('$send_from', '$send_to', '$title', '$content', 'outbox', 2, '$time');";
        if(mysqli_query($conn,$sql))
        {
                echo '<p>備份成功！</p>';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
        else
        {
                echo '<p>備份失敗！</p>';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
        //發送
        $sql = "INSERT INTO `".$prefix."user_pm` (`send_from`, `send_to`, `title`, `content`,  `state`, `if_read`, `time`) VALUES ('$send_from', '$send_to', '$title', '$content', 'inbox', 0, '$time');";
        if(mysqli_query($conn,$sql))
        {
                echo '<p>發送成功！</p>';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
        else
        {
                echo '<p>發送失敗！</p>';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
	}
	else
	{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
	}
?>