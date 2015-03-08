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
										<i class="icon-group"></i>
										Teman Seangkatan Kamu
									</h3>
								</div>
								<div class="box-content nopadding">
									<ul class="gallery">
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
                                        <li>
											<a href="#">
												<img src="<?=base_url('statics/uploads').'/'.$row->foto?>" alt="">
											</a>
											<div class="extras">
												<div class="extras-inner">
													<a href="<?=base_url('statics/uploads').'/'.$row->foto?>" class='colorbox-image' rel="group-1"><i class="icon-search"></i></a>
                                                    <a href="<?=base_url('profil/lihat/'.$row->username)?>"><?=$row->namalengkap.' '.$namapanggilan?></a>
                                                    <a href="#" class='del-gallery-pic'><i class="icon-trash"></i></a>
												</div>
											</div>
										</li>
                                        <?php endforeach; ?>
                                    </ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
<?=$this->load->view('include/foot')?>