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
	<div id="fb-root"></div>
	<script>
		window.fbAsyncInit = function() {
		  FB.init({
			appId      : '624926667628582',
			xfbml      : true,
			version    : 'v2.1'
		  });
		};
	  
		(function(d, s, id){
		   var js, fjs = d.getElementsByTagName(s)[0];
		   if (d.getElementById(id)) {return;}
		   js = d.createElement(s); js.id = id;
		   js.src = "//connect.facebook.net/en_US/sdk.js";
		   fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
        <?=$this->load->view('include/header')?>
			<div id="main">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">
                            <?php
                                foreach($dataPost->result() as $row):
                                $judul	= (empty($row->judul)) ? "Tidak Ada Judul" : $row->judul;
                            ?>
							<div class="box">
								<div class="box-title">
									<h3>
										<i class="icon-bullhorn"></i>
										<?=$judul?>
									</h3>
								</div>
								<div class="box-content noborder blog-list-post">
                                    <div class="post-content">
                                        <!-- S:POST META -->
                                        <div class="post-meta">
                                            <span class="date">
                                                <i class="icon-calendar"></i> <?=$this->rpl->tanggalLDMYHIS($row->date)?>
                                            </span>
                                            <span class="comments">
                                                <i class="icon-comments"></i> <a href="#komentar"><?=$dataComments->num_rows()?> Komentar</a>
                                            </span>
                                            <span class="author">
                                                <i class="icon-user"></i> <a href="<?=base_url('profil/lihat/'.$row->username)?>"><?=$row->namalengkap?></a>
                                            </span>
                                        </div>
                                        <!-- E:POST META -->
                                        <!-- S:POST TEXT -->
                                        <div class="post-text">
                                            <?=$row->isi?>
                                        </div>
                                        <!-- E:POST TEXT -->
                                    </div>
									<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-related="<?=base_url()?>"></a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script><br/><div class="fb-share-button" data-href="<?=base_url('post/detail/'.$this->uri->segment(3,0))?>" data-type="button_count"></div>
                                    <div class="post-comments" id="komentar">
										<h3>Komentar</h3>
                                        <?php foreach($dataComments->result() as $comm): ?>
										<div class="media">
											<a class="pull-left" href="<?=base_url('profil/lihat/'.$comm->username)?>">
												<img src="<?=base_url('statics/uploads').'/'.$comm->foto?>">
											</a>
											<div class="media-body">
												<h4 class="media-heading"><?=$comm->namalengkap?> <small><?=$this->rpl->tanggalLDMYHIS($comm->date)?></small></h4>
												<?=$comm->isi?>
                                                <?php if($this->session->userdata('level') > 1 || $this->session->userdata('idUser') == $comm->comment_from || $this->session->userdata('idUser') == $comm->comment_to_user ) : ?>
												<div class="media-actions">
													<a href="<?=base_url('post/delcomment/'.$comm->id.'/'.$this->uri->segment(3,0))?>" class="btn btn-small btn-danger" onclick="return confirm('Yakin akan dihapus?')"><i class="icon-trash"></i> Hapus</a>
												</div>
                                                <?php endif; ?>
                                            </div>
										</div>
                                        <?php endforeach; ?>
										<div class="new-comment">
											<h4>Tambah Komentar</h4>
											<form action="" method="POST" class="form-vertical">
												<div class="control-group">
													<div class="controls">
														<textarea name="isi" rows="4" id="PakeEditor"></textarea>
													</div>
												</div>
												<button type="submit" class="btn btn-primary pull-right">Kirim</button>
											</form>
										</div>
									</div>
								</div>
							</div>
                            <?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
<?=$this->load->view('include/foot')?>