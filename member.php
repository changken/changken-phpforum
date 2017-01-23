<?php 
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php"); 
//從session變數中取得使用者帳號資訊
$user = $_SESSION[$config['cookie_prefix'].'username'];
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
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<?php 
	if($_SESSION[$config["cookie_prefix"].'username'] != null or $_SESSION[$config["cookie_prefix"].'admin'] != null)
	{
		echo '<a href="reg.php">新增會員</a>    ';
		echo '<a href="update.php">會員個人資訊修改</a>    ';
		echo '<a href="info.php">會員帳號資訊</a>    ';
		echo '<a href="upload.php">檔案上傳</a>    ';
		echo '<a href="file.php">檔案管理</a><br>';
		$sql = "SELECT * FROM `".$prefix."user` ORDER BY `NO` DESC;";
		$result = mysqli_query($conn,$sql);
	?>
	<table width="500" border="1" cellspacing="0" cellpadding="0">
		<tr>
			<td>帳號</td>
			<td>email</td>
			<td>權限</td>
		</tr>
	<?php
	$num = mysqli_num_rows($result);
	if($num>0)
	{
        for($i=0;$i<$num;$i++)
		{
            $row = mysqli_fetch_array($result);
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
	<?php if($config["user_pm"]=="true"){?>
		<h1>會員私人短消息:</h1>
	<?php 
		include_once("pm_nav.php");
		if($_GET['action']=="send")
		{ 
			include_once("pm_form.php");
		}
		else if($_GET['action']=="inbox")
		{
			include_once("pm_inbox.php");
		}
		else if($_GET['action']=="outbox")
		{
			include_once("pm_outbox.php");			
		}
		else
		{
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
	<?php include_once("cpf-footer.php");?>
</body>

</html>