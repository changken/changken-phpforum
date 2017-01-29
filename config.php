<?php
$sql = "SELECT * FROM `".$prefix."setting` WHERE `NO`='1';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_row($result);
$config["sitename"] = $row[2];//網站名稱，純文字
//============================================================
$sql = "SELECT * FROM `".$prefix."setting` WHERE `NO`='2';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_row($result);
$config["url"] = $row[2];//網站網址
//============================================================
$sql = "SELECT * FROM `".$prefix."setting` WHERE `NO`='3';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_row($result);
$config["reg"] = $row[2];//是否開放註冊，開放為true，關閉為false
//============================================================
$sql = "SELECT * FROM `".$prefix."setting` WHERE `NO`='4';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_row($result);
$config["forum"] = $row[2];//是否開啟會員討論區，開啟為true，關閉為false
//============================================================
$sql = "SELECT * FROM `".$prefix."setting` WHERE `NO`='5';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_row($result);
$config["news"] = $row[2];//是否開啟最新消息，開啟為true，關閉為false
//============================================================
$sql = "SELECT * FROM `".$prefix."setting` WHERE `NO`='6';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_row($result);
$config["homepage_welcome"] = $row[2];//首頁歡迎語
//============================================================
$sql = "SELECT * FROM `".$prefix."setting` WHERE `NO`='7';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_row($result);
$config["user_pm"] = $row[2];//是否開啟會員私人短消息，開啟為true，關閉為false
//============================================================
$sql = "SELECT * FROM `".$prefix."setting` WHERE `NO`='8';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_row($result);
$config["url_static"] = $row[2];//是否開啟會員討論區版塊、會員討論區版塊帖子、部落格文章(外掛)網址偽靜態，開啟為true，關閉為false
//============================================================
$sql = "SELECT * FROM `".$prefix."setting` WHERE `NO`='9';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_row($result);
$config["cookie_prefix"] = $row[2];//cookie前綴
?>