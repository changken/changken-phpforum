<?php
session_start();
include('config.php'); 
include("mysql_connect.inc.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-外掛列表頁面</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="style.css"/>
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-外掛列表頁面</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php 
$sql="SELECT * FROM plugin ORDER BY NO DESC;";
$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>外掛名稱</td>
	<td>網址</td>
  </tr>
 
  <?php
  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
                        echo "<tr>";
                        echo "<td>".$row['name']."</td>";
				        echo "<td><a href='".$config["url"]."/plugin/";
						echo $row['filename']."'><b>網址</b>";
                        echo "</tr>";
        }
 
  }
  ?>
</table>
<hr><size=5>
<!--頁尾-->
<?php include("cpf-footer.php");?>
</body>

</html>