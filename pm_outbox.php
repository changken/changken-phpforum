			<h1>已寄出</h1>
	<?php 
			include_once("pm_nav.php");
			$sql = "SELECT * FROM `".$prefix."user_pm` WHERE `send_from`='$user';";
			$result = mysqli_query($conn,$sql);
	?>
			<table width="500" border="1" cellspacing="0" cellpadding="0">
				<tr>
					<td>寄件人帳號</td>
					<td>收件人帳號</td>
					<td>標題</td>
					<td>內容</td>
					<td>編輯</td>
					<td>刪除</td> 
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
					echo "<td>".$row['send_to']."</td>";
                    echo "<td>".$row['title']."</td>";
                    echo "<td>".$row['content']."</td>";
		            echo "<td><a href='user_pm_edit.php?NO=";
					echo $row[0]."'><b>編輯</b></a></td>";
					echo "<td><a href='user_pm_delete.php?NO=";
					echo $row[0]."'><b>刪除</b></a></td>";
                    echo "</tr>";
				}
			}
	?>
			</table>