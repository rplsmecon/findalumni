<?=$this->load->view('include/head')?>
<body class='login'>
	<div class="wrapper">
		<h1><a href="<?=base_url()?>">RPL Find Alumni</a></h1>
		<div class="login-body">
			<h2>Buat RPL ID</h2>
            <?php if(!empty($pesan)): echo '<div class="alert alert-danger">'.$pesan.'</div>'; endif; ?>
			<form action="" method='post' class='form-validate' id="test">
				<div class="control-group">
					<div class="username controls">
						<div class="input-prepend">
							<span class="add-on">@</span>
							<input id="username" type="text" name='username' data-rule-maxlength="15" placeholder="Username" class='input-block-level' data-rule-required="true" data-rule-nowhitespace="true" autocomplete="off">
						</div>
						<br/>
						<span id="stsUsername"></span>
					</div>
				</div>
				<div class="control-group">
					<div class="email controls">
						<input type="text" id="email" name='email' placeholder="Email" class='input-block-level' data-rule-required="true" data-rule-email="true" autocomplete="off">
						<br/>
						<span id="stsEmail"></span>
					</div>
				</div>
				<div class="control-group">
					<div class="realname controls">
						<input type="text" name='namalengkap' placeholder="Nama Lengkap" class='input-block-level' data-rule-required="true" autocomplete="off">
					</div>
				</div>
				<div class="control-group">
					<div class="year controls">
						<select name="angkatan" id="select" class="input-large">
							<?php
								$tahun_ini = date('Y');
								for ($i=2009; $i<=$tahun_ini; $i++):
							?>
							<option value="<?=$i?>"><?=$i?></option>
							<?php endfor; ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<div class="pw controls">
						<input type="password" name="password" placeholder="Password" class="input-block-level" data-rule-required="true" id="pw" autocomplete="off">
					</div>
				</div>
				<div class="control-group">
					<div class="pwc controls">
						<input type="password" name="passwordc" placeholder="Konfirmasi Password" class="input-block-level" data-rule-required="true" id="pwc" data-rule-equalto="#pw" autocomplete="off">
					</div>
				</div>
				<div class="control-group">
					<div class="g-recaptcha" data-sitekey="6LfMBf8SAAAAAPlrgHKOiHib3dAi8TdfceG3L40Q"></div>
				</div>
				<div class="submit">
					<input type="submit" id="btnDaftar" value="Daftar!" class='btn btn-primary'>
				</div>
			</form>
			<div class="forget">
				<a href="<?=base_url('auth/login')?>"><span>Masuk</span></a>
				<a href="https://graph.facebook.com/oauth/authorize?client_id=<?=$fb_api_key?>&redirect_uri=<?php echo base_url('auth/login');?>&scope=user_about_me,user_photos,email,user_birthday,user_hometown,user_location"><span><i class="icon-facebook-sign"></i> Login Pakai Facebook</span></a>
			</div>
		</div>
	</div>
		<!-- S:JS VALIDASI -->
		<script type="text/javascript">
			$(document).ready(function()
			{
				$("#username").change(function()
				{
					var username = $("#username").val();
					$("#stsUsername").html('Checking...');
					$.ajax({
						type: "POST",
						url: "<?=base_url('auth/cekusername')?>",
						data: "username="+ username,
						success: function(hasil){
							if(hasil == '0')
							{
								$("#stsUsername").html('<font color="green">Username tersedia</font>');
								$("#btnDaftar").show();
							}
							else
							{
								$("#stsUsername").html('<font color="red">Username sudah digunakan</font>');
								$("#btnDaftar").hide();
							}
					   }
					  });
				return false;
				});
				
				$("#email").change(function()
				{
					var email = $("#email").val();
					$("#stsEmail").html('Checking...');
					$.ajax({
						type: "POST",
						url: "<?=base_url('auth/cekemail?e=')?>"+email,
						data: "email="+ email,
						success: function(hasil){
							if(hasil == '0')
							{
								$("#stsEmail").html('');
								$("#btnDaftar").show();
							}
							else
							{
								$("#stsEmail").html('<font color="red">Email sudah digunakan</font>');
								$("#btnDaftar").hide();
							}
					   }
					  });
				return false;
				});
			
			});
		</script>
		<!-- E:JS VALIDASI -->
		<!-- S:JS RECAPTCHA -->
		<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
		<!-- E:JS RECAPTCHA -->
</body>
<?=$this->load->view('include/foot')?>
