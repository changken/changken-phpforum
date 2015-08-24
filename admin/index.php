<?php 
session_start();
include('../config.php');
include("../mysql_connect.inc.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-控制後台</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-控制後台</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php 
if($_SESSION['admin'] != null)
{
$sql="SELECT * FROM user ORDER BY NO DESC;";
$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>帳號</td>
	<td>email</td>
    <td>權限</td>
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
                        echo "<td>".$row['username']."</td>";
						echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['level']."</td>";
				        echo "<td><a href='member_edit.php?NO=";
						echo $row[0]."'><b>編輯</b>";
						echo "<td><a href='member_delete.php?NO=";
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
header("location:login.php");
}
?>
<hr><size=5>
<form name="form" method="post" action="news-post.php">
<table border=1>
<tr>
<th>最新消息發佈:</th>
</tr>
<tr>
<td>標題:<input type="text" name="title"></td>
</tr>
<tr>
<td>內容:<br> 
<textarea cols="60" rows="6" name="content" id="news"></textarea></td>
</tr>
<script>
CKEDITOR.replace('news');
</script>
<tr>
<td><input type="submit" value="發佈"><input type="reset" value="重新填寫" ></td>
</tr>
</table>
</form>
<hr><size=5>
<!--頁尾-->
<?php include("../cpf-footer.php");?>
</body>

</html>