<link href="<?= base_url(); ?>demo38/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>demo38/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?= base_url(); ?>demo38/assets/media/logos/favicon.ico" />
<link href="<?= base_url(); ?>demo38/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>demo38/DataTables/datatables.css" rel="stylesheet">
<link href="<?= base_url(); ?>demo38/select2/css/select2.min.css" rel="stylesheet" />
<link href="<?= base_url(); ?>assets/flatpiker/flatpickr.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/flatpiker/themes_material_green.css" rel="stylesheet">
<link href="<?= base_url(); ?>demo38/custom/css/modalfull.css" rel="stylesheet" />
<style>
	.select2-container .select2-selection--single {
		height: 2.5em !important;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
		line-height: 2.5em !important;
	}

	.parsley-required {
		color: red;
		margin-bottom: -15px;
	}

	.overlay {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100vh;
		background: rgba(0, 0, 0, .8);
		z-index: 999;
		opacity: 0.4;
		transition: all 0.5s;
		text-align: center;
	}

	.img-spinner {
		width: 105px;
		height: 105px;
		margin-top: 10%;
	}
</style>
<div id="preloading" class="spinner overlay" style="display: none;">
	<img class="img-spinner" src="<?= base_url() ?>assets/logo/loading.gif">
</div>