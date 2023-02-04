<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<title>Đăng nhập- Kho Leotea.vn</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/logo.jpg">

	<!-- Web Fonts -->
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

	<!-- CSS Global Compulsory -->
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/bootstrap.min.css">
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/style.css">

	<!-- CSS Page Style -->
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/page_log_reg_v2.css">
	<!-- CSS Implementing Plugins -->
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/animate.css">
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/line-icons.css">
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/font-awesome.min.css">

	<!-- CSS Theme -->
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/default.css" id="style_color">
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/dark.css">

	<!-- CSS Customization -->
	<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/custom.css">
</head>

<body>
	<!--=== Content Part ===-->
	<div class="container">
		<!--Reg Block-->
		<div class="reg-block">
			<img class="center-block img-responsive" src="assets/images/logo.jpg" alt="" width="50%">
			<div class="reg-block-header">
			</div>

			<div class="input-group margin-bottom-20">
				<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				<input type="text" class="form-control" id="loginUser" placeholder="Tài khoản">
			</div>
			<div class="input-group margin-bottom-20">
				<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				<input  class="form-control" type="password" id="loginPass" placeholder="Mật khẩu">
			</div>
			<div class="alert alert-warning fade in" id="alertWarning" style="display:none;">
				<div id="divError"></div>
			</div>
			
			<hr>
			
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<button type="submit" class="btn-u btn-block" onclick="login();">Đăng nhập</button>
				</div>
			</div>
		</div>
		<!--End Reg Block-->
	</div><!--/container-->
	<!--=== End Content Part ===-->
	<script>
		function GetUserIP(){
			var ret_ip;
			$.ajaxSetup({async: false});
			$.get('http://jsonip.com/', function(r){ 
				ret_ip = r.ip; 
			});
			return ret_ip;
		}
		function login(){
		$('#alertWarning').hide();
		name = $('#loginUser').val();
		pass = $('#loginPass').val();
		ip = GetUserIP();
		if(name=="" && pass==''){
			$('#alertWarning').show();
			$('#divError').html("Vui lòng nhập thông tin.");
			$('#loginUser').focus();
			return false;
		}else if(pass=="" && name!=""){
			$('#alertWarning').show();
			$('#divError').html("Vui lòng nhập mật khẩu.");
			$('#loginPass').focus();
			return false;
		}else if(pass!="" && name==""){
			$('#alertWarning').show();
			$('#divError').html("Vui lòng nhập tài khoản.");
			$('#loginUser').focus();
			return false;
		}else if(name!='' && pass!='' && ip!=''){
			var url = root+'dang-nhap';
			$.post(url,{
					user: name,
					pass: pass,
					ip: ip,
					csrf_token: token_value
				},function(data){
					console.log(data);
					if(data==1){
						$('#divError').html('');
						location.href = root+'home';
					}else if (data==2) {
						token_value = data;
						$('#alertWarning').show();
						$('#divError').html("Kết nối của bạn không thể đăng nhập.");
						setTimeout("$('#divError').toggleClass('shake')",1000);
					}else{
						token_value = data;
						console.log(token_value);
						$('#alertWarning').show();
						$('#divError').html("Thông tin tài khoản không chính xác.");
						setTimeout("$('#divError').toggleClass('shake')",1000);
					}
				}
			);
		}
	}
	</script>

	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.min.js"></script>	
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery-migrate.js"></script>
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/bootstrap.min.js"></script>
	<!-- JS Implementing Plugins -->
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/back-to-top.js"></script>
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.backstretch.min.js"></script>
	<!-- JS Customization -->
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/custom.js"></script>
	<!-- JS Page Level -->
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/app.js"></script>

	<script type="text/javascript">
		jQuery(document).ready(function() {
			App.init();
		});
	</script>
        <script type="text/javascript">
        var root = '<?= PATH_URL ?>';
		var token_value = '<?=$this->security->get_csrf_hash()?>';
    </script>
	<script type="text/javascript">
		$.backstretch([
			"assets/images/19.jpg",
			"assets/images/11.jpg",
			], {
				fade: 1000,
				duration: 7000
			});
	</script>



</body>
</html>
