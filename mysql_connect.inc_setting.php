<?php 
#此為MySQL資料庫配置檔範例#
#您可以不使用安裝導向來安裝#
#您只要將changken-phpforum.sql導入資料庫並且運行新增管理員SQL語法，再將此配置檔填寫完畢後並改名為mysql_connect.inc_setting.php後，即可使用#
#新增管理員SQL語法(範例):insert into user (username, email, password, level) values ('管理員名稱', '管理員email', '管理員密碼', '100')#
//error_reporting(0);
$prefix = "";//表前綴
define("DB_HOSTNAME","");//MySQL資料庫主機地址
define("DB_NAME","");//MySQL資料庫名稱
define("DB_USERNAME","");//MySQL資料庫使用者
define("DB_PASSWORD","");//MySQL資料庫使用者密碼
?>