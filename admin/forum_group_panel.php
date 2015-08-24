<?php  
session_start();
include('../config.php');
include("../mysql_connect.inc.php"); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-會員討論區-管理後台</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-會員討論區-管理後台</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php 
if($_SESSION['admin'] != null)
{
$sql="SELECT * FROM forum_group ORDER BY groupid DESC;";
$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>版塊名稱</td>
	<td>版主</td>
	<td>編輯</td>
	<td>刪除</td>
  </tr>
 
  <?php
  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
                        echo "<tr>";
                        echo "<td>".$row['groupname']."</td>";
						echo "<td>".$row['moderators']."</td>";
						echo "<td><a href='forum_group_edit.php?groupid=";
						echo $row[0]."'><b>編輯</b>";
			            echo "<td><a href='forum_group_delete.php?groupid=";
						echo $row[0]."'><b>刪除</b>";
                        echo "</tr>";
        }
 
  }
  ?>
</table>
<hr><size=5>
<form name="form" method="post" action="forum_group_panelc.php">
<table border=1>
<tr>
<th>新增版塊</th>
</tr>
<tr>
<td>版塊名稱:<input type="text" name="groupname"></td>
</tr>
<tr>
<td>版主:<input type="text" name="moderators"></td>
</tr>
<tr>
<td><input type="submit" value="新增"><input type="reset" value="重新填寫" ></td>
</tr>
</table>
</form>
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