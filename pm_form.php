		<form name="form" method="post" action="user_pmc.php">
			<table border=1>
				<tr>
					<th>發送會員私人短消息:</th>
				</tr>
				<tr>
					<td>寄件人帳號:<input type="text" name="send_from" value="<?php echo $user;?>" readonly="readonly"></td>
				</tr>
				<tr>
					<td>收件人帳號:<input type="text" name="send_to"></td>
				</tr>
				<tr>
					<td>標題:<input type="text" name="title"></td>
				</tr>
				<tr>
					<td>內容 :<br> 
					<textarea cols=60 rows=6 name="content" id="pm"></textarea></td>
				</tr>
				<script>
					CKEDITOR.replace('pm');
				</script>
				<tr>
					<td><input type="submit" value="發送"><input type="reset" value="重新填寫" ></td>
				</tr>
			</table>
		</form>