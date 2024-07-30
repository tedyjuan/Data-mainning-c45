<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
	<title>ICT </title>
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

					<div class="d-flex flex-column flex-column-fluid">
						<div id="kt_app_toolbar" class="app-toolbar  pt-7 pt-lg-10 ">
							<div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex align-items-stretch ">
								<div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
									<div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
										<h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
											Dashboard : <?= $this->session->userdata('depoKode'); ?>
										</h1>
									</div>
								</div>
							</div>
						</div>
						<div id="kt_app_content" class="app-content  flex-column-fluid ">
							<div id="kt_app_content_container" class="app-container  container-fluid ">
								<span>halo</span>



							</div>
							<!--end::Content container-->
						</div>
						<!--end::Content-->
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
	<script src="<?= base_url(); ?>demo38/assets/js/widgets.bundle.js"></script>
	<script src="<?= base_url(); ?>demo38/assets/js/custom/widgets.js"></script>

	<script>
		// menu-link active
	</script>
</body>
<!--end::Body-->

</html>
