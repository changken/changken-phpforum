<?php
session_start();
include('../config.php'); 
include("../mysql_connect.inc.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-會員討論區編輯帖子</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css">
<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-會員討論區編輯帖子</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php
if($_SESSION['mod'] != null or $_SESSION['admin'] != null)
{
	if($_GET['action']=="reply")
	{
        //將$_GET['NO']丟給$NO
        //這樣在下SQL語法時才可以給搜尋的值
        $NO = $_GET['NO'];
        //若以下$NO直接用$_GET['NO']將無法使用
        $sql = "SELECT * FROM forum_posts_reply WHERE NO='$NO';";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
    
        echo "<form name=\"form\" method=\"post\" action=\"forum_posts_editc.php?action=reply\">";
        echo "NO：<input type=\"text\" name=\"NO\" value=\"$row[0]\" readonly=\"readonly\" /> <br />";
		echo "所屬帖子：<input type=\"text\" name=\"posts_id\" value=\"$row[1]\" readonly=\"readonly\" /> <br />";
        echo "帳號：<input type=\"text\" name=\"name\" value=\"$row[2]\" /> <br />";
        echo "email：<input type=\"text\" name=\"email\" value=\"$row[3]\" /> <br />";
        echo "標題：<input type=\"text\" name=\"title\" value=\"$row[4]\" /> <br />";
        echo "內容：<textarea name=\"content\" cols=\"100\" rows=\"50\" id=\"posts_edit\">$row[5]</textarea> <br />";
		echo "發表時間：<input type=\"text\" name=\"time\" value=\"$row[6]\" readonly=\"readonly\" /> <br />";
        echo "<input type=\"submit\" name=\"button\" value=\"確定\" />";
        echo "</form>";
	}
	else
	{
        //將$_GET['NO']丟給$NO
        //這樣在下SQL語法時才可以給搜尋的值
        $NO = $_GET['NO'];
        //若以下$NO直接用$_GET['NO']將無法使用
        $sql = "SELECT * FROM forum_posts WHERE NO='$NO';";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
    
        echo "<form name=\"form\" method=\"post\" action=\"forum_posts_editc.php\">";
        echo "NO：<input type=\"text\" name=\"NO\" value=\"$row[0]\" readonly=\"readonly\" /> <br />";
		echo "所屬版塊：<input type=\"text\" name=\"groupid\" value=\"$row[1]\" /> <br />";
        echo "帳號：<input type=\"text\" name=\"name\" value=\"$row[2]\" /> <br />";
        echo "email：<input type=\"text\" name=\"email\" value=\"$row[3]\" /> <br />";
        echo "標題：<input type=\"text\" name=\"title\" value=\"$row[4]\" /> <br />";
        echo "內容：<textarea name=\"content\" cols=\"100\" rows=\"50\" id=\"posts_edit\">$row[5]</textarea> <br />";
		echo "發表時間：<input type=\"text\" name=\"time\" value=\"$row[6]\" readonly=\"readonly\" /> <br />";
		echo "是否置頂(是，填true；否，留空或填false)：<input type=\"text\" name=\"top\" value=\"$row[7]\"> <br />";
        echo "<input type=\"submit\" name=\"button\" value=\"確定\" />";
        echo "</form>";
	}
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>
<script>
CKEDITOR.replace('posts_edit');
</script>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>