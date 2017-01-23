<?php
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php"); 

$send_from = htmlentities($_POST['send_from'],ENT_QUOTES,"UTF-8");
$send_to = htmlentities($_POST['send_to'],ENT_QUOTES,"UTF-8");
$title = htmlentities($_POST['title'],ENT_QUOTES,"UTF-8");
$content = $_POST['content'];

	if($_SESSION[$config['cookie_prefix'].'username'] != null)
	{
        //新增資料進資料庫語法
        $sql = "INSERT INTO `".$prefix."user_pm` (`send_from`, `send_to`, `title`, `content`) VALUES ('$send_from', '$send_to', '$title', '$content');";
        if(mysqli_query($conn,$sql))
        {
                echo '發佈成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
        else
        {
                echo '發佈失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
	}
	else
	{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
	}
?>