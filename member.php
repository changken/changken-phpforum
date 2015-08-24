<?php 
session_start();
include('config.php'); 
include("mysql_connect.inc.php");
//從session變數中取得使用者帳號資訊
$user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-會員中心</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="style.css" />
<script src="//cdn.ckeditor.com/4.4.7/basic/ckeditor.js"></script>
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-會員中心</h1>
<?php include("nav.php");?><!--嵌入nav.php-->
<hr><size=5>
<!--內容-->
<?php 
if($_SESSION['username'] != null or $_SESSION['admin'] != null)
{
	echo '<a href="reg.php">新增會員</a>    ';
	echo '<a href="update.php">會員個人資訊修改</a>    ';
	echo '<a href="info.php">會員帳號資訊</a>    ';
	echo '<a href="upload.php">檔案上傳</a>    ';
	echo '<a href="file.php">檔案管理</a><br>';
	$sql="SELECT * FROM user ORDER BY NO DESC;";
	$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>帳號</td>
	<td>email</td>
    <td>權限</td>
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
                        echo "</tr>";
        }
 
  }
  ?>
</table>
<hr><size=5>
<?php 
	if($config["user_pm"]=="true")
	{
?>
<h1>會員私人短消息:</h1>
<?php 
		if($_GET['action']=="send")
		{ 
			include("pm_nav.php");
?>
<form name="form" method="post" action="user_pmc.php">
<table border=1>
<tr>
<th>發送會員私人短消息:</th>
</tr>
<tr>
<td>寄件人帳號:<input type="text" name="send_from" value="<?php echo $user;?>" readonly="readonly"></td>
</tr>
<tr>
<td>收件人帳號:<input type="text" name="send_to"></td>
</tr>
<tr>
<td>標題:<input type="text" name="title"></td>
</tr>
<tr>
<td>內容 :<br> 
<textarea cols=60 rows=6 name="content" id="pm"></textarea></td>
</tr>
<script>
CKEDITOR.replace('pm');
</script>
<tr>
<td><input type="submit" value="發送"><input type="reset" value="重新填寫" ></td>
</tr>
</table>
</form>
<?php 	}
		else if($_GET['action']=="inbox")
		{
?>
<h1>收件箱</h1>
<?php 
include("pm_nav.php");
$sql="SELECT * FROM `user_pm` WHERE send_to='$user';";
$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>寄件人帳號</td>
	<td>收件人帳號</td>
    <td>標題</td>
    <td>內容</td>
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
                        echo "<td>".$row['send_from']."</td>";
						echo "<td>".$row['send_to']."</td>";
                        echo "<td>".$row['title']."</td>";
                        echo "<td>".$row['content']."</td>";
		                echo "<td><a href='user_pm_edit.php?NO=";
						echo $row[0]."'><b>編輯</b>";
						echo "<td><a href='user_pm_delete.php?NO=";
						echo $row[0]."'><b>刪除</b>";
                        echo "</tr>";
        }
 
  }
  ?>
</table>
<?php 
		}
		else if($_GET['action']=="outbox")
		{
?>
<h1>已寄出</h1>
<?php 
include("pm_nav.php");
$sql="SELECT * FROM `user_pm` WHERE send_from='$user';";
$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>寄件人帳號</td>
	<td>收件人帳號</td>
    <td>標題</td>
    <td>內容</td>
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
                        echo "<td>".$row['send_from']."</td>";
						echo "<td>".$row['send_to']."</td>";
                        echo "<td>".$row['title']."</td>";
                        echo "<td>".$row['content']."</td>";
		                echo "<td><a href='user_pm_edit.php?NO=";
						echo $row[0]."'><b>編輯</b>";
						echo "<td><a href='user_pm_delete.php?NO=";
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
			include("pm_nav.php");
		} 
	}
	else
	{
		echo "很抱歉，".$config["sitename"]."的會員私人短消息已經關閉";
	} 
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