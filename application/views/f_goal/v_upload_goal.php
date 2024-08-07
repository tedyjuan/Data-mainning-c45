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
				<div class="app-main flex-column flex-row-fluid " id="kt_app_main">
					<div id="kt_app_content_container" class="app-container  container-fluid ">
						<div class="card mt-3">
							<div class="card-header">
								<div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100 mt-3 mb-2">
									<div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
										<h1 class="page-heading d-flex flex-column justify-content-center fw-bold fs-3 m-0">
											Form Upload Goal
										</h1>
									</div>
									<div class="d-flex align-items-center gap-2 gap-lg-3">
										<div class="card-title fs-3 fw-bold">
											<a class="btn btn-secondary ml-2" href="<?= base_url('data-goal'); ?>"><b><i class="ki-outline ki-exit-left"></i></i> Kembali</b></a>
											<button hidden class="btn btn-primary ml-2" type="button" id="btn_upload" onclick="upload_excel()"><b><i><i class="ki-outline ki-send"></i></i> Upload </b></button>
											<button class="btn btn-info ml-2" type="button" id="btn_preview" onclick="preview_excel()"><b><i><i class="ki-outline ki-send"></i></i> Preview </b></button>

										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<form id="formData" name="form_update" enctype="multipart/form-data" method="post">
									<?php foreach ($detail as $row) : ?>
										<input type="hidden" id="id" name="id" value="<?= $row->id_goal; ?>">
										<input type="hidden" id="incr" name="incr" value="<?= $row->incr; ?>">
										<div class="row">
											<div class="col-6">
												<div class="form-group">
													<label for="nama">Nama Goal</label>
													<input type="text" value="<?= $row->nama_goal; ?>" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" disabled>
												</div>
												<div class="form-group">
													<label for="nama">Status Upload</label>
													<input type="text" value="<?= $row->file_name == null ? 'Belum Upload' : 'Sudah Upload'; ?>" class="form-control" id="status_file" name="status_file" readonly>
												</div>
											</div>
											<div class="col-6" id="file_upload">
												<div class="form-group">
													<label for="file">Upload File</label>
													<input type="file" class="form-control col-8" id="file" name="file" placeholder="Input File">
												</div>
											</div>
										</div>
									<?php endforeach; ?>
									<div id="penampung">
										<table class="table table-bordered" id="previewTable" border="1">
											<thead>

											</thead>
											<tbody></tbody>
										</table>
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
	<script src="<?= base_url(); ?>assets/Parsley.js-2.9.2/dist/parsley.min.js"></script>
	<script src="<?= base_url(); ?>assets/Parsley.js-2.9.2/dist/i18n/id.js"></script>
	<script>
		$("#data-goal").addClass("active");

		function preview_excel() {
			var formData = new FormData(document.getElementById('formData'));
			formData.append('file', $('#file')[0].files[0]);
			$.ajax({
				url: '<?= base_url("preview-atribute") ?>',
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				dataType: "JSON",
				success: function(data) {
					$('#preloading').delay(100).fadeOut();
					if (data.hasil == "true") {
						$("#btn_preview").hide();
						$("#file_upload").hide();
						$('#btn_upload').removeAttr('hidden');
						let tbody = $('#previewTable tbody');
						tbody.empty(); // Clear existing data
						$.each(data.postdata, function(index, value) {
							var i = index - 1;
							if (index == 1) {
								tbody.append(`<tr>
												<th>No</th>
												<th>${value.A}</th>
												<th>${value.B}</th>
												<th>${value.C}</th>
												<th>${value.D}</th>
												<th>${value.E}</th>
											</tr>`);
							} else {
								tbody.append(`<tr>
												<td>${i}</td>
												<td>${value.A}</td>
												<td>${value.B}</td>
												<td>${value.C}</td>
												<td>${value.D}</td>
												<td>${value.E}</td>
											</tr>`);
							}
						});
					} else {
						Swal.fire({
							icon: 'info',
							title: "Information",
							html: data.pesan,
						});
					}
				},
				error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		}

		function upload_excel() {
			var formData = new FormData(document.getElementById('formData'));
			formData.append('file', $('#file')[0].files[0]);
			$.ajax({
				url: '<?= base_url("C_goal/simpan_atribute") ?>',
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				dataType: "JSON",
				success: function(data) {
					$('#preloading').delay(100).fadeOut();
					if (data.hasil == "true") {
						Swal.fire({
							icon: 'info',
							title: "Information",
							html: data.pesan,
						});
						setInterval(function() {
							window.location.href = '<?= base_url('data-goal'); ?>';
						}, 2000);
					} else {
						Swal.fire({
							icon: 'info',
							title: "Information",
							html: data.pesan,
						});

					}
				},
				error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		}
	</script>

</body>
<!--end::Body-->

</html>
