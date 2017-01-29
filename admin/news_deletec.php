<?php 
session_start(); 

require_once("../mysql_connect.inc.php");
require_once('../config.php');

$NO = $_POST['NO'];

	if($_SESSION[$config["cookie_prefix"].'admin'] != null)
	{
        //刪除資料庫資料語法
        $sql = "DELETE FROM `".$prefix."news` WHERE `NO`='$NO';";
        if(mysqli_query($conn,$sql))
        {
			echo '刪除成功!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        else
        {
			echo '刪除失敗!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
	}
	else
	{	
		header("location:../login.php");
	}
?>