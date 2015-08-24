<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title>changken-phpforum-安裝導引-資料庫連接檔設定-完成</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h2>changken-phpforum-安裝導引-資料庫連接檔設定-完成</h2>
<hr><size=5>
<!--內容-->
<?php
//要寫入的檔案位址
$files="../mysql_connect.inc_setting.php";
//寫入文件内容
$config_str="<?php";
   $config_str.="\n";//這是換行符
   $config_str.='define("DB_HOSTNAME","'.$_POST['db_hostname'].'");//MySQL資料庫主機地址';
   $config_str.="\n";
   $config_str.='define("DB_NAME","'.$_POST['db_name'].'");//MySQL資料庫名稱';
   $config_str.="\n";
   $config_str.='define("DB_USERNAME","'.$_POST['db_username'].'");//MySQL資料庫使用者';
   $config_str.="\n";
   $config_str.='define("DB_PASSWORD","'.$_POST['db_password'].'");//MySQL資料庫使用者密碼';
   $config_str.="\n";
   $config_str.="?>";
   $f_open=fopen($files,"w+");
   fwrite($f_open ,$config_str);
   echo'設定成功！';
   echo'<a href="install.php">下一步，安裝</a>';
?>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>