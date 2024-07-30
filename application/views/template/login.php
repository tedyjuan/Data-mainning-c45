<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<title>Login </title>
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="<?= base_url(); ?>demo38/assets/media/logos/favicon.ico" />

	<!--begin::Fonts(mandatory for all pages)-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> <!--end::Fonts-->

	<link href="<?= base_url(); ?>demo38/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>demo38/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat" style="background-image : url('<?= base_url('demo38/assets/media/auth/bg4.jpg'); ?>')">
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root" id="kt_app_root">
		<!--begin::Page bg image-->

		<!--end::Page bg image-->

		<!--begin::Authentication - Sign-in -->
		<div class="d-flex flex-column flex-column-fluid flex-lg-row">
			<!--begin::Aside-->
			<div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
				<div class="d-flex flex-center flex-lg-start flex-column">
					<!-- buat brand  -->
				</div>
			</div>
			<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
				<!--begin::Card-->
				<div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
					<!--begin::Wrapper-->
					<div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">

						<!--begin::Form-->
						<form class="form w-100" action="<?= base_url('Login_co/doLogin') ?>" method="post">
							<div class="text-center mb-11">
								<h1 class="text-dark fw-bolder mb-3">
									Sign In
								</h1>
								<div class="text-gray-500 fw-semibold fs-6">
									Your Acount in Company
								</div>
							</div>
							<div class="fv-row mb-8">
								<input type="text" id="nikLogin" name="NIK" placeholder="Input your NIK" autocomplete="off" tabindex="1" class="form-control bg-transparent" />
							</div>
							<div class="fv-row mb-5">
								<div class="position-relative ">
									<input type="password" id="mypassword" name="Password" class="form-control" tabindex="2" placeholder="password">
									<button type="button" class="btn position-absolute end-0 top-0 " id="btn_show">
										<i class="fa-regular fa-eye-slash" onclick="showbtn(this)" data-status='off' id="icon-eye"></i>
									</button>
								</div>
							</div>
							<div class="d-grid mb-10 mt-10">
								<button type="submit" class="btn btn-warning">
									<span class="indicator-label">Sign In</span>
								</button>
							</div>

						</form>
						<div class="text-gray-500 text-center fw-semibold fs-6">
							Power By ICT MDBA © <?= date("Y") ?> MRT | TBK
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= base_url(); ?>demo38/assets/plugins/global/plugins.bundle.js"></script>
	<script src="<?= base_url(); ?>demo38/assets/js/scripts.bundle.js"></script>
	<?php if ($this->session->flashdata('failed')) { ?>
		<script>
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				html: '<h4>NIK Dan Password Tidak terdaftar</h4> ',
			})
		</script>
	<?php  } ?>

	<script>
		function showbtn(e) {
			var id = e.id;
			if ($('#' + id).hasClass('fa-eye-slash')) {
				$('#' + id).removeClass('fa-eye-slash').addClass('fa-eye');
				$('#mypassword').attr('type', 'text');
			} else {
				$('#' + id).removeClass('fa-eye').addClass('fa-eye-slash');
				$('#mypassword').attr('type', 'password');

			}
		}
	</script>
</body>

</html>
