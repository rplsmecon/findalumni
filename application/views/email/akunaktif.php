<p>
	Hai <?=$namalengkap?>,
</p>
<p>
	Akun kamu sudah diaktifkan. Sekarang, kamu bisa dapetin informasi dari RPL SMKN 1 Purwokerto atau cari data temen-temen angkatan kamu. Silakan login ke <a href="<?=base_url('auth/login')?>" target="_blank">RPL SMKN 1 Purwokerto</a> dan isi data kamu di <a href="<?=base_url('profil/edit')?>" target="_blank">sini</a> agar temen-temen kamu bisa dapetin informasi kamu.
</p>
<p>
	Terima Kasih.
</p>
<p>
	Salam,<br/><?=$this->session->userdata('namalengkap')?><br/>Admin angkatan <?=$this->session->userdata('angkatan')?>
</p>