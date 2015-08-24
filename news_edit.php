<?php 
session_start();
include('config.php'); 
include("mysql_connect.inc.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-最新消息編輯</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="style.css" />
<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-最新消息編輯</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php
if($_SESSION['admin'] != null)
{
        //將$_GET['NO']丟給$NO
        //這樣在下SQL語法時才可以給搜尋的值
        $NO = $_GET['NO'];
        //若以下$NO直接用$_GET['NO']將無法使用
        $sql = "SELECT * FROM news WHERE NO='$NO';";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
    
        echo "<form name=\"form\" method=\"post\" action=\"news_editc.php\">";
        echo "NO：<input type=\"text\" name=\"NO\" value=\"$row[0]\" readonly=\"readonly\" /> <br />";
        echo "標題：<input type=\"text\" name=\"title\" value=\"$row[1]\" /> <br />";
        echo "內容：<textarea name=\"content\" cols=\"45\" rows=\"5\" id=\"news\">$row[2]</textarea> <br />";
		echo "時間：<input type=\"text\" name=\"time\" value=\"$row[3]\" readonly=\"readonly\" /> <br />";
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
CKEDITOR.replace('news');
</script>
<hr><size=5>
<!--頁尾-->
<?php include("cpf-footer.php");?>
</body>

</html>