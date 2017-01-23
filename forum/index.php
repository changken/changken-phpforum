<?php 
session_start();
require_once("../mysql_connect.inc.php");
require_once('../config.php');
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員討論區-首頁</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style.css" />
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-會員討論區-首頁</h1>
	<p><a href="<?php echo $config["url"];?>"><?php echo $config["sitename"];?></a>><a href="<?php echo $config["url"];?>/forum">會員討論區</a></p>
	<hr><size=5>
	<!--內容-->
	<?php 
	if($config["forum"]=="true")
	{
		$sql = "SELECT * FROM `".$prefix."forum_group` ORDER BY `groupid` DESC;";
		$result = mysqli_query($conn,$sql);

		$num = mysqli_num_rows($result);
		if($num>0)
		{
			for($i=0;$i<$num;$i++)
			{
                $row = mysqli_fetch_array($result);
	?>
				<div style="background-color:#f5f5f5;">
					<blockquote>
						<span style="color: blue;">
					<?php if($config['url_static']=="true"){ ?>
						<h3><a href="forum-<?php echo $row[0];?>.html"><?php echo $row['groupname'];?></a></h3>
					<?php }else { ?>
						<h3><a href="forum.php?groupid=<?php echo $row[0];?>"><?php echo $row['groupname'];?></a></h3>
					<?php }?>
						</span>
						<b>版主:</b><?php echo $row['moderators'];?>
					</blockquote>
				</div>
	<?php
			}
		}
	}
	else
	{
		echo "很抱歉，".$config["sitename"]."的會員討論區已經關閉";
	} 
	?>
	<hr><size=5>
	<!--頁尾-->
	<?php include_once("../cpf-footer.php");?>
</body>

</html>