<?php
session_start();
require_once("../mysql_connect.inc.php");
require_once('../config.php');
require_once("../inc/function.php");

$groupid = $_GET['groupid']; //抓取論壇id
$username = $_SESSION[$config['cookie_prefix'].'username'];//抓取帳號資訊
/*抓取版塊資訊*/
$sql="SELECT * FROM `".$prefix."forum_group` WHERE `groupid` = '$groupid';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
$groupname = $row['groupname'];
$moderators = $row['moderators'];
?> 
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員討論區-<?php echo $groupname;?></title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style.css" />
	<?php if($_SESSION[$config['cookie_prefix'].'admin']!=null or $_SESSION[$config['cookie_prefix'].'mod']!=null){?>
		<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>
	<?php }else{?>
		<script src="//cdn.ckeditor.com/4.4.7/basic/ckeditor.js"></script>
	<?php }?>
</head>

<body>
	<!--標題-->
	<h1><?php echo $config["sitename"];?>-會員討論區-<?php echo $groupname;?></h1>
	<?php if($config['url_static']=="true"){ ?>
		<p><a href="<?php echo $config["url"];?>"><?php echo $config["sitename"];?></a>><a href="<?php echo $config["url"];?>/forum">會員討論區</a>><a href="<?php echo $config["url"];?>/forum/forum-<?php echo $groupid;?>.html"><?php echo $groupname;?></a></p>
	<?php }else{ ?>
		<p><a href="<?php echo $config["url"];?>"><?php echo $config["sitename"];?></a>><a href="<?php echo $config["url"];?>/forum">會員討論區</a>><a href="<?php echo $config["url"];?>/forum/forum.php?groupid=<?php echo $groupid;?>"><?php echo $groupname;?></a></p>
	<?php } ?>
	<hr><size=5>
	<!--內容-->
	<p>版主:<?php echo $moderators;?></p>
	<hr><size=5>
	<?php 
	if($config["forum"]=="true")
	{
		$d_sql = "SELECT * FROM `".$prefix."forum_posts` WHERE (`groupid` = '$groupid' AND `top` = 'true') ORDER BY `NO` DESC;;";
		$d_result = mysqli_query($conn,$d_sql);
		$d_num = mysqli_num_rows($d_result);
		if($d_num>0)
		{
			for($i=0;$i<$d_num;$i++)
			{
				$d_row = mysqli_fetch_array($d_result);
		?>
				<div style="background-color:#f5f5f5;">
					<blockquote>
						<span style="color: blue;">
						<?php if($config['url_static']=="true") { ?>
							<h3><span style="color: red;">[置頂]</span><a href="forum_posts-<?php echo $d_row['NO'];?>.html"><?php echo $d_row['title'];?></a></h3>
						<?php }else{ ?>
							<h3><span style="color: red;">[置頂]</span><a href="forum_posts.php?NO=<?php echo $d_row['NO'];?>"><?php echo $d_row['title'];?></a></h3>
						<?php }?>
						</span>
						<b>作者:</b><?php echo $d_row['name'];?>     |     <b>email:</b><?php echo $d_row['email'];?>      |     <b>發表時間:</b><?php echo $d_row['time'];?><br>
						<?php
						//判別是否為版主
						if(($_SESSION[$config['cookie_prefix'].'mod'] == $moderators and $_SESSION[$config['cookie_prefix'].'mod'] != null)or $_SESSION[$config['cookie_prefix'].'admin'] != null){ 
						?>
							<p><a href="forum_posts_edit.php?NO=<?php echo $d_row['NO'];?>"><b>編輯</b></a>    |    <a href="forum_posts_delete.php?NO=<?php echo $d_row['NO'];?>"><b>刪除</b></a></p>
						<?php }else{}?>
					</blockquote>
				</div>
		<?php
			}
		}
		?>
		<!--上為置頂帖子程式碼，下為一般帖子程式碼-->
		<?php
		$ps_sql = "SELECT * FROM `".$prefix."forum_posts` WHERE (`groupid` = '$groupid' AND `top` = 'false') ORDER BY `NO` DESC;;";
		$ps_result = mysqli_query($conn,$ps_sql);
		$ps_num = mysqli_num_rows($ps_result);
		if($ps_num>0)
		{
			for($i=0;$i<$ps_num;$i++)
			{
				$ps_row = mysqli_fetch_array($ps_result);
		?>
				<div style="background-color:#f5f5f5;">
					<blockquote>
						<span style="color: blue;">
							<?php if($config['url_static']=="true") { ?>
								<h3><a href="forum_posts-<?php echo $ps_row['NO'];?>.html"><?php echo $ps_row['title'];?></a></h3>
							<?php }else{ ?>
								<h3><a href="forum_posts.php?NO=<?php echo $ps_row['NO'];?>"><?php echo $ps_row['title'];?></a></h3>
							<?php }?>
						</span>
						<b>作者:</b><?php echo $ps_row['name'];?>     |     <b>email:</b><?php echo $ps_row['email'];?>      |     <b>發表時間:</b><?php echo $ps_row['time'];?><br>
						<?php
						//判別是否為版主
						if(($_SESSION[$config['cookie_prefix'].'mod'] == $moderators and $_SESSION[$config['cookie_prefix'].'mod'] != null)or $_SESSION[$config['cookie_prefix'].'admin'] != null){ 
						?>
							<p><a href="forum_posts_edit.php?NO=<?php echo $ps_row['NO'];?>"><b>編輯</b></a>    |    <a href="forum_posts_delete.php?NO=<?php echo $ps_row['NO'];?>"><b>刪除</b></a></p>
						<?php }else{}?>
					</blockquote>
				</div>
		<?php
			}
		}
		?>
	<hr><size=5>
		<?php 
		if($_SESSION[$config['cookie_prefix'].'username'] != null)
		{ 
			//抓取帳號資訊
			$usr_row = cpf_getUserInfo($_SESSION['username'],1);
		?>
			<form name="form" method="post" action="forumc.php">
				<table border=1>
					<tr>
						<th>會員討論區發帖</th>
					</tr>
					<tr>
						<td><input type="hidden" name="groupid" value="<?php echo $_GET['groupid']; ?>"></td>
					</tr>
					<tr>
						<td>帳號:<input type="text" name="name" value="<?php echo $username;?>" readonly="readonly"></td>
					</tr>
					<tr>
						<td>email:<input type="text" name="email" value="<?php echo $us_row[2];?>" readonly="readonly"></td>
					</tr>
					<tr>
						<td>標題:<input type="text" name="title"></td>
					</tr>
					<tr>
						<td>內容 :<br> 
						<textarea cols="100" rows="50" name="content" id="posts"></textarea></td>
					</tr>
					<script>
						CKEDITOR.replace('posts');
					</script>
					<?php if(($_SESSION[$config['cookie_prefix'].'mod'] == $moderators and $_SESSION[$config['cookie_prefix'].'mod'] != null)or $_SESSION[$config['cookie_prefix'].'admin'] != null){ ?>
					<tr>
						<td>是否置頂(是，填true；否，留空或填false):<input type="text" name="top"></td>
					</tr>
					<?php }else{} ?>
					<tr>
						<td><input type="submit" value="發帖"><input type="reset" value="重新填寫" ></td>
					</tr>
				</table>
			</form>
	<?php 
		}
		else
		{
			echo '請先登入才可以發帖!<a href="'.$config["url"].'/login.php">登入</a>';
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