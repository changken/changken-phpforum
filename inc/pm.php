			<h1>短消息查看</h1>
	<?php 
			$NO = $_GET['NO'];
			include_once("pm_nav.php");
			if($_GET['ty'] == "inbox")
			{
				$sql = "SELECT * FROM `".$prefix."user_pm` WHERE `NO` ='$NO';";
				$sql_u = "UPDATE `".$prefix."user_pm` SET  `if_read` =  '1' WHERE  `NO` ='$NO';";
				if(mysqli_query($conn,$sql_u))
				{
				}
				else
				{
					echo "<p>錯誤！</p>";
				}
			}
			elseif($_GET['ty'] == "outbox")
			{
				$sql = "SELECT * FROM `".$prefix."user_pm` WHERE `NO` ='$NO';";
			}
			else
			{}
				$result = mysqli_query($conn,$sql);
				$row = mysqli_fetch_array($result);
	?>
			<table class="table">
				<tr>
					<td>寄件人帳號</td>
					<td><?php echo $row['send_from'];?></td>
				</tr>
				<tr>
					<td>收件人帳號</td>
					<td><?php echo $row['send_to'];?></td>
				</tr>
				<tr>
					<td>標題</td>
					<td><?php echo $row['title'];?></td>
				</tr>
				<tr>
					<td>內容</td>
					<td><?php echo $row['content'];?></td>
				</tr>
				<tr>
					<td>時間</td>
					<td><?php echo $row['time'];?></td>
				</tr>
				<tr>	
					<td>狀態</td>
					<?php
					if($row['if_read'] == 1)
					{
						echo "<td class='success'><span style='color:green;'>已讀</span></td>";
					}
					elseif($row['if_read'] == 0)
					{
						echo "<td class='warning'><span style='color:orange;'>未讀</span></td>";		
					}
					else
					{
						echo "<td class='info'><span style='color:blue;'>這是備份！</span></td>";							
					}
					?>
				</tr>
				<tr>
					<td>操作</td>
					<td><a href="user_pm_delete.php?NO=<?php echo $row['NO'];?>" class="btn btn-danger">刪除</a></td>
				</tr>
			</table>