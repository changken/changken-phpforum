<?php
session_start();
include('../config.php'); 
include("../mysql_connect.inc.php");
//抓取版塊資訊開始
$groupid = $_GET['groupid']; 
$sql="SELECT * FROM forum_group WHERE groupid = '$groupid';";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$groupname = $row['groupname'];
$moderators = $row['moderators'];
//抓取版塊資訊結束
//抓取帳號資訊開始
$username = $_SESSION['username'];
//抓取帳號資訊結束
?> 
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config["sitename"];?>-會員討論區-<?php echo $groupname;?></title>
<meta charset="utf-8" />
<link rel="stylesheet" href="../style.css" />
<?php if($_SESSION['admin']!=null or $_SESSION['mod']!=null){?>
<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>
<?php }else{?>
<script src="//cdn.ckeditor.com/4.4.7/basic/ckeditor.js"></script>
<?php }?>
</head>

<body>
<!--標題-->
<h1><?php echo $config["sitename"];?>-會員討論區-<?php echo $groupname;?></h1>
<?php
	if($config['url_static']=="true")
	{
?>
<p><a href="<?php echo $config["url"];?>"><?php echo $config["sitename"];?></a>><a href="<?php echo $config["url"];?>/forum">會員討論區</a>><a href="<?php echo $config["url"];?>/forum/forum-<?php echo $groupid;?>.html"><?php echo $groupname;?></a></p>
<?php
	}
	else
	{
?>
<p><a href="<?php echo $config["url"];?>"><?php echo $config["sitename"];?></a>><a href="<?php echo $config["url"];?>/forum">會員討論區</a>><a href="<?php echo $config["url"];?>/forum/forum.php?groupid=<?php echo $groupid;?>"><?php echo $groupname;?></a></p>
<?php
	}
?>
<hr><size=5>
<!--內容-->
<p>版主:<?php echo $moderators;?></p>
<hr><size=5>
<?php 
if($config["forum"]=="true")
{ 
	$groupid = $_GET['groupid']; 
	$sql="SELECT * FROM forum_posts WHERE groupid = '$groupid';";
	$result=mysql_query($sql);

	if(mysql_num_rows($result)>0)
	{
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
				if($row['top']=="true"){
echo"<div style='background-color:#f5f5f5;'>";
echo"<blockquote><b><span style='color: blue;'>";
if($config['url_static']=="true")
{
?>
<h3><span style='color: red;'>[置頂]</span><a href="forum_posts-<?php echo $row[0];?>.html"><?php echo $row['title'];?></a></h3>
<?php
}
else
{
?>
<h3><span style='color: red;'>[置頂]</span><a href="forum_posts.php?NO=<?php echo $row[0];?>"><?php echo $row['title'];?></a></h3>
<?php
}
echo"</span></b>";
echo"<b>作者:</b>";
echo $row['name'];
echo "    |     <b>email:</b>";
echo $row['email'];
echo "|     <b>發表時間:</b>".$row['time'];
echo"<br>";
//判別是否為版主開始
if($_SESSION['mod'] == $moderators and $_SESSION['mod'] != null or $_SESSION['admin'] != null){
echo "<p><a href='forum_posts_edit.php?NO=";
echo $row[0]."'><b>編輯</b></a>     ";
echo "<a href='forum_posts_delete.php?NO=";
echo $row[0]."'><b>刪除</b></a></p>";
}else{}
//判別是否為版主結束
echo"</blockquote>";
echo"</div>";
           }
        }
 
  }
  ?>
<!--上為置頂帖子程式碼，下為一般帖子程式碼-->
<?php
$groupid = $_GET['groupid']; 
$sql="SELECT * FROM forum_posts where groupid = '$groupid'";
$result=mysql_query($sql);

  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
				if($row['top']=="false"){
echo"<div style='background-color:#f5f5f5;'>";
echo"<blockquote><b><span style='color: blue;'>";
if($config['url_static']=="true")
{
?>
<h3><a href="forum_posts-<?php echo $row[0];?>.html"><?php echo $row['title'];?></a></h3>
<?php
}
else
{
?>
<h3><a href="forum_posts.php?NO=<?php echo $row[0];?>"><?php echo $row['title'];?></a></h3>
<?php
}
echo"</span></b>";
echo"<b>作者:</b>";
echo $row['name'];
echo "    |     <b>email:</b>";
echo $row['email'];
echo "|     <b>發表時間:</b>".$row['time'];
echo"<br>";
//判別是否為版主開始
if($_SESSION['mod'] == $moderators and $_SESSION['mod'] != null or $_SESSION['admin'] != null){
echo "<p><a href='forum_posts_edit.php?NO=";
echo $row[0]."'><b>編輯</b></a>     ";
echo "<a href='forum_posts_delete.php?NO=";
echo $row[0]."'><b>刪除</b></a></p>";
}else{}
//判別是否為版主結束
echo"</blockquote>";
echo"</div>";
             }
        }
 
  }
  ?>
<hr><size=5>
<?php 
if($_SESSION['username'] != null or $_SESSION['mod'] != null or $_SESSION['admin'] != null)
{ 
//抓取帳號資訊
$sql="SELECT * FROM user WHERE username = '$username';";
$result=mysql_query($sql);
$row=mysql_fetch_row($result);
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
<td>email:<input type="text" name="email" value="<?php echo $row[2];?>" readonly="readonly"></td>
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
<?php 
if($_SESSION['mod'] == $moderators and $_SESSION['mod'] != null or $_SESSION['admin'] != null)
{
?>
<tr>
<td>是否置頂(是，填true；否，留空或填false):<input type="text" name="top"></td>
</tr>
<?php 
}
else
{}
?>
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
<?php include("../cpf-footer.php");?>
</body>

</html>