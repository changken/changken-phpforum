<?php 
header("Content-Type:text/html; charset=utf-8");
session_start();
include("../mysql_connect.inc.php");

$groupid = $_POST['groupid'];
$groupname = $_POST['groupname'];
$moderators = $_POST['moderators'];
 
if($_SESSION['admin'] != null)
{   
        //更新資料庫資料語法
        $sql = "UPDATE forum_group SET groupname='$groupname', moderators='$moderators' WHERE groupid='$groupid';";
        if(mysql_query($sql))
        {
                echo '修改版塊成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_group_panel.php>';
        }
        else
        {
                echo '修改版塊失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=forum_group_panel.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>