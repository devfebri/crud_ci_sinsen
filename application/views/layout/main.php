<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<title>SINSEN</title>
	<meta content="Admin Dashboard" name="description" />
	<meta content="Mannatthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="shortcut icon" href="<?= base_url(); ?>/layout/template/assets/images/favicon.ico">

	<link href="<?= base_url(); ?>/layout/template/assets/plugins/morris/morris.css" rel="stylesheet">

	<!-- DataTables -->
	<link href="<?= base_url(); ?>/layout/template/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>/layout/template/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<!-- Responsive datatable examples -->
	<link href="<?= base_url(); ?>/layout/template/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />


	<link href="<?= base_url(); ?>/layout/template/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>/layout/template/assets/css/icons.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>/layout/template/assets/css/style.css" rel="stylesheet" type="text/css">

</head>


<body class="fixed-left">

	<!-- Loader -->
	<div id="preloader">
		<div id="status">
			<div class="spinner"></div>
		</div>
	</div>

	<!-- Begin page -->
	<div id="wrapper">

		<!-- ========== Left Sidebar Start ========== -->
		<div class="left side-menu">
			<button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
				<i class="ion-close"></i>
			</button>
			<div class="topbar-left">
				<div class="text-center">
					<a href="index.html" class="logo"><i class="mdi mdi-assistant"></i> SINSEN</a>
				</div>
			</div>

			<div class="sidebar-inner slimscrollleft">

				<div id="sidebar-menu">
					<ul>
						<li class="menu-title">Main</li>

						<li>
							<a href="<?php echo base_url('Produk/index') ?>" class="waves-effect">
								<i class="mdi mdi-airplay"></i>
								<span> Produk</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('Home/kontak') ?>" class="waves-effect">
								<i class="mdi mdi-airplay"></i>
								<span> Kontak</span>
							</a>
						</li>

					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- Left Sidebar End -->

		<!-- Start right Content here -->

		<div class="content-page">


			<!-- Start content -->
			<div class="content">

				<!-- Top Bar Start -->
				<div class="topbar">

					<nav class="navbar-custom">

						<ul class="list-inline float-right mb-0">
							<!-- language-->



							<li class="list-inline-item dropdown notification-list">
								<a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
									<img src="<?= base_url(); ?>layout/template/assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
								</a>
								<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
									<!-- item-->
									<div class="dropdown-item noti-title">
										<h5>Welcome</h5>
									</div>
									<a class="dropdown-item" href="#"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
								</div>
							</li>

						</ul>

						<ul class="list-inline menu-left mb-0">

						</ul>

						<div class="clearfix"></div>

					</nav>

				</div>
				<div class="page-content-wrapper ">
					<?php
					if (isset($_view) && $_view)
						$this->load->view($_view);
					?>
				</div>
			</div> <!-- content -->

			<footer class="footer">
				© 2018 Annex by Mannatthemes.
			</footer>

		</div>
		<!-- End Right content here -->

	</div>
	<!-- END wrapper -->


	<!-- jQuery  -->
	<script src="<?= base_url(); ?>/layout/template/assets/js/jquery.min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/js/popper.min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/js/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/js/modernizr.min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/js/detect.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/js/fastclick.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/js/jquery.slimscroll.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/js/jquery.blockUI.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/js/waves.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/js/jquery.nicescroll.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/js/jquery.scrollTo.min.js"></script>

	<script src="<?= base_url(); ?>/layout/template/assets/plugins/skycons/skycons.min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/raphael/raphael-min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/morris/morris.min.js"></script>


	<!-- Required datatable js -->
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
	<!-- Buttons examples -->
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/datatables/dataTables.buttons.min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/datatables/jszip.min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/datatables/pdfmake.min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/datatables/vfs_fonts.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/datatables/buttons.html5.min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/datatables/buttons.print.min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/datatables/buttons.colVis.min.js"></script>
	<!-- Responsive examples -->
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/datatables/dataTables.responsive.min.js"></script>
	<script src="<?= base_url(); ?>/layout/template/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
	<!-- Datatable init js -->
	<script src="<?= base_url(); ?>/layout/template/assets/pages/datatables.init.js"></script>

	<!-- App js -->
	<script src="<?= base_url(); ?>/layout/template/assets/js/app.js"></script>
	<?php
	if (isset($_js) && $_js)
		$this->load->view($_js);
	?>

</body>

</html>
