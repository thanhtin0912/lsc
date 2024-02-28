<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

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
    <link rel='stylesheet' type='text/css'
        href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

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
    <link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/antd.css">
    <!--<script type="text/javascript" src="<?= PATH_URL . 'assets/js/' ?>jquery-1.11.2.min.js"></script>-->
     <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.min.js"></script> 
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
                <input type="text" class="form-control"  onkeypress="return EnterLogin(event)"  id="loginUser" placeholder="Tài khoản">
            </div>
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input class="form-control" onkeypress="return EnterLogin(event)"  type="password" id="loginPass" placeholder="Mật khẩu">
            </div>
            <div class="alert alert-warning fade in" id="alertWarning" style="display:none;">
                <div id="divError"></div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <button type="submit" class="btn-u btn-block" id="loginAndVerify" onclick="login(false)">Đăng nhập</button>
                </div>
            </div>
        </div>
        <!--End Reg Block-->
    </div>
    <!--/container-->
    <!--=== End Content Part ===-->
    <div class="ant-modal-root" id="confirm" style="display:none;">
        <div style="z-index: 1001;" class="ant-modal-mask"></div>
        <div class="ant-modal-wrap ant-modal-centered" role="dialog" style="z-index: 1001;">
            <div class="ant-modal">
                <div tabindex="0" style="width: 0px; height: 0px; overflow: hidden; outline: none;" aria-hidden="true">
                </div>
                <div class="ant-modal-content">
                    <div class="ant-modal-header">
                        <div class="ant-modal-title" id="rcDialogTitle1">Xác Thực Mã Đăng Nhập</div>
                    </div>
                    <div class="ant-modal-body">
                        <div class="wallet-form verify-form">
                            <div class="phone-input-row jbo-custom-ant">
                                <h4 style="text-align: center ! important">Thời gian xác nhận chỉ còn <span
                                        class="text-center redText" id="countdowntimer"></span></h4>
                                <input type="text" class="ant-input py-2" id="inputCode" style="margin: 20px 0">
                                <button type="button" class="ant-btn jbo-primary-btn"
                                    onclick="login(true)"><span>Xác thực</span></button>
                            </div>
                            <div class="alert alert-warning fade in" id="alertVerify" style="display:none;">
                                <div id="divErrorVerify"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    jQuery(document).ready(function() {
        App.init();
    });
    var root = '<?= PATH_URL ?>';
    var token_value = '<?=$this->security->get_csrf_hash()?>';

    function GetUserIP() {

        var ret_ip;
        $.ajaxSetup({
            async: false
        });
        $.get('https://jsonip.com/', function(r) {
            ret_ip = r.ip;
        });
        return ret_ip;
    }
    
	function EnterLogin(e){
		if(e.keyCode == 13){ 
			login();
		}
	}
	
    function login(eventClick) {
        $('#alertWarning').hide();
        $('#loginAndVerify').attr('disabled', true);	
        name = $('#loginUser').val();
        pass = $('#loginPass').val();
        verify = $('#inputCode').val();
        ip = GetUserIP();
        if (name == "" && pass == '') {
            $('#alertWarning').show();
            $('#divError').html("Vui lòng nhập thông tin.");
            $('#loginUser').focus();
            return false;
        } else if (pass == "" && name != "") {
            $('#alertWarning').show();
            $('#divError').html("Vui lòng nhập mật khẩu.");
            $('#loginPass').focus();
            return false;
        } else if (pass != "" && name == "") {
            $('#alertWarning').show();
            $('#divError').html("Vui lòng nhập tài khoản.");
            $('#loginUser').focus();
            return false;
        } else if (name != '' && pass != '') {
            if (verify == "" && eventClick == true) {
                notify('Vui lòng nhập mã xác nhận', 'danger');
                return false;
            }
            var url = root + 'dang-nhap';
            $.post(url, {
                user: name,
                pass: pass,
                verify: verify,
                ip: ip,
                csrf_token: token_value
            }, function(data) {
                var data = JSON.parse(data)
                if (data.status == true) {
                    if(verify) {
                        location.href = root + 'home';
                    } else {
                        $('#divError').html('');
                        countDown();
                        $('#confirm').show();
                        token_value = data.csrf_hash;                        
                    }

                } else {
                    token_value = data.csrf_hash;
                    notify(data.mes, 'danger');
                    $('#loginAndVerify').attr('disabled', false);	
                }
            });
        }
    }

    function countDown() {
        var timeleft = 180;
        var downloadTimer = setInterval(function() {
            timeleft--;
            document.getElementById("countdowntimer").textContent = timeleft;
            if (timeleft <= 0) {
                location.href = root + 'dang-xuat';
            }
        }, 1000);
    }
    </script>


    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery-migrate.js"></script>
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/bootstrap.min.js"></script>
    <!-- JS Implementing Plugins -->
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/back-to-top.js"></script>
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.backstretch.min.js"></script>
    <!-- JS Customization -->
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/custom.js"></script>
    <!-- JS Page Level -->
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/app.js"></script>
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/bootstrap-notify.min.js"></script>
    <script type="text/javascript">
    $.backstretch([
        "assets/images/19.jpg",
        "assets/images/11.jpg",
    ], {
        fade: 1000,
        duration: 7000
    });
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