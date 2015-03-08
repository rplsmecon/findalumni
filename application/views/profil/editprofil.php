<?=$this->load->view('include/head')?>
<body data-mobile-sidebar="slide">
	<script type="text/javascript">
		tinymce.init({
			selector: "#PakeEditor",
			theme: "modern",
			menubar: "false",
			toolbar1: "bold italic",
			image_advtab: true,
		});
	</script>
		<?=$this->load->view('include/header')?>
			<div id="main">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<div class="box box-color box-bordered">
								<div class="box-title">
									<h3>
										<i class="icon-user"></i>
										Edit Profil
									</h3>
								</div>
								<div class="box-content nopadding">
									<ul class="tabs tabs-inline tabs-top">
										<li class="active">
											<a href="#profil" data-toggle="tab"><i class="icon-user"></i> Profil</a>
										</li>
										<li>
											<a href="#password" data-toggle="tab"><i class="icon-lock"></i> Password</a>
										</li>
									</ul>
									<div class="tab-content padding tab-content-inline tab-content-bottom">
										<div class="tab-pane active" id="profil">
											<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong>Penting!</strong> Isi dengan data yang asli dan terbaru ya, agar teman-teman kamu bisa menemukan kamu.
											</div>
											<form action="<?=base_url('profil/updateprofil')?>" method='post' class='form-validate form-horizontal' id="prfl" enctype="multipart/form-data">
												<div class="row-fluid">
													<div class="span2">
														<div class="fileupload fileupload-new" data-provides="fileupload">
															<div class="fileupload-new thumbnail" style="max-width: 200px; max-height: 150px;"><img src="<?=base_url('statics/uploads').'/'.$dataUser->foto?>"></div>
															<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
															<div>
																<span class="btn btn-file"><span class="fileupload-new">Pilih foto</span><span class="fileupload-exists">Ganti</span><input name="foto" type="file"></span>
																<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Batal</a>
															</div>
														</div>
													</div>
													<div class="span10">
														<div class="control-group">
															<label for="name" class="control-label right">Nama Lengkap:</label>
															<div class="controls">
																<input name="namalengkap" class="input-xlarge" value="<?=$dataUser->namalengkap?>" type="text" data-rule-required="true">
															</div>
														</div>
														<div class="control-group">
															<label for="name" class="control-label right">Nama Panggilan:</label>
															<div class="controls">
																<input name="namapanggilan" class="input-xlarge" value="<?=$dataUser->namapanggilan?>" type="text">
															</div>
														</div>
														<div class="control-group">
															<label for="name" class="control-label right">Jenis Kelamin:</label>
															<div class="controls">
																<div class="check-line">
																	<input type="radio" id="l" class="icheck-me" name="gender" data-skin="square" data-color="blue" value="l" <?php if($dataUser->gender=="l"): echo "checked"; endif;?>> <label class='inline' for="l">Laki-laki</label>
																</div>
																<div class="check-line">
																	<input type="radio" id="p" class="icheck-me" name="gender" data-skin="square" data-color="blue" value="p" <?php if($dataUser->gender=="p"): echo "checked"; endif;?>> <label class='inline' for="p">Perempuan</label>
																</div>
															</div>
														</div>
														<div class="control-group">
															<label for="tgl_lahir" class="control-label">Tanggal Lahir:</label>
															<div class="controls">
																<input type="text" name="tgl_lahir" value="<?=$dataUser->tgl_lahir?>" id="tgl_lahir" class="input-xlarge datepick" data-date-format="dd/mm/yyyy">
															</div>
														</div>
														<?php if($dataUser->level > 1): ?>
														<div class="control-group">
															<label for="name" class="control-label right">Tahun Masuk:</label>
															<div class="controls">
																<input name="angkatan" class="input-xlarge" value="<?=$dataUser->angkatan?>" type="text" data-rule-digits="true" data-rule-required="true" data-rule-maxlength="4" data-rule-minlength="4">
															</div>
														</div>
														<?php endif; ?>
														<div class="control-group">
															<label for="name" class="control-label right">Nomor HP:</label>
															<div class="controls">
																<input name="hp" class="input-xlarge" value="<?=$dataUser->hp?>" type="text" data-rule-digits="true">
															</div>
														</div>
														<div class="control-group">
															<label for="name" class="control-label right">PIN BBM:</label>
															<div class="controls">
																<input name="bbm" class="input-xlarge" value="<?=$dataUser->bbm?>" type="text">
															</div>
														</div>
														<div class="control-group">
															<label for="name" class="control-label right">Alamat:</label>
															<div class="controls">
																<textarea name="alamat" class="input-xlarge"><?=$dataUser->alamat?></textarea>
															</div>
														</div>
														 <div class="control-group">
															<label for="name" class="control-label right">Tentang Saya:</label>
															<div class="controls">
																<textarea name="bio" class="input-xlarge" id="PakeEditor"><?=$dataUser->bio?></textarea>
															</div>
														</div>
														<div class="control-group">
															<label for="name" class="control-label right">Kuliah di:</label>
															<div class="controls">
																<input name="universitas" class="input-xlarge" value="<?=$dataUser->universitas?>" type="text">
															</div>
														</div>
														<div class="control-group">
															<label for="perusahaan" class="control-label right">Bekerja di:</label>
															<div class="controls">
																<input name="perusahaan" class="input-xlarge" value="<?=$dataUser->perusahaan?>" type="text">
															</div>
														</div>
														<div class="form-actions">
															<input class="btn btn-primary" value="Simpan" type="submit">
															<input class="btn" value="Batalkan Perubahan" type="reset">
														</div>
													</div>
												</div>
											</form>
										</div>
										<div class="tab-pane" id="password">
											<form action="<?=base_url('profil/updatepassword')?>" method='post' class='form-validate form-horizontal' id="pwd" enctype="multipart/form-data">
												<div class="control-group">
													<label for="password" class="control-label right">Password Baru:</label>
													<div class="pw controls">
														<input type="password" name="password"  class="input-xlarge" data-rule-required="true" id="pw" autocomplete="off">
													</div>
												</div>
												<div class="control-group">
													<label for="passwordc" class="control-label right">Konfirmasi Password:</label>
													<div class="pwc controls">
														<input type="password" name="passwordc" class="input-xlarge" data-rule-required="true" id="pwc" data-rule-equalto="#pw" autocomplete="off">
													</div>
												</div>
												<div class="form-actions">
													<input class="btn btn-primary" value="Simpan" type="submit">
													<input class="btn" value="Batalkan Perubahan" type="reset">
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
<?=$this->load->view('include/foot')?>