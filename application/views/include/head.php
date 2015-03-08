<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="description" content="Informasi Data Siswa & Alumni Jurusan Rekayasa Perangkat Lunak SMK Negeri 1 Purwokerto" />
	
	<title><?=$title?></title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap-responsive.min.css')?>">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/jquery-ui/smoothness/jquery-ui.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/jquery-ui/smoothness/jquery.ui.theme.css')?>">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/css/style.css')?>">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?=base_url('assets/css/themes.css')?>">
	<!-- Tagsinput -->
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/tagsinput/jquery.tagsinput.css')?>">
	<!-- chosen -->
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/chosen/chosen.css')?>">
	<!-- multi select -->
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/multiselect/multi-select.css')?>">
	<!-- timepicker -->
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/timepicker/bootstrap-timepicker.min.css')?>">
	<!-- colorpicker -->
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/colorpicker/colorpicker.css')?>">
	<!-- Datepicker -->
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/datepicker/datepicker.css')?>">
	<!-- Daterangepicker -->
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/daterangepicker/daterangepicker.css')?>">
	<!-- Plupload -->
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/plupload/jquery.plupload.queue.css')?>">
	<!-- select2 -->
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/select2/select2.css')?>">
	<!-- icheck -->
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/icheck/all.css')?>">
    <!-- dataTables -->
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/icheck/TableTools.css')?>">
    <!-- colorbox -->
	<link rel="stylesheet" href="<?=base_url('assets/css/plugins/colorbox/colorbox.css')?>">


	<!-- jQuery -->
	<script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
	
	<script src="<?=base_url('assets/js/plugins/tiny_mce/tinymce.min.js')?>"></script>
	
	<!-- Nice Scroll -->
	<script src="<?=base_url('assets/js/plugins/nicescroll/jquery.nicescroll.min.js')?>"></script>
	<!-- Mobile nav swipe -->
	<script src="<?=base_url('assets/js/plugins/touchwipe/touchwipe.min.js')?>"></script>
	<!-- imagesLoaded -->
	<script src="<?=base_url('assets/js/plugins/imagesLoaded/jquery.imagesloaded.min.js')?>"></script>
	<!-- jQuery UI -->
	<script src="<?=base_url('assets/js/plugins/jquery-ui/jquery.ui.core.min.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/jquery-ui/jquery.ui.widget.min.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/jquery-ui/jquery.ui.mouse.min.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/jquery-ui/jquery.ui.resizable.min.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/jquery-ui/jquery.ui.sortable.min.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/jquery-ui/jquery.ui.draggable.min.js')?>"></script>
	<!-- slimScroll -->
	<script src="<?=base_url('assets/js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
	<!-- Bootstrap -->
	<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
	<!-- Bootbox -->
	<script src="<?=base_url('assets/js/plugins/bootbox/jquery.bootbox.js')?>"></script>
	<!-- Bootbox -->
	<script src="<?=base_url('assets/js/plugins/form/jquery.form.min.js')?>"></script>
	<!-- Validation -->
	<script src="<?=base_url('assets/js/plugins/validation/jquery.validate.min.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/validation/additional-methods.min.js')?>"></script>

	<!-- Theme framework -->
	<script src="<?=base_url('assets/js/eakroko.min.js')?>"></script>
	<!-- Theme scripts -->
	<script src="<?=base_url('assets/js/application.min.js')?>"></script>
	<!-- Just for demonstration -->
	<script src="<?=base_url('assets/js/demonstration.min.js')?>"></script>
	<!-- TagsInput -->
	<script src="<?=base_url('assets/js/plugins/tagsinput/jquery.tagsinput.min.js')?>"></script>
	<!-- Masked inputs -->
	<script src="<?=base_url('assets/js/plugins/maskedinput/jquery.maskedinput.min.js')?>"></script>
	<!-- TagsInput -->
	<script src="<?=base_url('assets/js/plugins/tagsinput/jquery.tagsinput.min.js')?>"></script>
	<!-- Datepicker -->
	<script src="<?=base_url('assets/js/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
	<!-- Daterangepicker -->
	<script src="<?=base_url('assets/js/plugins/daterangepicker/daterangepicker.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/daterangepicker/moment.min.js')?>"></script>
	<!-- Timepicker -->
	<script src="<?=base_url('assets/js/plugins/timepicker/bootstrap-timepicker.min.js')?>"></script>
	<!-- Colorpicker -->
	<script src="<?=base_url('assets/js/plugins/colorpicker/bootstrap-colorpicker.js')?>"></script>
	<!-- Chosen -->
	<script src="<?=base_url('assets/js/plugins/chosen/chosen.jquery.min.js')?>"></script>
	<!-- MultiSelect -->
	<script src="<?=base_url('assets/js/plugins/multiselect/jquery.multi-select.js')?>"></script>
	<!-- CKEditor -->
	<script src="<?=base_url('assets/js/plugins/ckeditor/ckeditor.js')?>"></script>
	<!-- PLUpload -->
	<script src="<?=base_url('assets/js/plugins/plupload/plupload.full.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/plupload/jquery.plupload.queue.js')?>"></script>
	<!-- Custom file upload -->
	<script src="<?=base_url('assets/js/plugins/fileupload/bootstrap-fileupload.min.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/mockjax/jquery.mockjax.js')?>"></script>
	<!-- select2 -->
	<script src="<?=base_url('assets/js/plugins/select2/select2.min.js')?>"></script>
	<!-- icheck -->
	<script src="<?=base_url('assets/js/plugins/icheck/jquery.icheck.min.js')?>"></script>
	<!-- complexify -->
	<script src="<?=base_url('assets/js/plugins/complexify/jquery.complexify-banlist.min.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/complexify/jquery.complexify.min.js')?>"></script>
	<!-- Mockjax -->
	<script src="<?=base_url('assets/js/plugins/mockjax/jquery.mockjax.js')?>"></script>
    <!-- dataTables -->
	<script src="<?=base_url('assets/js/plugins/datatable/jquery.dataTables.min.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/datatable/TableTools.min.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/datatable/ColReorderWithResize.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/datatable/ColVis.min.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/datatable/jquery.dataTables.columnFilter.js')?>"></script>
	<script src="<?=base_url('assets/js/plugins/datatable/jquery.dataTables.grouping.js')?>"></script>
	<!-- colorbox -->
	<script src="<?=base_url('assets/js/plugins/colorbox/jquery.colorbox-min.js')?>"></script>
	<!-- masonry -->
	<script src="<?=base_url('assets/js/plugins/masonry/jquery.masonry.min.js')?>"></script>

	<!--[if lte IE 9]>
		<script src="<?=base_url('assets/js/plugins/placeholder/jquery.placeholder.min.js')?>"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
		<![endif]-->

		<!-- Apple devices Homescreen icon -->
		<link rel="apple-touch-icon-precomposed" href="<?=base_url('assets/img/apple-touch-icon-precomposed.png')?>" />
        <!-- Google recaptcha -->
        <script src='https://www.google.com/recaptcha/api.js'></script>
	</head>