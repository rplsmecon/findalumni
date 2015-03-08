<?=$this->load->view('include/head')?>
<body class='login'>
	<div class="wrapper">
		<h1><a href="<?=base_url()?>">RPL Find Alumni</a></h1>
		<!-- tes -->
		<div class="login-body">
			<h2>Masuk dengan RPL ID</h2>
            <?php if(!empty($pesan)): echo '<div class="alert alert-danger">'.$pesan.'</div>'; endif; ?>
			<form action="" method='post' class='form-validate' id="test">
				<div class="username controls">
					<div class="input-prepend">
						<span class="add-on">@</span>
						<input type="text" name='username' data-rule-maxlength="15" data-rule-nowhitespace="true" placeholder="Username" class='input-block-level' data-rule-required="true" data-rule-nowhitespace="true">
					</div>
				</div>
				<div class="username controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-key"></i></span>
						<input type="password" name='password'  placeholder="Password" class='input-block-level' data-rule-required="true">
					</div>
				</div>
				<div class="submit">
					<input type="submit" value="Masuk" class='btn btn-primary'>
				</div>
			</form>
			<div class="forget">
				<a href="https://graph.facebook.com/oauth/authorize?client_id=<?=$fb_api_key?>&redirect_uri=<?php echo base_url('auth/login');?>&scope=user_about_me,user_photos,email,user_birthday,user_hometown,user_location"><span><i class="icon-facebook-sign"></i> Login Pakai Facebook</span></a>
				<!--
				<a href="<?=base_url('auth/login?facebook=1')?>"><span><i class="icon-facebook-sign"></i> Login Pakai Facebook</span></a>
				-->
				<a href="<?=base_url('auth/twitterlogin')?>"><span><i class="icon-twitter-sign"></i> Login Pakai Twitter</span></a>
				<a href="<?=base_url('auth/forgotpassword')?>"><span>Lupa Password</span></a>
				<a href="<?=base_url('auth/register')?>"><span>Belum punya RPL ID? Daftar di sini!</span></a>
			</div>
		</div>
	</div>
</body>
<?=$this->load->view('include/foot')?>
