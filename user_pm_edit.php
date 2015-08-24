<?php 
session_start();
include('config.php'); 
include("mysql_connect.inc.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-會員私人短消息編輯消息</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="style.css" />
<script src="//cdn.ckeditor.com/4.4.7/basic/ckeditor.js"></script>
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-會員私人短消息編輯消息</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php
if($_SESSION['username'] != null)
{
        //將$_GET['NO']丟給$NO
        //這樣在下SQL語法時才可以給搜尋的值
        $NO = $_GET['NO'];
        //若以下$NO直接用$_GET['NO']將無法使用
        $sql = "SELECT * FROM user_pm WHERE NO='$NO';";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
    
        echo "<form name=\"form\" method=\"post\" action=\"user_pm_editc.php\">";
        echo "NO：<input type=\"text\" name=\"NO\" value=\"$row[0]\" readonly=\"readonly\" /> <br />";
        echo "寄件人帳號：<input type=\"text\" name=\"send_from\" value=\"$row[1]\" /> <br />";
        echo "收件人帳號：<input type=\"text\" name=\"send_to\" value=\"$row[2]\" /> <br />";
        echo "標題：<input type=\"text\" name=\"title\" value=\"$row[3]\" /> <br />";
        echo "內容：<textarea name=\"content\" cols=\"45\" rows=\"5\" id=\"pm\">$row[4]</textarea> <br />";
        echo "<input type=\"submit\" name=\"button\" value=\"確定\" />";
        echo "</form>";
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>
<script>
CKEDITOR.replace('pm');
</script>
<hr><size=5>
<!--頁尾-->
<?php include("cpf-footer.php");?>
</body>

</html>