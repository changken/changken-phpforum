<?php
header("Content-Type:text/html; charset=utf-8"); 
session_start(); 

//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("mysql_connect.inc.php");

$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
$password_md5 = md5($password);//密碼加密

//搜尋資料庫資料
$sql = "SELECT * FROM user WHERE username = '$username';";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);

//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($username==null)//檢查使用者名稱是否為空
{
header("Location:login.php?a=err1");
}
elseif($password==null)//檢查密碼是否為空
{
header("Location:login.php?a=err2");
}
elseif($row[1] != $username)//檢查使用者名稱是否錯誤
{
header("Location:login.php?a=err3");
}
elseif($row[3] != $password_md5)//檢查密碼是否錯誤
{
header("Location:login.php?a=err4");
}
else
{
if($row[4] == 10){ //檢查會員權限是否是10
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['username'] = $username;
        echo '登入成功!會員權限:一般會員！';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=member.php>';
}
else if($row[4] == 100){ //檢查會員權限是否是100
        //將帳號寫入session，方便驗證使用者身份
		$_SESSION['username'] = $username;
        $_SESSION['admin'] = $username;
        echo '登入成功!會員權限:管理員！';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=member.php>';
}
else if($row[4] == 50){ //檢查會員權限是否是50
        //將帳號寫入session，方便驗證使用者身份
		$_SESSION['username'] = $username;
        $_SESSION['mod'] = $username;
        echo '登入成功!會員權限:會員討論區版塊版主！';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=member.php>';
}
else
{
        echo '登入失敗!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
}
}
?>