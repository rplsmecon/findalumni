<?=$this->load->view('include/head')?>
<body data-mobile-sidebar="slide">
		<?=$this->load->view('include/header')?>
			<div id="main">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
							<div class="box">
								<div class="box-title">
									<h3>
										<?=$dataQuestion->question?>
									</h3>
									<div class="actions">
										Yang nanya: <a href="<?=base_url('profil/lihat/'.$dataQuestion->username)?>">@<?=$dataQuestion->username?></a>
									</div>
								</div>
								<div class="box-content">
									<?php if($dataQuestion->answered = 1): ?>
										<?=$dataQuestion->answer?> — <a href="<?=base_url('profil/lihat/'.$dataQuestion->to_username)?>">@<?=$dataQuestion->to_username?></a>
									<?php endif; ?>
									<?php if(empty($dataQuestion->answer)): ?>
										<?php if($this->session->userdata('idUser') == $dataQuestion->to_iduser): ?>
											<form action="<?=base_url('post/answer/'.$this->session->userdata('username').'/'.$dataQuestion->q_id)?>" method="post" enctype="multipart/form-data" class='form-validate' id="post">
												<div class="controls">
													<input name="answer" style="width: 45% !important;" type="text" data-rule-required="true" PlaceHolder="Jawab" maxlength="50" autocomplete="off"><br/>
													<?php if(!empty($dataUser->oauth_token)): ?>
														<input type="checkbox" name="tweet" value="1" checked> Kirim ke twitter<br/><br/>
													<?php endif; ?>
													<input class="btn btn-primary" value="Kirim!" type="submit">
												</div>
											</form>
										<?php else: ?>
											Belum dijawab.
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
<?=$this->load->view('include/foot')?>