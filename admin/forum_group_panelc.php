<?php
session_start();

require_once("../mysql_connect.inc.php"); 
require_once('../config.php');

$groupname = $_POST['groupname'];
$moderators = $_POST['moderators'];
$order_id = $_POST['order_id'];

	if($_SESSION[$config['cookie_prefix'].'admin'] != null)
	{
        //新增資料進資料庫語法
        $sql = "INSERT INTO `".$prefix."forum_group` (`groupname`, `moderators`, `order_id`) VALUES ('$groupname', '$moderators', '$order_id');";
        if(mysqli_query($conn,$sql))
        {
            echo '新增版塊成功!';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_group_panel.php>';
        }
        else
        {
            echo '新增版塊失敗!';
            echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_group_panel.php>';
        }
	}
	else
	{
		header("location:../login.php");
	}
?>