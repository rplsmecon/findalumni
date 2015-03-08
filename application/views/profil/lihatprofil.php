<?=$this->load->view('include/head')?>
<body data-mobile-sidebar="slide">
		<?=$this->load->view('include/header')?>
			<div id="main">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<div class="box box-color box-bordered">
								<div class="box-title">
									<h3>
										<i class="icon-user"></i>
										Profil
									</h3>
								</div>
								<?php
									$level = $dataProfil->level;
									if($level=='0'):
										$admin = '';
									elseif($level=='1'):
										$admin	= '<span class="badge badge-success"><i class="icon-ok-sign"></i> Admin Angkatan '.$dataProfil->angkatan.'</span>';
									elseif($level=='2'):
										$admin	= '<span class="badge badge-success"><i class="icon-ok-sign"></i> Admin Banget</span>';
									endif;
								?>
								<div class="box-content nopadding">
									<ul class="tabs tabs-inline tabs-top">
										<li class="active">
											<a href="#detail" data-toggle="tab"><i class="icon-user"></i> Tentang <?=$dataProfil->namalengkap?></a>
										</li>
										<li>
											<a href="#qa" data-toggle="tab"><i class="icon-question-sign"></i> Tanya Jawab</a>
										</li>
									</ul>
									<div class="tab-content padding tab-content-inline tab-content-bottom">
										<div class="tab-pane active" id="detail">
											<div class="row-fluid">
												<div class="span12">
													<div class="row-fluid">
														<div class="span6">
															<img src="<?=base_url('statics/uploads').'/'.$dataProfil->foto?>" width="300">
														</div>
														<div class="span6">
															<?=$admin?><br/>
															<b>Nama engkap: </b><?=$dataProfil->namalengkap?><br/>
															<?php if(!empty($dataProfil->namapanggilan)): ?>
															<b>Nama Panggilan: </b><?=$dataProfil->namapanggilan?><br/>
															<?php endif; ?>
															<?php if(!empty($dataProfil->tgl_lahir)): ?>
															<b>Tanggal Lahir: </b><?=$dataProfil->tgl_lahir?><br/>
															<?php endif; ?>
															<b>Angkatan: </b><?=$dataProfil->angkatan?><br/>
															<?php if(!empty($dataProfil->alamat)): ?>
															<b>Alamat: </b><?=$dataProfil->alamat?><br/>
															<?php endif; ?>
															<?php if(!empty($dataProfil->universitas)): ?>
															<b>Kuliah di: </b><?=$dataProfil->universitas?><br/>
															<?php endif; ?>
															<?php if(!empty($dataProfil->perusahaan)): ?>
															<b>Bekerja di: </b><?=$dataProfil->perusahaan?><br/>
															<?php endif; ?>
															<?php if(!empty($dataProfil->hp)): ?>
															<b>Nomor HP: </b><?=$dataProfil->hp?><br/>
															<?php endif; ?>
															<?php if(!empty($dataProfil->bbm)): ?>
															<b>PIN BBM: </b><?=$dataProfil->bbm?><br/>
															<?php endif; ?>
															<?php if(!empty($dataProfil->tw_username)): ?>
															<b>Twitter: </b><a href="http://twitter.com/<?=$dataProfil->tw_username?>" target="_blank">@<?=$dataProfil->tw_username?></a><br/>
															<?php endif; ?>
															<br/>
															<?php if(!empty($dataProfil->bio)): ?>
															<blockquote><?=$dataProfil->bio?></blockquote>
															<?php endif; ?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="qa">
											<?php if($dataProfil->iduser != $this->session->userdata('idUser')): ?>
												<form action="<?=base_url('post/question/'.$dataProfil->iduser.'/'.$dataProfil->username)?>" method="post" enctype="multipart/form-data" class='form-validate' id="post">
													<div class="controls">
														<input name="question" style="width: 45% !important;" type="text" data-rule-required="true" PlaceHolder="Buat pertanyaan untuk <?=$dataProfil->namalengkap?>" maxlength="65" autocomplete="off">
														<input class="btn btn-primary" value="Kirim!" type="submit">
													</div>
												</form>
											<?php endif; ?>
											<dl>
												<?php foreach($dataQuestion->result() as $r_q): ?>
													<dt style="padding-top: 10px;"><?=$r_q->question?> <span><a href="<?=base_url('profil/lihat/'.$r_q->username)?>">@<?=$r_q->username?></a></span></dt>
													<dd style="border-bottom: solid 1px #ebebeb; padding-bottom: 10px;"><?=$r_q->answer?></dd>
												<?php endforeach; ?>
											</dl>
										</div>
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
