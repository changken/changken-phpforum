<?php 
session_start(); 
require_once("mysql_connect.inc.php");
require_once("config.php"); 

$NO = $_POST['NO'];
$send_from = htmlentities($_POST['send_from'],ENT_QUOTES,"UTF-8");
$send_to = htmlentities($_POST['send_to'],ENT_QUOTES,"UTF-8");
$title = htmlentities($_POST['title'],ENT_QUOTES,"UTF-8");
$content = $_POST['content'];

	if($_SESSION[$config['cookie_prefix'].'username'] != null)
	{
        //更新資料庫資料語法
        $sql = "UPDATE `".$prefix."user_pm` SET `send_from`='$send_from', `send_to`='$send_to', `title`='$title', `content`='$content' WHERE `NO`='$NO';";
        if(mysqli_query($conn,$sql))
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
        else
        {
                echo '修改失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
	}
	else
	{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
	}
?>