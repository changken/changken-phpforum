<?php
session_start();
require_once("../mysql_connect.inc.php");
require_once("../config.php"); 
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
	<title><?php echo $config["sitename"];?>-會員討論區編輯帖子</title>
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
	<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>
</head>

<body>
	<div class="container">
		<!--標題-->
		<h1><?php echo $config["sitename"];?>-會員討論區編輯帖子</h1>
		<hr><size=5>
		<!--內容-->
		<?php
		if($_SESSION[$config["cookie_prefix"].'mod'] != null or $_SESSION[$config["cookie_prefix"].'admin'] != null)
		{
			if($_GET['action']=="reply")
			{
				//將$_GET['NO']丟給$NO
				//這樣在下SQL語法時才可以給搜尋的值
				$NO = $_GET['NO'];
				//若以下$NO直接用$_GET['NO']將無法使用
				$sql = "SELECT * FROM `".$prefix."forum_posts_reply` WHERE `NO`='$NO';";
				$result = mysqli_query($conn,$sql);
				$row = mysqli_fetch_array($result);
		?>
			<form name="form" method="post" action="forum_posts_editc.php?action=reply" class="form-horizontal">
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
						<div class="form-group">
							<label for="fr_NO">NO:</label>
							<input type="text" name="NO" value="<?php echo $row['NO'];?>" class="form-control" id="fr_NO" readonly />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
						<div class="form-group">
							<label for="fr_posts_id">所屬帖子:</label>
							<input type="text" name="posts_id" value="<?php echo $row['posts_id'];?>" class="form-control" id="fr_posts_id"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">				
						<div class="form-group">
							<label for="fr_name">作者</label>
							<input type="text" name="name" value="<?php echo $row['name'];?>" class="form-control" id="fr_name"/></td>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">					
						<div class="form-group">
							<label for="fr_email">email</label>
							<input type="email" name="email" value="<?php echo $row['email'];?>" class="form-control" id="fr_email"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">					
						<div class="form-group">
							<label for="fr_title">標題</label>
							<input type="text" name="title" value="<?php echo $row['title'];?>" class="form-control" id="fr_title"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">	
						<div class="form-group">
							<label for="posts_edit">內容</label>
							<textarea name="content" rows="3" id="posts_edit" class="form-control"><?php echo $row['content'];?></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
						<div class="form-group">
							<label for="fr_time">發表時間</label>
							<input type="text" name="time" value="<?php echo $row['time'];?>" class="form-control" id="fr_time" readonly />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-primary">修改</button>
						</div>
					</div>
				</div>
			</form>
			<?php	
			}
			else
			{
				//將$_GET['NO']丟給$NO
				//這樣在下SQL語法時才可以給搜尋的值
				$NO = $_GET['NO'];
				//若以下$NO直接用$_GET['NO']將無法使用
				$sql = "SELECT * FROM `".$prefix."forum_posts` WHERE `NO`='$NO';";
				$result = mysqli_query($conn,$sql);
				$row = mysqli_fetch_array($result);
			?>
			<form name="form" method="post" action="forum_posts_editc.php" class="form-horizontal">
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
						<div class="form-group">
							<label for="f_NO">NO</label>
							<input type="text" name="NO" value="<?php echo $row['NO'];?>" class="form-control" id="f_NO" readonly />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
						<div class="form-group">
							<label for="f_groupid">所屬版塊</label>
							<td><input type="text" name="groupid" value="<?php echo $row['groupid'];?>" class="form-control" id="f_groupid"/></td>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">				
						<div class="form-group">
							<label for="f_name">作者</label>
							<input type="text" name="name" value="<?php echo $row['name'];?>" class="form-control" id="f_name"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">					
						<div class="form-group">
							<label for="f_email">email</td>
							<input type="email" name="email" value="<?php echo $row['email'];?>" class="form-control" id="f_email"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">	
						<div class="form-group">
							<label for="f_title">標題</label>
							<input type="text" name="title" value="<?php echo $row['title'];?>" class="form-control" id="f_title"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">	
						<div class="form-group">
							<label for="posts_edit">內容</label>
							<textarea name="content" rows="3" id="posts_edit" class="form-control"><?php echo $row['content'];?></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">	
						<div class="form-group">
							<label for="f_time">發表時間</td>
							<td><input type="text" name="time" value="<?php echo $row['time'];?>" class="form-control" id="f_time" readonly /></td>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
						<div class="form-group">
							<label for="f_top">是否置頂</label>
								<select name="top" class="form-control" id="f_top">
									<?php if($row['top'] == "true"){?>
										<option value="true" selected>置頂</option>
										<option value="false">不置頂</option>
									<?php }else{ ?>
										<option value="true">置頂</option>
										<option value="false" selected>不置頂</option>
									<?php }?>
								</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3 col-md-8 col-md-offset-2">
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-primary">修改</button>
						</div>
					</div>
				</div>
			</form>
		<?php
			}
		}
		else
		{
			echo '您無權限觀看此頁面!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
		}
		?>
			<script>
				CKEDITOR.replace('posts_edit');
			</script>
		<hr><size=5>
		<!--頁尾-->
		<?php include_once("../cpf-footer.php");?>
	</div>
</body>

</html>