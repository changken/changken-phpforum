<?php
session_start();
include('../config.php'); 
include("../mysql_connect.inc.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-會員帳號資訊編輯</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-會員帳號資訊編輯</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php
if($_SESSION['admin'] != null)
{
		echo "<span style='color:red;'>密碼留空視同不修改密碼！</span> <br />";
		if($_GET['err']=="1")
		{
			echo "<span style='color:red;'>密碼(再輸入一次)不能為空！</span> <br />";
		}
		elseif($_GET['err']=="2")
		{
			echo "<span style='color:red;'>密碼輸入不一致！</span> <br />";
		}
		else
		{
		}
        //將$_GET['NO']丟給$NO
        //這樣在下SQL語法時才可以給搜尋的值
        $NO = $_GET['NO'];
        //若以下$NO直接用$_GET['NO']將無法使用
        $sql = "SELECT * FROM user WHERE NO='$NO';";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
    
        echo "<form name=\"form\" method=\"post\" action=\"member_editc.php\">";
        echo "NO：<input type=\"text\" name=\"NO\" value=\"$NO\" readonly=\"readonly\"/> <br />";		
        echo "帳號：<input type=\"text\" name=\"username\" value=\"$row[1]\" readonly=\"readonly\"/> <br />";
        echo "email：<input type=\"text\" name=\"email\" value=\"$row[2]\" /> <br />";
        echo "密碼：<input type=\"password\" name=\"password\" value=\"\" /> <br />";
        echo "再一次輸入密碼：<input type=\"password\" name=\"password2\" value=\"\" /> <br />";
		echo "權限:<input type=\"text\" name=\"level\" value=\"$row[4]\" /> <br>";
        echo "<input type=\"submit\" name=\"button\" value=\"確定\" />";
        echo "</form>";
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
}
?>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>