<?php
/**
Project Name:changken-phpforum
Author:changken
Version:v9.1
Update Date:2017-1-22
 */
require_once("mysql_connect.inc_setting.php");//嵌入資料庫設定

$conn = @mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);//對資料庫連線

if(mysqli_connect_errno($conn))
{
    echo "無法對資料庫連線";
}

//資料庫連線採UTF8
mysqli_query($conn,"SET NAMES utf8;");

/* //選擇資料庫 舊寫法
if(!@mysql_select_db(DB_NAME))
        die("無法使用資料庫"); */
?> 