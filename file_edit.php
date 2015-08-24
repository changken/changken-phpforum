<?php
session_start();
include('config.php');
include("mysql_connect.inc.php"); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-檔案編輯</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-檔案編輯</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php
if($_SESSION['username'] != null or $_SESSION['admin'] != null)
{
        //將$_GET['NO']丟給$NO
        //這樣在下SQL語法時才可以給搜尋的值
        $NO = $_GET['NO'];
        //若以下$NO直接用$_GET['NO']將無法使用
        $sql = "SELECT * FROM file WHERE NO='$NO';";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
?>
<form name="form" method="post" action="file_editc.php">
NO：<input type="text" name="NO" value="<?php echo $row[0];?>" readonly="readonly" /> <br />
檔案名稱：<input type="text" name="filename" value="<?php echo $row[1];?>" />(須含檔案副檔名，否則會發生錯誤)<br />
檔案擁有者：<input type="text" name="username" value="<?php echo $row[2];?>" readonly="readonly" /> <br />
檔案類型：<input type="text" name="filetype" value="<?php echo $row[3];?>" readonly="readonly" /> <br />
檔案大小：<input type="text" name="filesize" value="<?php echo $row[4];?>" readonly="readonly" />B <br />
是否分享:
<select name="ifshare">
<?php if($row[5]=="public"){?>
 <option value="public" selected="true">分享(目前設定)</option>
 <option value="private">私人</option>
<?php 
}
else
{
?>
 <option value="public">分享</option>
 <option value="private" selected="true">私人(目前設定)</option>
<?php	
}
?>
</select> <br />
<input type="hidden" name="old_filename" value="<?php echo $row[1];?>" /> <br />
<input type="submit" name="button" value="確定" />
</form>
<?php
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>
<hr><size=5>
<!--頁尾-->
<?php include("cpf-footer.php");?>
</body>

</html>