<?php
session_start();
require_once("../mysql_connect.inc.php");
require_once('../config.php');
require_once('../inc/function.php');

$NO = $_GET['NO'];//帖子id
$username = $_SESSION[$config['cookie_prefix'].'username'];//抓取帳號資訊

//抓取帖子資訊
$ps_sql = "SELECT * FROM `".$prefix."forum_posts` WHERE `NO`='$NO';";
$ps_result = mysqli_query($conn,$ps_sql);
$ps_row = mysqli_fetch_array($ps_result);
$title = $ps_row['title'];
$groupid = $ps_row['groupid'];//從帖子訊息中抓取版塊資訊

//抓取版塊資訊
$g_sql = "SELECT * FROM `".$prefix."forum_group` WHERE `groupid` = '$groupid';";
$g_result = mysqli_query($conn,$g_sql);
$g_row = mysqli_fetch_array($g_result);//改個變數就沒代誌
$groupname = $g_row['groupname'];
$moderators = $g_row['moderators'];
?> 
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-<?php echo $title;?></title>
	<meta charset="utf-8"/>
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
		<h1 class="text-center"><?php echo $config["sitename"];?>-<?php echo $title;?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $config["url"];?>"><?php echo $config["sitename"];?></a></li>
			<li><a href="<?php echo $config["url"];?>/forum">會員討論區</a></li>
			<?php if($config['url_static']=="true"){ ?>
				<li><a href="<?php echo $config["url"];?>/forum/forum-<?php echo $groupid;?>.html"><?php echo $groupname;?></a></li>
				<li class="active"><a href="<?php echo $config["url"];?>/forum/forum_posts-<?php echo $NO;?>.html"><?php echo $title;?></a></li>
			<?php }else{?>
				<li><a href="<?php echo $config["url"];?>/forum/forum.php?groupid=<?php echo $groupid;?>"><?php echo $groupname;?></a></li>
				<li class="active"><a href="<?php echo $config["url"];?>/forum/forum_posts.php?NO=<?php echo $NO;?>"><?php echo $title;?></a></li>
			<?php } ?>		
		</ol>
		<hr><size=5>
		<!--內容-->
		<?php 
		if($config["forum"]=="true")
		{
		?>
			<div style="background-color:#f5f5f5;">
				<blockquote>
					<span style="color: blue;">
						<?php if($config['url_static']=="true"){?>
							<?php if($ps_row['top']=="true"){?>
								<h3><span style="color: red;">[置頂]</span><a href="forum_posts-<?php echo $ps_row['NO'];?>.html"><?php echo $ps_row['title'];?></a></h3>
							<?php }else{ ?>
								<h3><a href="forum_posts-<?php echo $ps_row['NO'];?>.html"><?php echo $ps_row['title'];?></a></h3>
							<?php }?>
						<?php }else{?>
							<?php if($ps_row['top']=="true"){?>
								<h3><span style="color: red;">[置頂]</span><a href="forum_posts.php?NO=<?php echo $ps_row['NO'];?>"><?php echo $ps_row['title'];?></a></h3>
							<?php }else{?>
								<h3><a href="forum_posts.php?NO=<?php echo $ps_row['NO'];?>"><?php echo $ps_row['title'];?></a></h3>
							<?php } ?>
						<?php }?>
					</span>
					<?php echo $ps_row['content'];?><br>
					<br>
					<b>作者:</b><?php echo $ps_row['name'];?>    |     <b>email:</b><?php echo $ps_row['email'];?>     |     <b>發表時間:</b><?php echo $ps_row['time'];?><br>
					<?php if(($_SESSION[$config['cookie_prefix'].'mod'] == $moderators and $_SESSION[$config['cookie_prefix'].'mod'] != null )or $_SESSION[$config['cookie_prefix'].'admin'] != null){ //判別是否為版主開始 ?>
						<p><a href="forum_posts_edit.php?NO=<?php echo $ps_row['NO'];?>"><b>編輯</b></a>     <a href="forum_posts_delete.php?NO=<?php echo $ps_row['NO'];?>"><b>刪除</b></a></p>
					<?php }else{}//判別是否為版主結束?>
				</blockquote>
			</div>
		<?php  
		$posts_id = $ps_row['NO'];
		$re_sql = "SELECT * FROM `".$prefix."forum_posts_reply` WHERE `posts_id`='$posts_id';";
		$re_result = mysqli_query($conn,$re_sql);
		?>
	<h2>帖子回覆</h2>
	<?php
        $re_num = mysqli_num_rows($re_result);
		if($re_num>0)
		{
			for($i=0;$i<$re_num;$i++)
			{
                $re_row = mysqli_fetch_array($re_result);
	?>
				<div style='background-color:#f5f5f5;'>
					<blockquote>
						<span style='color: blue;'><h3><?php echo $re_row['title'];?></h3></span>
						<?php echo $re_row['content'];?><br>
						<br>
						<b>作者:</b><?php echo $re_row['name'];?>      |     <b>email:</b><?php echo $re_row['email'];?>     |     <b>發表時間:</b><?php echo $re_row['time'];?><br>
					<?php if(($_SESSION[$config['cookie_prefix'].'mod'] == $moderators and $_SESSION[$config['cookie_prefix'].'mod'] != null) or $_SESSION[$config['cookie_prefix'].'admin'] != null){ ?>
						<p><a href="forum_posts_edit.php?action=reply&NO=<?php echo $re_row['NO'];?>"><b>編輯</b></a>     |     <a href="forum_posts_delete.php?action=reply&NO=<?php echo $re_row['NO'];?>"><b>刪除</b></a></p>
					<?php }else{} //判別是否為版主結束?>
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
		<form name="form" method="post" action="forumc.php?action=reply" class="form-horizontal">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
					<p class="text-center">回覆</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
					<div class="form-group">
						<label for="fr_posts_id">帖子ID</label>
						<input type="text" name="posts_id" value="<?php echo $posts_id;?>" class="form-control" id="fr_posts_id" readonly>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
					<div class="form-group">
						<label for="fr_name">帳號</label>
						<td><input type="text" name="name" value="<?php echo $username;?>" class="form-control" id="fr_name" readonly></td>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
					<div class="form-group">
						<label for="fr_email">email</label>
						<td><input type="email" name="email" value="<?php echo $usr_row['email'];?>" class="form-control" id="fr_email" readonly></td>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
					<div class="form-group">
						<label for="fr_title">標題</label>
						<input type="text" name="title" class="form-control" id="fr_title">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
					<div class="form-group">	
						<label for="reply">內容</label>
						<textarea rows="3" name="content" id="reply" class="form-control"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
					<div class="form-group">
						<button type="submit" class="btn btn-primary">回覆</button>
						<button type="reset" class="btn btn-danger">砍掉重練</button>
					</div>
				</div>
			</div>
		</form>
		<script>
			CKEDITOR.replace('reply');
		</script>
	<?php 
		}
		else
		{
			echo '請先登入才可以回覆!<a href="'.$config["url"].'/login.php">登入</a>';
		} 
	}
	else
	{
		echo "很抱歉，".$config["sitename"]."的會員討論區已經關閉";
	} 
	?>
	<hr><size=5>
	<!--頁尾-->
	<?php
		include_once("../cpf-footer.php");
	?>
	</div>
</body>

</html>