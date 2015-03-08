<div id="navigation">
			<div class="container-fluid">
				<a href="<?=base_url()?>" id="brand">RPL Find Alumni</a>
				<!--<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>-->
				<ul class='main-nav'>
					<li <?php if($menu=="home"): echo 'class="active"'; endif;?>>
						<a href="<?=base_url()?>">
							<span>Beranda</span>
						</a>
					</li>
					<li <?php if($menu=="seangkatan"): echo 'class="active"'; endif;?>>
						<a href="<?=base_url('profil/seangkatan')?>">
							<span>Temen Seangkatan</span>
						</a>
					</li>
					<?php if($this->session->userdata('level')>0): ?>
					<li <?php if($menu=="post"): echo 'class="active"'; endif;?>>
						<a href="<?=base_url('post/addnew')?>">
							<span>Kirim Pengumuman</span>
						</a>
					</li>
					<li <?php if($menu=="user"): echo 'class="active"'; endif; $total_user = $this->m_user->getUserAngkatanUnactive();?>>
						<a href="<?=base_url('user/data/angkatan')?>">
							User <?php if ($total_user->num_rows() > 0): ?><span class="label label-lightred"><?=$total_user->num_rows()?></span><?php endif ?>
						</a>
					</li>
					<?php endif; ?>
				</ul>
				<div class="user">
					
					<ul class="icon-nav">
						<?php if($this->session->userdata('level')>0): ?>
						<li class='dropdown'>
							<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-comment"></i><span class="label label-lightred"><?php $myUnreadComments = $this->m_post->getMyUnreadComments(); echo $myUnreadComments->num_rows(); ?></span></a>
							<ul class="dropdown-menu pull-right message-ul">
								<?php foreach($myUnreadComments->result() as $unread): ?>
								<li>
									<a href="<?=base_url('post/detail/'.$unread->comment_to)?>">
										<img src="img/demo/user-1.jpg" alt="">
										<div class="details">
											<div class="name">@<?=$unread->username?></div>
											<div class="message">
												<?=strip_tags(substr($unread->isi,0,20))?>...
											</div>
										</div>
									</a>
								</li>
								<?php endforeach; ?>
							</ul>
						</li>
						<?php endif; ?>
						
						<li class='dropdown'>
							<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-question-sign"></i><span class="label label-lightred"><?php $myUnreadQuestions = $this->m_post->getUnreadQuestions($this->session->userdata('idUser')); echo $myUnreadQuestions->num_rows(); ?></span></a>
							<ul class="dropdown-menu pull-right message-ul">
								<?php foreach($myUnreadQuestions->result() as $r_question): ?>
								<li>
									<a href="<?=base_url('post/detailquestion/'.$r_question->to_username.'/'.$r_question->q_id)?>">
										<img src="img/demo/user-1.jpg" alt="">
										<div class="details">
											<div class="name">@<?=$r_question->username?></div>
											<div class="message">
												<?=strip_tags(substr($r_question->question,0,20))?>...
											</div>
										</div>
									</a>
								</li>
								<?php endforeach; ?>
							</ul>
						</li>

					</ul>
					
					<div class="dropdown">
						<a href="#" class='dropdown-toggle' data-toggle="dropdown">@<?=$this->session->userdata('username')?><img src="<?=base_url('statics/uploads').'/'.$this->session->userdata('fotoUser')?>" width="27" height="27"></a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="<?=base_url('profil/edit')?>">Edit Profil</a>
							</li>
							<li>
								<a href="<?=base_url('auth/logout')?>">Keluar</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid" id="content">
			<div id="left">
				<form action="<?=base_url('profil/cari')?>" method="post" class='search-form'>
					<div class="search-pane">
						<input type="text" name="q" placeholder="Cari teman kamu di sini...">
						<button type="submit"><i class="icon-search"></i></button>
					</div>
				</form>
				<div class="subnav">
					<div class="subnav-title">
						<span>Profil Saya</span>
					</div>
					<div class="subnav-content">
						
						<?php
							$namapanggilan = (!empty($dataUser->namapanggilan))? '('.$dataUser->namapanggilan.')' : '';
						?>
						<div class="row-fluid">
							<div class="span6"><img src="<?=base_url('statics/uploads/'.$dataUser->foto)?>" width="60">
</div>
							<div class="span6">
								<?=$dataUser->namalengkap?><br/>
								<?=$namapanggilan?>
							</div>
						</div>
						<div class="row-fluid">
						<div class="span12">
							<div class="box">
								<div class="box-title">
									<h3>Biodata</h3>
									<div class="actions">
										<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
									</div>
								</div>
								<div class="box-content nopadding">
									<b>Angkatan: </b><?=$dataUser->angkatan?><br/>
									<?php if(!empty($dataUser->alamat)): ?>
									<b>Alamat: </b><?=$dataUser->alamat?><br/>
									<?php endif; ?>
									<?php if(!empty($dataUser->universitas)): ?>
									<b>Kuliah di: </b><?=$dataUser->universitas?><br/>
									<?php endif; ?>
									<?php if(!empty($dataUser->perusahaan)): ?>
									<b>Bekerja di: </b><?=$dataUser->perusahaan?><br/>
									<?php endif; ?>
									<?php if(!empty($dataUser->hp)): ?>
									<b>Nomor HP: </b><?=$dataUser->hp?><br/>
									<?php endif; ?>
									<?php if(!empty($dataUser->bbm)): ?>
									<b>PIN BBM: </b><?=$dataUser->bbm?><br/>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>