<?php 
session_start();

require_once("../mysql_connect.inc.php"); 
require_once('../config.php');

$groupid = $_POST['groupid'];

	if($_SESSION[$config['cookie_prefix'].'admin'] != null)
	{
        //刪除資料庫資料語法
        $sql = "DELETE FROM `".$prefix."forum_group` WHERE `groupid`='$groupid';";
        if(mysqli_query($conn,$sql))
        {
			echo '刪除成功!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_group_panel.php>';
        }
        else
        {
			echo '刪除失敗!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_group_delete.php>';
        }
	}
	else
	{
		header("location:../login.php");
	}
?>