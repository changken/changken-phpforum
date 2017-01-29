			<h1>已寄出</h1>
	<?php 
			include_once("pm_nav.php");
			$sql = "SELECT * FROM `".$prefix."user_pm` WHERE `send_from`='$user' AND `state`='outbox';";
			$result = mysqli_query($conn,$sql);
	?>
			<table class="table">
				<tr>
					<td>收件人帳號</td>
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
					echo "<td>".$row['send_to']."</td>";
                    echo "<td>".$row['title']."</td>";
					echo "<td class='info'><span style='color:blue;'>這是備份！</span></td>";		
                    echo "<td>".$row['time']."</td>"; 		            
					echo "<td><a href='member.php?action=view&ty=outbox&NO=";
					echo $row['NO']."'><b>查看</b></a></td>";
                    echo "</tr>";
				}
			}
	?>
			</table>