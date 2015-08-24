<?php
session_start();
include('config.php');
if($config["upload-max-size"]<1024)
{
	$size = $config["upload-max-size"];
	$way = "B";
}
elseif($config["upload-max-size"]>=1024 and $config["upload-max-size"]<1024000)
{
	$size = $config["upload-max-size"]/1024;
	$way = "KB";
}
elseif($config["upload-max-size"]>=1024000 and $config["upload-max-size"]<1024000000)
{
	$size = $config["upload-max-size"]/1024000;
	$way = "MB";
}
elseif($config["upload-max-size"]>=1024000000)
{
	$size = $config["upload-max-size"]/1024000000;
	$way = "GB";
}		
else
{
	
}
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-檔案上傳</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-檔案上傳</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php 
if($config["upload"]=="true")
{ 
	if($_SESSION['username'] != null or $_SESSION['admin'] != null)
	{ 
?>
<p><a href="file.php">檔案管理</a></p>
<form action="uploadc.php" enctype="multipart/form-data" method="post">
<table border=1>
<tr>
<th>檔案上傳</th>
</tr>
<tr>
<td><input type="file" name="uploadedfile" /></td>
</tr>
<tr>
<td><input type="submit" value="上傳" /></td>
</tr>
<tr>
<td>單檔最大限制:<?php echo $size;?><?php echo $way;?></td>
</tr>
<tr>
<td>是否分享:<select name="ifshare">
 <option value="public" selected="true">分享</option>
 <option value="private">私人</option>
</select>
</td>
</tr>
</table>
</form> 
<?php 
	}
	else
	{ 
		echo '您無權限觀看此頁面!';
		echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
	}
}
else
{
	echo "很抱歉，".$config["sitename"]."的檔案上傳已經關閉";
} 
?>
<hr><size=5>
<!--頁尾-->
<?php include("cpf-footer.php");?>
</body>

</html>