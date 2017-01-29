<?php
session_start(); 
require_once("../mysql_connect.inc.php");
require_once('../config.php');
require_once("../inc/function.php");

	//判斷帳號權限是否為管理員
	if($_SESSION[$config["cookie_prefix"].'admin'] != null)
	{
		$code = cpf_update($_POST['username'],$_POST['email'],$_POST['password'],$_POST['password2'],$_POST['level']);
		switch($code)
		{
			case 0:
				echo "密碼為空";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=account-manage.php>";
			break;
			case 1:
				echo "密碼(再輸入一次)為空";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=account-manage.php>";
			break;
			case 2:
				echo "密碼不一致";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=account-manage.php>";
			break;
			case 3:
				echo "修改成功！";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=account-manage.php>";
			break;
			case 4:
				echo "修改失敗！";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=account-manage.php>";
			break;
		}
	}
	else
	{
		header("location:../login.php");
	}
?>