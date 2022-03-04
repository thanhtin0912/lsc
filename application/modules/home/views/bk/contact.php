<style type="text/css">
    .main-menu .navigation > li:hover > a, .main-menu .navigation > li.contact > a {
      color: #006699;
      opacity: 1;
    }
</style>
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(<?= PATH_URL ?>assets/images/breadcrumb/breadcrumb-bg.jpg);">
	<div class="container-fluid text-center">
		<h1><?=lang('menu_contact')?></h1>
		<div class="breadcrumb-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left pull-left">
                            <ul>
                                <li><a href="<?=$this->lang->lang();?>/"><?=lang('menu_home')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><?=lang('menu_contact')?></li>
                            </ul>    
                        </div>   
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>
<!--End breadcrumb area-->

<!--Start contact v1 area-->
<section class="contact-v2-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="contact-info">
                    <div class="title">
                        <h3>Corporate Office</h3>
                    </div>
                    <ul class="contact-address">
                        <li>
                            <div class="icon-holder">
                                <span class="flaticon-building"></span>
                            </div>
                            <div class="text-holder">
                                <p><?php $lang = $this->lang->lang(); $address = "address_".$lang; echo $info[0]->$address ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <span class="flaticon-technology"></span>
                            </div>
                            <div class="text-holder">
                                <p>+ (<?=$info[0]->phone?>)</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <span class="flaticon-new-email-outline"></span>
                            </div>
                            <div class="text-holder">
                                <p><?=$info[0]->mail?></p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-holder">
                                <span class="flaticon-clock"></span>
                            </div>
                            <div class="text-holder">
                                <p>Thứ 2 - thứ 7 từ 08.00 đến 17.00<br> chủ nhật nghỉ</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="google-map-area">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3898.256680925624!2d109.20890175601981!3d12.29849340213121!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317069165874d169%3A0xb2e3246af01fa005!2zQ8O0bmcgdHkgVE5ISCBL4bu5IHRodeG6rXQgSOG6o2kgRMawxqFuZw!5e0!3m2!1svi!2s!4v1568348794815!5m2!1svi!2s" width=100% height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
            </div> 
        </div>
    </div>
</section>                                                                     
<!--End contact v1 area-->
<!-- PAGE BANNER SECTION -->
<script type="text/javascript">
    function message(){
        $('#form-messege').show();
        var name =        $('#name').val();
        var mail =       $('#mail').val();
        var phone =       $('#phone').val();
        var message =     $('#message').val();

        if(name == '' ){
            $('#form-messege').html('Please enter your name.');
            setTimeout(function(){ $('#form-messege').fadeOut(500) }, 2300);
            return false;
        }
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if( !emailReg.test(mail)) {
            $('#form-messege').html('Email address is not valid');
            setTimeout(function(){ $('#form-messege').fadeOut(500) }, 2300);
            return false;
        }else if(mail == ''){
            $('#form-messege').html('Please enter mail address.');
            setTimeout(function(){ $('#form-messege').fadeOut(500) }, 2300);
            return false;
        }

        if(message == ''){
            $('#form-messege').html('Please enter company name.');
            setTimeout(function(){ $('#form-messege').fadeOut(500) }, 2300);
            return false;
        }
           
        $.post('<?= PATH_URL ?><?=$this->lang->lang();?>/home/InfoContact',{
            name    : name,
            mail   :      mail,
            phone : phone,
            message :       message,
            csrf_token:     $('#csrf_token').val()
        },function(data){
            $('#form-messege').hide();
            responseText = data.split(".");          
            token_value  = responseText[1];
            $('#csrf_token').val(token_value);
            if(responseText[0]=='success'){
                $('#form-messege').html('Thank you. We will respond to your information as soon as possible');
                setTimeout(function(){ $('#form-messege').fadeOut(500) }, 2300);
                return false;
            }
        }); 
    }
</script>
 
<!--Start contact v2 form area-->
<section class="contact-v2-form-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="contact-v2-form">
                    <div class="sec-title text-center">
                        <h2><?=lang('send_message')?></h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="name" placeholder="Name*">
                            <input type="text" id="mail" placeholder="Email*">
                            <input type="text" id="phone" placeholder="Phone">
                        </div>
                        <div class="col-md-6">
                            <textarea id="message"  placeholder="Your Messge..."></textarea>
                            <button class="thm-btn bg-cl-1" onclick="message()">Send Message</button>
                            <p id="form-messege" style="color: red; display: none;"> Vui lòng chờ hệ thống xử lý</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>                                                                                           
<!--End contact v2 form area--> 
