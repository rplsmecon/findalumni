<?=$this->load->view('include/head')?>
<body data-mobile-sidebar="slide">
    <script type="text/javascript">
        tinymce.init({
            selector: "#PakeEditor",
            theme: "modern",
            menubar: "false",
			plugins: [
				"advlist autolink lists link image charmap print preview hr anchor pagebreak table",
				"searchreplace wordcount visualblocks visualchars code fullscreen",
				"insertdatetime media nonbreaking save contextmenu directionality",
				"emoticons template paste textcolor colorpicker textpattern"
			],
            toolbar1: "bold italic underline| link",
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
										<i class="icon-bullhorn"></i>
										Kirim Pengumuman
									</h3>
								</div>
								<div class="box-content">
									<form action="" method="post" enctype="multipart/form-data" class='form-validate form-horizontal' id="post">
                                        <div class="control-group">
                                            <label for="name" class="control-label right">Untuk Angkatan:</label>
                                            <div class="controls">
												<?php if($this->session->userdata('level') < 2): ?>
													<select name="angkatan" id="select" class="input-large">
                                                    <option value="0">Semua Angkatan</option>
                                                    <option value="<?=$this->session->userdata('angkatan')?>"><?=$this->session->userdata('angkatan')?></option>
                                                </select>
												<?php else: ?>
                                                <select name="angkatan" id="select" class="input-large">
                                                    <option value="0">Semua Angkatan</option>
                                                    <?php
                                                        $tahun_ini = date('Y');
                                                        for ($i=2009; $i<=$tahun_ini; $i++):
                                                    ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                                    <?php endfor; ?>
                                                </select>
												<?php endif; ?>
                                            </div>
                                        </div>
										<div class="control-group">
                                            <label for="name" class="control-label right">Judul:</label>
                                            <div class="controls">
                                                <input name="judul" class="input-xlarge" type="text" data-rule-required="true">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="name" class="control-label right">Isi Pengumuman:</label>
                                            <div class="controls">
                                                <textarea name="isi" class="input-xlarge" id="PakeEditor" data-rule-required="true"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input class="btn btn-primary" value="Kirim" type="submit">
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
	</body>
<?=$this->load->view('include/foot')?>
