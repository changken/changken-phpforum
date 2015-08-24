<?php
header("Content-Type:text/html; charset=utf-8"); 
include("mysql_connect.inc.php");

$username = mysql_real_escape_string($_POST['username']);
$email = mysql_real_escape_string($_POST['email']);
$password = mysql_real_escape_string($_POST['password']);
$password2 = mysql_real_escape_string($_POST['password2']);
$level = 10;//權限為一般會員(10)
$password_md5 = md5($password);//密碼加密
$password_md5_2 = md5($password2);//密碼(再輸入一次)加密
//搜尋資料庫資料
$sql = "SELECT * FROM user WHERE username = '$username';";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);

//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if($username==null)//檢查使用者名稱是否為空
{
header("Location:reg.php?a=err1");
}
elseif($password==null)//檢查密碼是否為空
{
header("Location:reg.php?a=err2");
}
elseif($password2==null)//檢查密碼(再輸入一次)是否為空
{
header("Location:reg.php?a=err3");
}
elseif($password_md5!=$password_md5_2)//檢查密碼是否輸入一致
{
header("Location:reg.php?a=err4");
}
elseif($username==$row[1])//檢查使用者名稱是否已經被使用了
{
header("Location:reg.php?a=err5");
}
else
{
        //新增資料進資料庫語法
        $sql = "INSERT INTO user (username, email, password, level) VALUES ('$username', '$email', '$password_md5', '$level');";
        if(mysql_query($sql))
        {
                echo '註冊成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
        }
        else
        {
                echo '註冊失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=reg.php>';
        }
}
?>