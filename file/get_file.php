<?php
session_start();
include('../config.php');
include("../mysql_connect.inc.php");  
$NO = $_GET['NO'];
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-下載檔案</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-下載檔案</h1>
<p><a href="../index.php">回首頁</a></p>
<hr><size=5>
<!--內容-->
<?php
$sql="SELECT * FROM file WHERE NO = '$NO';";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if($row['ifshare']=="public")
{
			if($row['filesize']<1024)
			{
				$size = $row['filesize'];
				$way = "B";
			}
			elseif($row['filesize']>=1024 and $row['filesize']<1024000)
			{
				$size = $row['filesize']/1024;
				$way = "KB";
			}
			elseif($row['filesize']>=1024000 and $row['filesize']<1024000000)
			{
				$size = $row['filesize']/1024000;
				$way = "MB";
			}
			elseif($row['filesize']>=1024000000)
			{
				$size = $row['filesize']/1024000000;
				$way = "GB";
			}		
			else
			{
	
			}
?>
<h1>檔案名稱:<?php echo $row['filename'];?></h1>
<h1>檔案類型:<?php echo $row['filetype'];?></h1>
<h1>檔案大小:<?php echo $size.$way;?></h1>
<h1>擁有者:<?php echo $row['username'];?></h1>
<h1>下載檔案:<a href="<?php echo $row['filename'];?>">點這裡</a></h1>
<h1>分享檔案(html):</h1>
<input type="text" name="share1" value="<a href='<?php echo $config["url"];?>/file/get_file.php?NO=<?php echo $row["NO"];?>'><?php echo $config["url"];?>/file/get_file.php?NO=<?php echo $row["NO"];?></a>" readonly="readonly" size="100">
<h1>分享檔案(bbcode1):</h1>
<input type="text" name="share2" value="[url=<?php echo $config["url"];?>/file/get_file.php?NO=<?php echo $row["NO"];?>]<?php echo $config["url"];?>/file/get_file.php?NO=<?php echo $row["NO"];?>[/url]" readonly="readonly" size="100">
<h1>分享檔案(bbcode2):</h1>
<input type="text" name="share3" value="[url]<?php echo $config["url"];?>/file/get_file.php?NO=<?php echo $row["NO"];?>[/url]" readonly="readonly" size="100">
<?php 
}
else
{
	echo "很抱歉，本檔案不開放分享";
} 
?>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>