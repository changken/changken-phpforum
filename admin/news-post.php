<?php
session_start();
require_once("../mysql_connect.inc.php");
require_once('../config.php');

//設定時區為台北
date_default_timezone_set('Asia/Taipei');

$title = $_POST['title'];
$content = $_POST['content'];
$time = date("Y-m-d g:i:s");

	if($_SESSION[$config["cookie_prefix"].'admin'] != null)
	{   
        //新增資料進資料庫語法
        $sql = "INSERT INTO `".$prefix."news` (`title`, `content`, `time`) VALUES ('$title', '$content', '$time');";
        if(mysqli_query($conn,$sql))
        {
			echo '發佈成功!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        else
        {
			echo '發佈失敗!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
	}
	else
	{
		header("location:../login.php");
	}
?>