		<form name="form" method="post" action="user_pmc.php" class="form-horizontal">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-6 col-md-offset-3">
					<p class="text-center">發送會員私人短消息</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-6 col-md-offset-3">
					<div class="form-group">
						<label for="pm_send_from">寄件人帳號:</td>
						<input type="text" name="send_from" value="<?php echo $user;?>" class="form-control" id="pm_send_from" readonly>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-6 col-md-offset-3">
					<div class="form-group">
						<label for="pm_send_to">收件人帳號:</label>
						<input type="text" name="send_to" class="form-control" id="pm_send_to">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-6 col-md-offset-3">
					<div class="form-group">
						<label for="pm_title">標題:</label>
						<input type="text" name="title" class="form-control" id="pm_title">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-6 col-md-offset-3">
					<div class="form-group">
						<label for="pm">內容:</label>
						<textarea rows="3" name="content" id="pm" class="form-control"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3 col-md-6 col-md-offset-3">
					<div class="form-group">
						<button type="submit" class="btn btn-primary">發送</button>
						<button type="reset" class="btn btn-danger">砍掉重練</button>
					</div>
				</div>
			</div>
		</form>
		<script>
			CKEDITOR.replace('pm');
		</script>