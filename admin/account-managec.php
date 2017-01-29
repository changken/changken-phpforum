<?php 
session_start(); 
require_once("../mysql_connect.inc.php"); 
require_once('../config.php'); 
require_once('../inc/function.php');

	if($_SESSION[$config['cookie_prefix'].'admin'] != null)
	{
		$code = cpf_reg($_POST['username'],$_POST['email'],$_POST['password'],$_POST['password2'],$_POST['level']);
		switch($code)
		{
			case 0:
				echo "使用者名稱為空";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=account-manage.php>";
			break;
			case 1:
				echo "密碼為空";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=account-manage.php>";
			break;
			case 2:
				echo "密碼(再輸入一次)為空";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=account-manage.php>";
			break;
			case 3:
				echo "密碼不一致";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=account-manage.php>";
			break;
			case 4:
				echo "用戶名已被使用";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=account-manage.php>";
			break;
			case 5:
				echo "新增成功！";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=account-manage.php>";
			break;
			case 6:
				echo "新增失敗！";
				echo "<meta http-equiv=REFRESH CONTENT=1;url=account-manage.php>";
			break;
		}
	}
	else
	{
		header("location:../login.php");
	}
?>