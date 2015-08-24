<?php
header("Content-Type:text/html; charset=utf-8");
session_start();
include("../mysql_connect.inc.php");

$groupname = $_POST['groupname'];
$moderators = $_POST['moderators'];

if($_SESSION['admin'] != null)
{
        //新增資料進資料庫語法
        $sql = "INSERT INTO forum_group (groupname, moderators) VALUES ('$groupname', '$moderators');";
        if(mysql_query($sql))
        {
                echo '新增版塊成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_group_panel.php>';
        }
        else
        {
                echo '新增版塊失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_group_panel.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>