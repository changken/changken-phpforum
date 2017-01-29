<?php 
session_start();

require_once("../mysql_connect.inc.php");
require_once('../config.php');

$NO = $_POST['NO'];
$title = mysqli_real_escape_string($conn,$_POST['title']);
$content = mysqli_real_escape_string($conn,$_POST['content']);
$time = $_POST['time'];
 
	if($_SESSION[$config["cookie_prefix"].'admin'] != null)
	{   
        //更新資料庫資料語法
        $sql = "UPDATE `".$prefix."news` SET `title`='$title', `content`='$content', `time`='$time' WHERE `NO`='$NO';";
        if(mysqli_query($conn,$sql))
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
		header("location:../login.php");
	}
?>