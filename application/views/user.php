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
										Data User
									</h3>
								</div>
								<div class="box-content nopadding">
									<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th>Nama Lengkap</th>
											<th>Email</th>
											<th>Username</th>
											<th>Angkatan</th>
											<th>Transfer Angkatan</th>
                                            <th>Status</th>
											<?php if($this->session->userdata('level')>1): ?>
                                            <th>Opsi</th>
											<?php endif; ?>
										</tr>
									</thead>
									<tbody>
                                        <?php foreach($dataUserAll->result() as $row): ?>
										<tr>
											<td><?=$row->namalengkap?></td>
											<td><?=$row->email?></td>
											<td><?=$row->username?></td>
											<td><?=$row->angkatan?></td>
											<td>
												<form method="post" action="<?=base_url('user/transferangkatan/'.$row->iduser)?>">
														<select name="angkatan" id="select" class="input-large">
															<?php
																$tahun_ini = date('Y');
																for ($i=2009; $i<=$tahun_ini; $i++):
																$selected	= ($i==$row->angkatan)? 'selected' : '';
															?>
															<option value="<?=$i?>" <?=$selected?>><?=$i?></option>
															<?php endfor; ?>
														</select>
														<input type="submit" value="Transfer" class="btn btn-success">
												</form>
											</td>
                                            <td><?php if($row->aktif==1): echo '<a href="'.base_url('user/aktivasi/'.$row->iduser.'/0').'" class="btn btn-success btn-circle">Aktif</a>'; else: echo '<a href="'.base_url('user/aktivasi/'.$row->iduser.'/1').'" class="btn btn-danger btn-circle">Nonaktif</a>'; endif; ?></td>
                                            <?php if($this->session->userdata('level')>1): ?>
											<td><?php if($row->level==1): echo '<a href="'.base_url('user/setadmin/'.$row->iduser.'/0').'" class="btn btn-danger btn-circle">Jadikan User Biasa</a>'; else: echo '<a href="'.base_url('user/setadmin/'.$row->iduser.'/1').'" class="btn btn-success btn-circle">Jadikan Admin</a>'; endif; ?></td>
											<?php endif; ?>
										</tr>
                                        <?php endforeach; ?>
									</tbody>
								</table>
								<div class="table-pagination">
									<?=$this->pagination->create_links()?>
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