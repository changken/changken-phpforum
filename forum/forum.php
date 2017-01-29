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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 最新編譯和最佳化的 CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- 選擇性佈景主題 -->
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<!--引入Jquery-->
	<script src="../js/jquery-3.1.1.min.js"></script>
	<!-- 最新編譯和最佳化的 JavaScript -->
	<script src="../js/bootstrap.min.js"></script>
	<!--自訂義css-->
	<link rel="stylesheet" href="../style.css" />
	<?php if($_SESSION[$config['cookie_prefix'].'admin']!=null or $_SESSION[$config['cookie_prefix'].'mod']!=null){?>
		<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>
	<?php }else{?>
		<script src="//cdn.ckeditor.com/4.4.7/basic/ckeditor.js"></script>
	<?php }?>
</head>

<body>
	<div class="container">
		<!--標題-->
		<h1 class="text-center"><?php echo $config["sitename"];?>-會員討論區-<?php echo $groupname;?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $config["url"];?>"><?php echo $config["sitename"];?></a></li>
			<li><a href="<?php echo $config["url"];?>/forum">會員討論區</a></li>
			<?php if($config['url_static']=="true"){ ?>
				<li class="active"><a href="<?php echo $config["url"];?>/forum/forum-<?php echo $groupid;?>.html"><?php echo $groupname;?></a></li>
			<?php }else{ ?>
				<li class="active"><a href="<?php echo $config["url"];?>/forum/forum.php?groupid=<?php echo $groupid;?>"><?php echo $groupname;?></a></li>
			<?php } ?>
		</ol>
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
		//上為置頂帖子程式碼，下為一般帖子程式碼
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
				$usr_row = cpf_getUserInfo($username,1);
		?>
				<form name="form" method="post" action="forumc.php" class="form-horizontal">
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
							<p class="text-center">發帖</p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
							<div class="form-group">
								<label for="f_groupid">版塊ID</label>
								<input type="text" name="groupid" value="<?php echo $_GET['groupid']; ?>" class="form-control" id="f_groupid" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
							<div class="form-group">
								<label for="f_username">帳號</label>
								<input type="text" name="name" value="<?php echo $username;?>" class="form-control" id="f_username" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
							<div class="form-group">
								<label for="f_email">email</label>
								<input type="email" name="email" value="<?php echo $usr_row[2];?>" class="form-control" id="f_email" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
							<div class="form-group">
								<label for="f_title">標題</label>
								<input type="text" name="title" class="form-control" id="f_title">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
							<div class="form-group">
								<label for="posts">內容</label>
								<textarea rows="3" name="content" id="posts" class="form-control"></textarea>
							</div>
						</div>
					</div>
						<?php if(($_SESSION[$config['cookie_prefix'].'mod'] == $moderators and $_SESSION[$config['cookie_prefix'].'mod'] != null)or $_SESSION[$config['cookie_prefix'].'admin'] != null){ ?>
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
							<div class="form-group">
								<label for="f_top">是否置頂</label>
									<select name="top" class="form-control" id="f_top">
										<option value="true">置頂</option>
										<option value="false">不置頂</option>
									</select>
							</div>
						</div>
					</div>
						<?php }else{} ?>
					<div class="row">
						<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
							<div class="form-group">
								<button type="submit" class="btn btn-primary">發帖</button>
								<button type="reset" class="btn btn-danger">砍掉重練</button>
							</div>
						</div>
					</div>
				</form>
				<script>
					CKEDITOR.replace('posts');
				</script>
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
	</div>
</body>

</html>