<?php 
session_start();

require_once("../mysql_connect.inc.php"); 
require_once('../config.php');

$NO = $_POST['NO'];
$name = $_POST['name'];
$value = $_POST['value'];
$note = $_POST['note'];
 
	if($_SESSION[$config['cookie_prefix'].'admin'] != null)
	{   
        //更新資料庫資料語法
        $sql = "UPDATE `".$prefix."setting` SET `name`='$name', `value`='$value', `note`='$note' WHERE `NO`='$NO';";
        if(mysqli_query($conn,$sql))
        {
			echo '修改成功!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=site_setting.php>';
        }
        else
        {
			echo '修改失敗!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=site_setting.php>';
        }
	}
	else
	{
		header("location:../login.php");
	}
?>