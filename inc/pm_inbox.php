			<h1>收件箱</h1>
	<?php 
			include_once("pm_nav.php");
			$sql = "SELECT * FROM `".$prefix."user_pm` WHERE `send_to`='$user' AND `state`='inbox';";
			$result = mysqli_query($conn,$sql);
	?>
			<table class="table">
				<tr>
					<td>寄件人帳號</td>
					<td>標題</td>
					<td>狀態</td>
					<td>時間</td>
					<td>查看</td>
				</tr>
	<?php
			$num = mysqli_num_rows($result);
			if($num>0)
			{
				for($i=0;$i<$num;$i++)
				{
					$row = mysqli_fetch_array($result);
                    echo "<tr>";
                    echo "<td>".$row['send_from']."</td>";
                    echo "<td>".$row['title']."</td>";
					if($row['if_read'] == 1)
					{
						echo "<td class='success'><span style='color:green;'>已讀</span></td>";
					}
					else
					{
						echo "<td class='warning'><span style='color:orange;'>未讀</span></td>";		
					}
                    echo "<td>".$row['time']."</td>"; 
		            echo "<td><a href='member.php?action=view&ty=inbox&NO=";
					echo $row['NO']."'><b>查看</b></a></td>";
				}
			}
	?>
			</table>