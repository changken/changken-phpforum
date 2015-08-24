<?php 
header("Content-Type:text/html; charset=utf-8"); 
session_start(); 

include("mysql_connect.inc.php");

$username = mysql_real_escape_string($_POST['username']);
$email = mysql_real_escape_string($_POST['email']);
$password = mysql_real_escape_string($_POST['password']);
$password2 = mysql_real_escape_string($_POST['password2']);
$level = $_POST['level'];//會員權限無法更改，到後台才可更改
$password_md5 = md5($password);//密碼加密
$password_md5_2 = md5($password2);//密碼(再輸入一次)加密

//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if($password==null)//檢查密碼是否為空
{
header("Location:update.php?a=err1");
}
elseif($password2==null)//檢查密碼(再輸入一次)是否為空
{
header("Location:update.php?a=err2");
}
elseif($password_md5!=$password_md5_2)//檢查密碼是否輸入一致
{
header("Location:update.php?a=err3");
}
else
{
        $username = $_SESSION['username'];
    
        //更新資料庫資料語法
        $sql = "UPDATE user SET password='$password_md5', email='$email', level='$level' WHERE username='$username';";
        if(mysql_query($sql))
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
        else
        {
                echo '修改失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
}
?>