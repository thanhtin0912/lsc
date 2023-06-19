<!DOCTYPE html>
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<title>Quản lý kho LeoTea</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Web Fonts -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">

	<!-- CSS Global Compulsory -->
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/bootstrap.css">
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/bootstrap.min.css">

	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/style.css">
	<!-- <link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/profile.css"> -->
	<!-- CSS Header and Footer -->
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/header-default.css">
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/footer-v1.css">

	<!-- CSS Implementing Plugins -->
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/animate.css">
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/line-icons.css">
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?= PATH_URL;?>assets/css/admin/datepicker3.css"/>
	<link rel="stylesheet" type="text/css" href="<?= PATH_URL;?>assets/css/admin/bootstrap-timepicker.min.css"/>
	<!-- CSS Theme -->
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/default.css" id="style_color">
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/dark.css">
	<!-- CSS Customization -->
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/custom.css">
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/profile.css">
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/shortcode_timeline2.css">

	<script type="text/javascript" src="<?= PATH_URL . 'assets/js/' ?>jquery-1.11.2.min.js"></script>
	
</head>
<input type="hidden" value="<?=$this->security->get_csrf_hash()?>" id="csrf_token" name="csrf_token" />
<body>
	<div class="wrapper">
		<div class="header">
			<div class="container pb-2">
				<!-- Logo -->
				<a class="logo">
					<img src="assets/images/logo.jpg" alt="Logo">
				</a>
				<!-- End Logo -->
				<!-- Topbar -->

				<div class="topbar">
					<ul class="loginbar pull-right">
						<li><a href="page_faq.html"><?= $this->session->userdata('userStaff')[0]->name;?></a></li>
					</ul>
				</div>
				<!-- End Topbar -->

				<!-- Toggle get grouped for better mobile display -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="fa fa-bars"></span>
				</button>
				<!-- End Toggle -->
			</div><!--/end container-->

			<?php if($this->session->userdata('userStaff')[0]->isMain) {?>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
				<div class="container">
					<ul class="nav navbar-nav">
						<!-- Tables -->
						<li class="home-page"><a href="<?= PATH_URL ?>home">Thông tin</a></li>
						<!-- End Tables -->
						<!-- Tables -->
						<li class="main-page"><a href="<?= PATH_URL ?>hang-can">Cần Hàng</a></li>
						<!-- End Tables -->
						<!-- Tables -->
						<li class="import-page"><a href="<?= PATH_URL ?>nhap-kho-chinh">Nhập kho</a></li>
						<!-- End Tables -->

						<!-- Tables -->
						<li class="export-page"><a href="<?= PATH_URL ?>xuat-kho-chinh">Xuất kho</a></li>
						<li class="export2-page"><a href="<?= PATH_URL ?>xuat-kho-chinh-2">Xuất kho lần 2</a></li>
						<!-- End Tables -->
						<li class="kt-xuat-page"><a href="<?= PATH_URL ?>kiem-tra-xuat-cua-hang">KT xuất CH</a></li>
						<!-- Tables -->
						 <li class="history-page"><a href="<?= PATH_URL ?>lich-su">Lịch sử</a></li> 
						<!-- End Tables -->
					</ul>
				</div><!--/end container-->
			</div><!--/navbar-collapse-->
			<?php } else { ?>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
				<div class="container">
					<ul class="nav navbar-nav">
						<!-- Tables -->
						<li class="home-page"><a href="<?= PATH_URL ?>home">Thông tin</a></li>
						<!-- End Tables -->

						<!-- Tables -->
						<li class="import-page"><a href="<?= PATH_URL ?>nhap-kho">Nhập kho</a></li>
						<!-- End Tables -->

						<!-- Tables -->
						<li class="export-page"><a href="<?= PATH_URL ?>xuat-kho">Xuất kho</a></li>
						<!-- End Tables -->
						<!-- Tables -->
						<li class="remove-page"><a href="<?= PATH_URL ?>hang-huy">Hàng hủy</a></li>
						<!-- End Tables -->
						
						<!-- Tables -->
						 <li class="history-page"><a href="<?= PATH_URL ?>lich-su">Lịch sử</a></li> 
						<!-- End Tables -->
						<!-- Tables -->
						<!--<li class="inventory-page"><a href="<?= PATH_URL ?>tim-kiem-lich-su">Nhập/xuất Ngày</a></li>-->
						<!-- End Tables -->
					</ul>
				</div><!--/end container-->
			</div><!--/navbar-collapse-->
			<?php }?>
		</div>
		<!--=== End Header ===-->
		
		<!--=== Content Part ===-->
		<div class="container content profile p-0 p-md-4 py-4">
			<div class="row">

                <?= $content; ?>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="modalNote" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-bold">Ghi chú <span id="txtProductName"></span> <input id="txtProductID" type="hidden"></input></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
						<div class="form-group">
						<label for="message-text" class="col-form-label">Ghi chú:</label>
						<textarea class="form-control" id="txtNote" rows="5"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn-u rounded-4x btn-u-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn-u rounded-4x btn-u-green" id="btn-save-note" onclick="saveNote()">Save</button>
				</div>
				</div>
			</div>
		</div>
		<!--=== Footer Version 1 ===-->
<!-- 		<div class="footer-v1" style="display: block;">

			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<p>
								2021 &copy; All Rights Reserved.
								<a href="#">Design by</a> | <a href="#">thanhtin0912@gmail.com</a>
							</p>
						</div>

					</div>
				</div>
			</div>
		</div> -->
		<!--=== End Footer Version 1 ===-->
	</div><!--/End Wrapepr-->

	<!-- JS Global Compulsory -->
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery-3.1.1.min.js"></script>

	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.min.js"></script>
	<script type="text/javascript" src="<?= PATH_URL;?>assets/js/admin/jquery.form.js"></script>
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery-migrate.js"></script>
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/bootstrap.min.js"></script>
	<!-- JS Implementing Plugins -->
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/back-to-top.js"></script>
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery-ui.min.js"></script>
	<!-- JS Customization -->
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/custom.js"></script>
	<!-- JS Page Level -->
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/app.js"></script>
	<script src="<?= PATH_URL;?>assets/js/admin/metronic.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/style-switcher.js"></script>
	<script src="<?= PATH_URL . 'assets/js/admin/' ?>components-pickers.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/bootstrap-notify.min.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<script src="<?= PATH_URL; ?>assets/js/frontend/jquery-confirm.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			App.init();
			StyleSwitcher.initStyleSwitcher();
			ComponentsPickers.init();
		});
        var root = '<?= PATH_URL ?>';
        var csrf_token;

		function notify(ms,type){
			$.notify({
				message: ms 
			},{
				type: type
			});
		}
    </script>
</body>
</html>
