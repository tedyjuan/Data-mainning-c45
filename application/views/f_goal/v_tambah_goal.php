<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<title>Data Goal </title>
	<meta charset="utf-8" />
	<?php $this->load->view('template/css'); ?>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'UA-37564768-1');
	</script>
	<!--end::Google tag-->
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
		<!--begin::Page-->
		<div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
			<!--begin::Header-->
			<?php $this->load->view('template/sidebar'); ?>

			<div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
				<!--begin::Sidebar-->
				<div id="kt_app_sidebar" class="app-sidebar  flex-column " data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
					<!-- icon  -->
					<?php $this->load->view('template/iconbrand'); ?>
					<div class="app-sidebar-navs flex-column-fluid py-6" id="kt_app_sidebar_navs">
						<div id="kt_app_sidebar_navs_wrappers" class="app-sidebar-wrapper hover-scroll-y my-2" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_header" data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">
							<div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary">
								<!-- sidebar custom  -->
								<?php $this->load->view('navigasi/nav_menu_utama'); ?>

							</div>
						</div>
					</div>
				</div>
				<!--begin::FOOTER-->

				<div class="app-main flex-column flex-row-fluid " id="kt_app_main">
					<!--begin::INI Content teddy-->

					<div id="kt_app_content_container" class="app-container  container-fluid ">
						<div class="card mt-3">
							<div class="card-header">
								<div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100 mt-3 mb-2">
									<div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
										<h1 class="page-heading d-flex flex-column justify-content-center fw-bold fs-3 m-0">
											Form Tambah Goal
										</h1>
									</div>
									<div class="d-flex align-items-center gap-2 gap-lg-3">
										<div class="card-title fs-3 fw-bold">
											<a class="btn btn-secondary ml-2" href="<?= base_url('data-goal'); ?>"><b><i class="ki-outline ki-exit-left"></i></i> Kembali</b></a>
											<button class="btn btn-primary ml-2" type="button" id="btn_simpan" onclick="simpan_data()"><b><i><i class="ki-outline ki-send"></i></i> Simpan</b></button>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<form id="formData" name="form_insert">
									<div class="form-group">
										<label for="nama">Nama Goal</label>
										<input type="text" data-parsley-errors-container=".err_nama" data-parsley-required="true" required="" class="form-control col-8" id="nama" name="nama" placeholder="Masukkan Nama">
										<span class="text-danger err_nama"></span>
									</div>
									<div class="form-group">
										<label for="ket">Keterangan</label>
										<textarea data-parsley-errors-container=".err_ket" data-parsley-required="true" required="" class="form-control col-8" id="ket" name="ket" rows="3" placeholder="Masukkan Keterangan"></textarea>
										<span class="text-danger err_ket"></span>

									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<i class="ki-outline ki-arrow-up"></i>
	</div>
	<!--end::Scrolltop-->
	<script>
		var hostUrl = "<?= base_url(); ?>";
	</script>
	<script src="<?= base_url(); ?>demo38/assets/plugins/global/plugins.bundle.js"></script>
	<script src="<?= base_url(); ?>demo38/assets/js/scripts.bundle.js"></script>
	<script src="<?= base_url(); ?>demo38/assets/plugins/custom/datatables/datatables.bundle.js"></script>
	<script src="<?= base_url(); ?>demo38/DataTables/datatables.js"></script>
	<script src="<?= base_url(); ?>assets/Parsley.js-2.9.2/dist/parsley.min.js"></script>
	<script src="<?= base_url(); ?>assets/Parsley.js-2.9.2/dist/i18n/id.js"></script>
	<script>
		$("#data-goal").addClass("active");

		function simpan_data() {
			$("#formData").parsley().validate();
			// Check if the form is valid
			if ($("#formData").parsley().isValid()) {
				$('#preloading').show();
				var form = $("form[name=form_insert]");
				$.ajax({
					type: 'POST',
					url: "<?= base_url('insert-goal') ?>",
					method: 'POST',
					dataType: 'JSON',
					data: form.serialize(),
					success: function(data) {
						if (data.hasil == 'true') {
							$("#btnsimpan").hide();
							Swal.fire({
								icon: 'success',
								title: "Success",
								html: data.pesan,
							});
							setInterval(function() {
								window.location.href = '<?= base_url('data-goal'); ?>';
							}, 2000);
						} else {
							$('#preloading').delay(100).fadeOut();
							Swal.fire({
								icon: 'info',
								title: "Information",
								html: data.pesan,
							});
						}
					}
				});
			} else {
				console.log('Form is not valid!');
			}
		}
	</script>

</body>
<!--end::Body-->

</html>
