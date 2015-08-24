<?php
header("Content-Type:text/html; charset=utf-8");
session_start(); 
include("../mysql_connect.inc.php");

$NO = $_POST['NO'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$level = $_POST['level'];//會員權限無法更改(除管理員外)

if($password==null and $password2==null)
{
	$sql = "SELECT * FROM user WHERE username='$username';";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	$password2db = $row[3];
}
else
{
	if($password!=null and $password2==null)
	{
		header("Location: member_edit.php?NO=".$NO."&err=1");	
	}
	elseif($password!=$password2)
	{
		header("Location: member_edit.php?NO=".$NO."&err=2");
	}
	else
	{
		$password2db = md5($password);
	}
}
//判斷帳號權限是否為管理員
if($_SESSION['admin'] != null)
{
        //更新資料庫資料語法
        $sql = "UPDATE user SET password='$password2db', email='$email', level='$level' WHERE username='$username';";
        if(mysql_query($sql))
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        else
        {
                echo '修改失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member_edit.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
}
?>