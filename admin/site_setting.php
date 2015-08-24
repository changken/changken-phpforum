<?php  
session_start();
include('../config.php');
include("../mysql_connect.inc.php"); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-網站參數設定</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-網站參數設定</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php 
if($_SESSION['admin'] != null)
{
$sql="SELECT * FROM setting ORDER BY NO ASC;";
$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>參數名稱</td>
	<td>數值</td>
    <td>參數說明</td>
	<td>編輯</td>
  </tr>
 
  <?php
  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
                        echo "<tr>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$row['value']."</td>";
						echo "<td>".$row['note']."</td>";
				        echo "<td><a href='site_setting_edit.php?NO=";
						echo $row[0]."'><b>編輯</b>";
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