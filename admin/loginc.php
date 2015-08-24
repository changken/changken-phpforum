<?php 
header("Content-Type:text/html; charset=utf-8");
session_start(); 
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("../mysql_connect.inc.php");
$adminname = mysql_real_escape_string($_POST['adminname']);
$password = mysql_real_escape_string($_POST['password']);
$password_md5 = md5($password);//密碼加密

//搜尋資料庫資料
$sql = "SELECT * FROM user WHERE username = '$adminname';";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);

//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($adminname==null || $adminname=="")//檢查管理員名稱是否為空
{
header("Location:login.php?a=err1");
}
elseif($password_md5==null || $password_md5=="")//檢查密碼是否為空
{
header("Location:login.php?a=err2");
}
elseif($row[1] == $adminname && $row[3] != $password_md5)//檢查密碼是否錯誤
{
header("Location:login.php?a=err3");
}
elseif($row[1] != $adminname && $row[3] == $password_md5)//檢查管理員名稱是否錯誤
{
header("Location:login.php?a=err4");
}
elseif($row[1] != $adminname && $row[3] != $password_md5)//檢查管理員名稱與密碼是否錯誤
{
header("Location:login.php?a=err5");
}
else
{
if($row[4] == 100){ //檢查會員權限是否是100
        //將帳號寫入session，方便驗證使用者身份
		$_SESSION['username'] = $adminname;
        $_SESSION['admin'] = $adminname;
        echo '登入成功!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
else //若會員權限是100以下則顯示「帳號權限不足！」
{
        echo '帳號權限不足!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
}
}
?>