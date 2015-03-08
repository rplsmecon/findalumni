<p>
	Hai <?=$namalengkap?>,
</p>
<p>
	Akun kamu dinonaktifkan sementara. Ada beberapa sebab akun kamu dinonaktifkan, di antaranya:
</p>
<p>
	1. Foto kamu bukan foto asli<br/>
    2. Data diri kamu asal-asalan<br/>
</p>
<p>
	Untuk mengaktifkan akun kamu lagi, hubungin  aku lewat email ya di <?=$this->session->userdata('email')?>.
</p>
<p>
	Terima Kasih.
</p>
<p>
	Salam,<br/><?=$this->session->userdata('namalengkap')?><br/>Admin angkatan <?=$this->session->userdata('angkatan')?>
</p>