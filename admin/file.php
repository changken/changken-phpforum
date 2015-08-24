<?php  
session_start();
include('../config.php');
include("../mysql_connect.inc.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-檔案管理後台</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-檔案管理後台</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php 
if($_SESSION['admin'] != null)
{ 
?>
<p><a href="../upload.php">上傳檔案</a></p>
<?php
$sql="SELECT * FROM file ORDER BY NO DESC;";
$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>檔案名稱</td>
    <td>檔案擁有者</td>
    <td>檔案類型</td>
    <td>檔案大小</td>
    <td>是否分享</td>
	<td>檔案連結</td>
    <td>編輯</td>
	<td>刪除</td>
  </tr>
  <?php
  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
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
                        echo "<tr>";
                        echo "<td>".$row['filename']."</td>";
                        echo "<td>".$row['username']."</td>";
                        echo "<td>".$row['filetype']."</td>";
                        echo "<td>".$size.$way."</td>";
                        echo "<td>".$row['ifshare']."</td>";
	                    echo "<td><a href='../file/get_file.php?NO=";
						echo $row[0]."'><b>檔案連結</b>";
	                    echo "<td><a href='file_edit.php?NO=";
						echo $row[0]."'><b>編輯</b>";
						echo "<td><a href='file_delete.php?NO=";
						echo $row[0]."'><b>刪除</b>";
                        echo "</tr>";
        }
 
  }
  ?>
</table>
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
<?php include("../cpf-footer.php");?>
</body>

</html>