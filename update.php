<?php 
session_start();
include('config.php');
include("mysql_connect.inc.php"); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-會員個人資訊修改</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-會員個人資訊修改</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php if($_GET['a']=="err1"){?>
<font color="red">錯誤！！密碼絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="err2"){?>
<font color="red">錯誤！！密碼(再輸入一次)絕對不能為空！！！</font>
<?php }elseif($_GET['a']=="err3"){?>
<font color="red">錯誤！！密碼輸入不一致！！！</font>
<?php }else{}?>
<?php
if($_SESSION['username'] != null)
{
        //將$_SESSION['username']丟給$username
        //這樣在下SQL語法時才可以給搜尋的值
        $username = $_SESSION['username'];
        //若以下$username直接用$_SESSION['username']將無法使用
        $sql = "SELECT * FROM user WHERE username='$username';";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
    
        echo "<form name=\"form\" method=\"post\" action=\"updatec.php\">";
        echo "帳號：<input type=\"text\" name=\"username\" value=\"$row[1]\" readonly=\"readonly\" /> <br />";
        echo "email：<input type=\"text\" name=\"email\" value=\"$row[2]\" /> <br />";
        echo "密碼：<input type=\"password\" name=\"password\" value=\"\" /> <br />";
        echo "再一次輸入密碼：<input type=\"password\" name=\"password2\" value=\"\" /> <br />";
		echo "權限:<input type=\"text\" name=\"level\" value=\"$row[4]\" readonly=\"readonly\" /> <br />";
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
<?php include("cpf-footer.php");?>
</body>

</html>