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
										<i class="icon-search"></i>
										Hasil pencarian dengan kata kunci "<?=$this->input->post('q')?>"
									</h3>
								</div>
								<div class="box-content">
									<table class="table table-bordered table-hover table-nomargin table-striped dataTable">
										<thead>
											<tr>
												<td>
													Result
												</td>
											</tr>
										</thead>
										<tbody>
											<?php
												foreach($dataProfil->result() as $row):
												$namapanggilan = (!empty($row->namapanggilan))? '('.$row->namapanggilan.')' : '';
												$level = $row->level;
												if($level=='0'):
													$admin = '';
												elseif($level=='1'):
													$admin	= '<span class="badge badge-success"><i class="icon-ok-sign"></i> Admin Angkatan '.$row->angkatan.'</span>';
												elseif($level=='2'):
													$admin	= '<span class="badge badge-success"><i class="icon-ok-sign"></i> Admin Banget</span>';
												endif;
											?>
									<tr><td>
									<div class="row-fluid">
										<div class="preview-img span2">
											<a href="<?=base_url('profil/lihat/'.$row->username)?>"><img src="<?=base_url('statics/uploads').'/'.$row->foto?>" alt="" width="80"></a>
										</div>
										<div class="post-content span10">
											<h4 class="post-title">
												<a href="<?=base_url('profil/lihat/'.$row->username)?>"><?=$row->namalengkap.' '.$namapanggilan?></a> <?=$admin?>
											</h4>
											<div class="post-meta">
												<span class="date">
													Angkatan <?=$row->angkatan?>
												</span>
											</div>
											<div class="post-text">
												<blockquote>
													<?=$row->bio?>
												</blockquote>
												<?php if($row->tw_username != ""): ?>
													<br>
													<b>Twitter: </b><a href="http://twitter.com/<?=$row->tw_username?>" target="_blank">@<?=$row->tw_username?></a>
												<?php endif; ?>
											</div>
										</div>
                                    </div>
									</td></tr>
                                    <?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
<?=$this->load->view('include/foot')?>