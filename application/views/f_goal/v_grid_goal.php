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
											List Data Goal
										</h1>
									</div>
									<div class="d-flex align-items-center gap-2 gap-lg-3">
										<div class="card-title fs-3 fw-bold">
											<a class="btn btn-primary" href="<?= base_url('tambah-goal'); ?>"><b>+ Tambah Goal</b></a>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table border table-bordered text-upercase table-striped gy-5 " id="mydata">
										<thead class="text-gray-600 fw-semibold">
											<tr>
												<th style="width: 7%;">No</th>
												<th style="width: 35%;">Nama Goal</th>
												<th>Keterangan</th>
												<th style="width: 10%;" class="text-center">Aksi</th>
											</tr>
										</thead>
										<tbody class="text-gray-600 fw-semibold">
											<?php $no = 1;
											foreach ($list as $row) : ?>
												<tr>
													<td><?= $no; ?></td>
													<td><?= $row->nama_goal; ?></td>
													<td><?= $row->keterangan; ?></td>
													<td class="text-center">

														<!--begin::Menu wrapper-->
														<div>
															<!--begin::Toggle-->
															<button type="button" class="btn btn-icon rotate " data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="-100%, 10%">
																<i class="ki-outline ki-element-plus  fs-2 me-2 text-success"></i>
															</button>
															<!--end::Toggle-->
															<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-auto min-w-200 mw-300px" data-kt-menu="true">
																<div class="menu-item px-3 bg-light-primary">
																	<div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-3 ">Row Ke : <?= $no++; ?></div>
																</div>
																<div class="menu-item px-3 mt-2">
																	<a href="<?= base_url('edit-goal/') . base64_encode($this->encryption->encrypt($row->id_goal));  ?>" class="menu-link px-3"><i class="ki-outline ki-pencil fs-4 text-success"></i>&nbsp;Edit</a>
																</div>
																<div class="menu-item px-3 mt-2">
																	<a href="#" class="menu-link px-3" onclick="hapus('<?= $row->id_goal; ?>', '<?= $row->incr; ?>')"><i class="ki-outline ki-trash fs-4 text-danger"></i>&nbsp;Delete</a>
																</div>
																<div class="separator mt-3 opacity-75"></div>
																<!-- <div class="menu-item px-3">
																	<div class="menu-content px-3 py-3">
																		<a class="btn btn-light-primary btn-sm px-3" href="<?= base_url('upload-goal/') . base64_encode($this->encryption->encrypt($row->id_goal)); ?>">
																			<b>Upload Files Atribute</b>
																		</a>
																	</div>
																</div> -->
																<!--end::Menu item-->
															</div>
															<!--end::Menu-->
														</div>
														<!--end::Dropdown wrapper-->

													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
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
	<?php if ($this->session->flashdata('faileddata')) { ?>
		<script>
			Swal.fire({
				icon: 'info',
				title: 'Information',
				html: '<?= $this->session->flashdata('faileddata'); ?>',
			})
		</script>
	<?php } ?>
	<script>
		$(document).ready(function() {
			$("#mydata").DataTable();
		});
		$("#data-goal").addClass("active");

		function hapus(id, incr) {
			Swal.fire({
				title: 'Apakah Anda Yakin!',
				text: "Akan Menghapus Data Ini?",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Batal',
				confirmButtonText: 'Ya !',
				reverseButtons: true
			}).then((result) => {
				if (result.value) {
					// $('#preloading').show();
					$.ajax({
						type: 'POST',
						url: "<?= base_url('hapus-goal') ?>",
						method: 'POST',
						dataType: 'JSON',
						data: {
							id: id,
							incr: incr,
						},
						success: function(data) {
							$('#preloading').delay(100).fadeOut();
							if (data.hasil == 'true') {
								Swal.fire({
									icon: 'success',
									title: "Success",
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
						}
					});
				} else if (result.dismiss === 'cancel') {
					Swal.fire({
						icon: 'error',
						title: "Information",
						html: "Data Batal Di hapus",
					});
				}
			});
		}
	</script>
</body>
<!--end::Body-->

</html>
