<?php 
session_start();
include('../config.php');
include("../mysql_connect.inc.php");
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
$sql="SELECT * FROM forum_group ORDER BY groupid DESC;";
$result=mysql_query($sql);

  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
echo"<div style='background-color:#f5f5f5;'>";
echo"<blockquote><b><span style='color: blue;'>";
if($config['url_static']=="true")
{
?>
<h3><a href="forum-<?php echo $row[0];?>.html"><?php echo $row['groupname'];?></a></h3>
<?php
}
else
{
?>
<h3><a href="forum.php?groupid=<?php echo $row[0];?>"><?php echo $row['groupname'];?></a></h3>
<?php
}
echo"</span></b>";
echo"<b>版主:</b>";
echo $row['moderators'];
echo"</blockquote>";
echo"</div>";
        }
 
  }
  ?>
</table>
<?php 
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