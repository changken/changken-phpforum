<?php
session_start();
include('../config.php'); 
include("../mysql_connect.inc.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-外掛管理頁面</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-外掛管理頁面</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php 
if($_SESSION['admin'] != null)
{
$sql="SELECT * FROM plugin ORDER BY NO DESC;";
$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>外掛名稱</td>
	<td>外掛作者</td>
    <td>外掛版本</td>
    <td>外掛更新日期</td>
	<td>外掛狀態</td>
	<td>前台網址</td>
	<td>後台網址</td>
	<td>編輯</td>
	<td>卸載</td>
  </tr>
 
  <?php
  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
                        echo "<tr>";
                        echo "<td>".$row['name']."</td>";
						echo "<td>".$row['writer']."</td>";
                        echo "<td>".$row['version']."</td>";
                        echo "<td>".$row['update_date']."</td>";
						echo "<td>".$row['mode']."</td>";
				        echo "<td><a href='../plugin/";
						echo $row['filename']."'><b>前台網址</b>";
						echo "<td><a href='../plugin/";
						echo $row['filename']."/admin'><b>後台網址</b>";
				        echo "<td><a href='plugin_edit.php?NO=";
						echo $row[0]."'><b>編輯</b>";
						echo "<td><a href='../plugin/";
						echo $row['filename']."/uninstall.php'><b>卸載</b>";
                        echo "</tr>";
        }
 
  }
  ?>
</table>
<?php
}
else
{
	echo '您無權限觀看此頁面!!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
}
?>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>