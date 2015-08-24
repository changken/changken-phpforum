<?php
session_start();
include('../config.php'); 
include("../mysql_connect.inc.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-外掛編輯</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-外掛編輯</h1>
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
        $sql = "SELECT * FROM plugin WHERE NO='$NO';";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
    
        echo "<form name=\"form\" method=\"post\" action=\"plugin_editc.php\">";
        echo "NO：<input type=\"text\" name=\"NO\" value=\"$row[0]\" readonly=\"readonly\"/> <br />";
        echo "外掛名稱：<input type=\"text\" name=\"name\" value=\"$row[1]\" readonly=\"readonly\"/> <br />";
        echo "外掛作者：<input type=\"text\" name=\"writer\" value=\"$row[2]\" readonly=\"readonly\"/> <br />";
        echo "外掛版本：<input type=\"text\" name=\"version\" value=\"$row[3]\" readonly=\"readonly\"/> <br />";
		echo "外掛更新日期：<input type=\"text\" name=\"update_date\" value=\"$row[4]\" readonly=\"readonly\"/> <br />";
		echo "外掛狀態：<input type=\"text\" name=\"mode\" value=\"$row[5]\" /> <br>";
		echo "外掛檔案夾名稱：<input type=\"text\" name=\"filename\" value=\"$row[6]\" readonly=\"readonly\"/> <br />";
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