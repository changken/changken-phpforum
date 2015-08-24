<?php  
session_start();
include('../config.php');
include("../mysql_connect.inc.php"); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-會員討論區編輯版塊</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-會員討論區編輯版塊</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php
if($_SESSION['admin'] != null)
{
        //將$_GET['groupid']丟給$groupid
        //這樣在下SQL語法時才可以給搜尋的值
        $groupid = $_GET['groupid'];
        //若以下$NO直接用$_GET['groupid']將無法使用
        $sql = "SELECT * FROM forum_group WHERE groupid='$groupid';";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
    
        echo "<form name=\"form\" method=\"post\" action=\"forum_group_editc.php\">";
		echo "版塊id：<input type=\"text\" name=\"groupid\" value=\"$row[0]\" readonly=\"readonly\"/> <br />";
        echo "版塊名稱：<input type=\"text\" name=\"groupname\" value=\"$row[1]\" /> <br />";
        echo "版主：<input type=\"text\" name=\"moderators\" value=\"$row[2]\" /> <br />";
        echo "<input type=\"submit\" name=\"button\" value=\"確定\" />";
        echo "</form>";
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>