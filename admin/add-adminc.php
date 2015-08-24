<?php 
header("Content-Type:text/html; charset=utf-8");
session_start(); 
include("../mysql_connect.inc.php");

$adminname = mysql_real_escape_string($_POST['adminname']);
$email = mysql_real_escape_string($_POST['email']);
$password = mysql_real_escape_string($_POST['password']);
$password2 = mysql_real_escape_string($_POST['password2']);
$level = $_POST['level'];
$password_md5 = md5($password);//密碼加密
$password_md5_2 = md5($password2);//密碼(再輸入一次)加密

//搜尋資料庫資料
$sql = "SELECT * FROM user WHERE username = '$adminname';";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);

//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if($adminname==null)//檢查管理員名稱是否為空
{
header("Location:add-admin.php?a=err1");
}
elseif($password==null)//檢查密碼是否為空
{
header("Location:add-admin.php?a=err2");
}
elseif($password2==null)//檢查密碼(再輸入一次)是否為空
{
header("Location:add-admin.php?a=err3");
}
elseif($password_md5!=$password_md5_2)//檢查密碼是否輸入一致
{
header("Location:add-admin.php?a=err4");
}
elseif($adminname==$row[1])//檢查管理員名稱是否已經被使用了
{
header("Location:add-admin.php?a=err5");
}
else
{
        //新增資料進資料庫語法
        $sql = "INSERT INTO user (username, email, password, level) VALUES ('$adminname', '$email', '$password_md5', '$level');";
        if(mysql_query($sql))
        {
                echo '新增成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        else
        {
                echo '新增失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
}
?>