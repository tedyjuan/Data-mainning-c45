<div id="kt_app_header" class="app-header ">
	<!--begin::Header container-->
	<div class="app-container  container-fluid d-flex align-items-stretch flex-stack " id="kt_app_header_container">
		<!--begin::Sidebar toggle-->
		<div class="d-flex align-items-center d-block d-lg-none ms-n3" title="Show sidebar menu">
			<div class="btn btn-icon btn-active-color-primary w-35px h-35px me-2" id="kt_app_sidebar_mobile_toggle">
				<i class="ki-outline ki-abstract-14 fs-2"></i>
			</div>
			<!--begin::Logo image-->
			<a href="<?= base_url('SplitScreen'); ?>">
				<!-- <img style="height: 100px!important;" alt="Logo" src="<?= base_url(); ?>demo38/svg/TBK-MRT_new.svg" /> -->
			</a>
			<!--end::Logo image-->
		</div>
		<div class="app-navbar flex-lg-grow-1" id="kt_app_header_navbar">
			<div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1">
				<!-- menu pencarian disini -->
			</div>
			<div class="app-navbar-item ms-1 ms-md-3">
				<!--begin::Menu wrapper-->
				<div class="date-time  mr-3" id="kt_drawer_chat_toggle">
					<span id="time"></span>
				</div>
				<script>
					var span = document.getElementById('time');

					function time() {
						var weekdays = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
						var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
							"September", "Oktober", "November", "Desember"
						];
						var d = new Date();
						var s = d.getSeconds();
						var m = d.getMinutes();
						var h = d.getHours();
						var dat = d.getDate();
						var mon = d.getMonth();
						var yea = d.getFullYear();
						var days = d.getDay();
						span.textContent =
							(weekdays[days]) + ", " + ("0" + dat).substr(-2) + " " + (months[mon]) + " " + (yea) + "  " + (
								"0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
					}

					setInterval(time, 1000);
				</script>
				<!--end::Menu wrapper-->
			</div>
			<div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
				<!--begin::Menu wrapper-->
				<div class="cursor-pointer symbol symbol-circle symbol-35px symbol-md-45px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
					<img src="<?= base_url(); ?>assets/img/Aqualogo.png" alt="user" />
				</div>
				<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">

					<div class="menu-item px-3">
						<div class="menu-content d-flex align-items-center px-3">

							<div class="symbol symbol-50px me-5">
								<img alt="Logo" src="<?= base_url(); ?>assets/img/Aqualogo.png" />
							</div>
							<div class="d-flex flex-column">
								<div class="fw-bold d-flex align-items-center fs-5">
									<?= $this->session->userdata('nama') ?>
								</div>
								<a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
									<?= $this->session->userdata('depoKode'); ?>
								</a>
							</div>
						</div>
					</div>
					<div class="separator my-2"></div>
					<div class="menu-item px-5">
						<a href="<?= base_url('Login_co/logout'); ?>" class="menu-link px-5">
							Sign Out
						</a>


					</div>
				</div>
			</div>
		</div>
		<div class="app-navbar-separator separator d-none d-lg-flex"></div>
	</div>
</div>
