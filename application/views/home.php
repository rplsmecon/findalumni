<?=$this->load->view('include/head')?>
<body data-mobile-sidebar="slide">
					<script>    
		$(document).ready(function(){
		
		function tampildata(){
		   $.ajax({
			type:"POST",
			url:"<?=base_url('chat/getchatangkatan');?>",    
			success: function(data){                 
					 $('#isi_chat').html(data);
			}  
		   });
        }
		
		$("#test").submit(function() {
		$.ajax({
			type: "POST",
			url: $(this).attr("action"),
			data: $(this).serialize(),
			success: function(data) {
				$(".hasil_polling").html(data);
				$("#pesan").val('');
			}
		})
		return false;
		});
		
		  setInterval(function(){
					 tampildata();},1000);
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
										<i class="icon-reorder"></i>
										Papan Informasi Untuk Angkatan <?=$this->session->userdata('angkatan')?> / Semua Angkatan
									</h3>
								</div>
								<div class="box-content nopadding">
									<ul class="timeline">
										<?php
											foreach($dataTimeline->result() as $row):
											$judul	= (empty($row->judul)) ? "Tidak Ada Judul" : $row->judul;	
										?>
										<li>
											<div class="timeline-content">
												<div class="left">
													<div class="icon orange">
														<i class="icon-bullhorn"></i>
													</div>
													<?php if($row->iduser==$this->session->userdata('idUser') || $this->session->userdata('level') > 1): ?>
													<div class="date"><a href="<?=base_url('post/hapus/'.md5($row->id))?>" onclick="return confirm('Yakin akan dihapus?')">Hapus</a></div>
													<?php endif; ?>
												</div>
												<div class="activity">
													<div class="user"><a href="<?=base_url('profil/lihat/'.$row->username)?>"><?=$row->namalengkap?></a> <span><?=$this->rpl->tanggalLDMYHIS($row->date)?></span></div>
													<a href="<?=base_url('post/detail/'.md5($row->id))?>"><?=strip_tags($judul)?></a>
												</div>
											</div>
											<div class="line"></div>
										</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
						<!--
						<div class="span4">
							<div class="box">
								<div class="box-title">
									<h3><i class="icon-comment"></i>Chat Angkatan <?=$this->session->userdata('angkatan')?></h3>
								</div>
								<ul class="messages">
										<li class="insert">
												<form id="test" method="post" action="<?=base_url('chat/getchatangkatan');?>">
												<div class="text">
													<input id="pesan" type="text" name="pesan" placeholder="Tulis di sini..." class="input-block-level" autocomplete="off">
												</div>
												<div class="submit">
													<button type="submit" id="kirim"><i class="icon-share-alt"></i></button>
												</div>
												</form>
										</li>
									</ul>
								<div class="box-content nopadding scrollable" data-height="350" data-visible="true" data-start="bottom">
									<ul class="messages" id="isi_chat">
									</ul>
								</div>
							</div>
						</div>
						-->
					</div>
				</div>
			</div>
		</div>
	</body>
<?=$this->load->view('include/foot')?>