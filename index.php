<?php 
session_start();
require_once("mysql_connect.inc.php");
require_once("config.php"); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-首頁</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-首頁</h1>
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<h2>最新消息:</h2>
	<?php
	$sql = "SELECT * FROM `".$prefix."news` ORDER BY `NO` DESC;";
	$result = mysqli_query($conn,$sql);
	?>
	<table width="500" border="1" cellspacing="0" cellpadding="0">
		<tr>
			<td>標題</td>
			<td>內容</td>
			<td>時間</td>
			<?php if($_SESSION['admin'] !=null){?>
			<td>編輯</td>
			<td>刪除</td>
			<?php }else{}?>
		</tr>
	<?php
	$num = mysqli_num_rows($result);
	if($num>0) //檢查列數是否足夠
	{
        for($i=0;$i<$num;$i++)
		{
            $row = mysqli_fetch_array($result);
            echo "<tr>";
            echo "<td>".$row['title']."</td>";
            echo "<td>".$row['content']."</td>";
            echo "<td>".$row['time']."</td>";
				if($_SESSION['admin'] !=null)
				{
					echo "<td><a href='news_edit.php?NO=";
					echo $row[0]."'><b>編輯</b></a></td>";
					echo "<td><a href='news_delete.php?NO=";
					echo $row[0]."'><b>刪除</b></a></td>";
				}else{}
            echo "</tr>";
        }
	}
	?>
	</table>
	<hr><size=5>
	<h2>歡迎來到<?php echo $config["sitename"];?>！</h2>
	<h2>您可以在我們這裡註冊一個帳號！</h2>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("cpf-footer.php");?>
</body>

</html>