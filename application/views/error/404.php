<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>404 Halaman Nggak Ketemu</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap-responsive.min.css')?>">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/css/style.css')?>">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/css/themes.css')?>">


	<!-- jQuery -->
	<script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
	
	<!-- Nice Scroll -->
	<script src="<?=base_url('assets/js/plugins/nicescroll/jquery.nicescroll.min.js')?>"></script>
	<!-- Bootstrap -->
	<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>

	<!--[if lte IE 9]>
		<script src="<?=base_url('assets/js/plugins/placeholder/jquery.placeholder.min.js')?>"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->

</head>

<body class='error'>
	<div class="wrapper">
		<div class="code"><span>404</span><i class="icon-warning-sign"></i></div>
		<div class="desc">Ups.. Halaman yang kamu cari tidak ditemukan.</div>
		<form action="<?=base_url('profil/cari')?>" method="post" class='search-form'>
			<div class="input-append">
				<input type="text" name="q" placeholder="Cari teman kamu di sini...">
				<button type='submit' class='btn'><i class="icon-search"></i></button>
			</div>
		</form>
		<div class="buttons">
			<div class="pull-left"><a href="<?=base_url()?>" class="btn"><i class="glyphicon-home"></i> Ke Beranda</a></div>
		</div>
	</div>
</body>
</html>