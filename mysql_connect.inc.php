<?php
header("Content-Type:text/html; charset=utf-8");
include'mysql_connect.inc_setting.php';//嵌入資料庫設定
//對資料庫連線
if(!@mysql_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD))
        die("無法對資料庫連線");

//資料庫連線採UTF8
mysql_query("SET NAMES utf8;");

//選擇資料庫
if(!@mysql_select_db(DB_NAME))
        die("無法使用資料庫");
?> 