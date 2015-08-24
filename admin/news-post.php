<?php
header("Content-Type:text/html; charset=utf-8");
session_start();
include("../mysql_connect.inc.php");

//設定時區為台北
date_default_timezone_set('Asia/Taipei');

$title = $_POST['title'];
$content = $_POST['content'];
$time=date("Y-m-d g:i:s");

if($_SESSION['admin'] != null)
{   
        //新增資料進資料庫語法
        $sql = "INSERT INTO news (title, content, time) VALUES ('$title', '$content', '$time');";
        if(mysql_query($sql))
        {
                echo '發佈成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        else
        {
                echo '發佈失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>