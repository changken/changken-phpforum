<nav>
	<ul class="nav nav-tabs">
		<li role="presentation"><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>首頁</a></li>
		<?php if($_SESSION[$config['cookie_prefix'].'username'] != null){ ?>
		<li role="presentation" class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
				<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>會員相關<span class="caret"></span>
			</a>
			<ul class="dropdown-menu" role="menu">
				<li role="presentation"><a href="member.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>會員中心</a></li>
				<li role="presentation"><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>登出【<?php echo $_SESSION[$config['cookie_prefix'].'username'];?>】</a></li>
				<li role="presentation"><a href="update.php"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>會員個人資訊修改</a></li>			
				<li role="presentation"><a href="info.php"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>會員帳號資訊</a></li>
			</ul>
		</li>
		<?php }else{ ?>
		<li role="presentation"><a href="login.php"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>登入</a></li>
		<li role="presentation"><a href="reg.php"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>註冊</a></li>
		<?php } ?>
		<li role="presentation"><a href="<?php echo $config["url"];?>/forum"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>會員討論區</a></li>
		<li role="presentation"><a href="plugin-list.php"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>外掛列表頁面</a></li>
		<?php if($_SESSION[$config['cookie_prefix'].'admin'] != null){ ?>
		<li role="presentation"><a href="<?php echo $config["url"];?>/admin"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>控制後台</a></li>
		<?php }else{}?>
	</ul>
</nav>