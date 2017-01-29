<?php 
session_start();
require_once("../mysql_connect.inc.php");
require_once('../config.php');
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
	<?php include_once("nav.php");?><!--嵌入nav.php-->
	<hr><size=5>
	<!--內容-->
	<h2>最新消息:</h2>
	<?php
	if($_SESSION[$config["cookie_prefix"].'admin'] != null)
	{
		$sql = "SELECT * FROM `".$prefix."news` ORDER BY `NO` DESC;";
		$result = mysqli_query($conn,$sql);
	?>
	<table width="500" border="1" cellspacing="0" cellpadding="0">
		<tr>
			<td>標題</td>
			<td>內容</td>
			<td>時間</td>
			<td>編輯</td>
			<td>刪除</td>
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
			echo "<td><a href='news_edit.php?NO=";
			echo $row['NO']."'><b>編輯</b></a></td>";
			echo "<td><a href='news_delete.php?NO=";
			echo $row['NO']."'><b>刪除</b></a></td>";
            echo "</tr>";
        }
	}
	?>
	</table>
	<hr><size=5>
	<form name="form" method="post" action="news-post.php">
		<table border="1">
			<tr>
				<th colspan="2">最新消息發佈:</th>
			</tr>
			<tr>
				<td>標題:</td>
				<td><input type="text" name="title"></td>
			</tr>
			<tr>
				<td>內容:</td> 
				<td><textarea cols="60" rows="6" name="content" id="news"></textarea></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="發佈"><input type="reset" value="重新填寫" ></td>
			</tr>
		</table>
	</form>
	<script>
		CKEDITOR.replace('news');
	</script>
	<?php
	}
	else
	{
		header("location:../login.php");
	}
	?>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("../cpf-footer.php");?>
</body>

</html>