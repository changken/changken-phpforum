<?php 
session_start();

require_once("../mysql_connect.inc.php"); 
require_once('../config.php');

$groupid = $_POST['groupid'];
$groupname = $_POST['groupname'];
$moderators = $_POST['moderators'];
$order_id = $_POST['order_id'];
 
	if($_SESSION[$config['cookie_prefix'].'admin'] != null)
	{   
        //更新資料庫資料語法
        $sql = "UPDATE `".$prefix."forum_group` SET `groupname`='$groupname', `moderators`='$moderators', `order_id`='$order_id' WHERE `groupid`='$groupid';";
        if(mysqli_query($conn,$sql))
        {
			echo '修改版塊成功!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_group_panel.php>';
        }
        else
        {
			echo '修改版塊失敗!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_group_panel.php>';
        }
	}
	else
	{
		header("location:../login.php");
	}
?>