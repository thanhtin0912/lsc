<style type="text/css">
    .contact-info {
        clear: both;
        float: left;
        width: 100%;
        margin: 0px 0px 10px;
        padding: 0px;
        border: 0px;
        padding: 5px 0;
    }
    .contact-info .fa{
        color: #008c99;
        padding-right: 10px;
        font-size: 18px;
    }
    h3.widgettitle {
        padding-bottom: 25px;
    }
    .class_hours {
        background: none !important;
    }
</style>

<!--End breadcrumb area-->
<div id="main">
    <!--breadcrumb-section starts-->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?= PATH_URL . $this->lang->lang(); ?>/"><?= lang('menu_home') ?></a>
                <span class="fa fa-angle-double-right"></span>
                <span class="current"><?= lang('menu_contact') ?></span>
            </div>
        </div>
    </div>
    <section id="primary" class="content-full-width">
    <?php $lang = $this->lang->lang();
                $content = "content_" . $lang;
                echo $about[0]->$content ?>
    </section>
    <section id="primary" class="content-full-width">
        <div class="container"> 
            <div class="contact_form_outer">
                <form name="frcontact" class="contact-form" method="post" action="php/contactmail.php">
                    <h2>We'd Like to Hear From You!</h2>
                    <p class="column dt-sc-one-third first">
                        <input id="name" name="txtname" type="text" placeholder="Name" required="">
                    </p>
                    <p class="column dt-sc-one-third">
                        <input id="email" name="txtemail" type="email" placeholder="Email ID" required="">
                    </p>
                    <p class="column dt-sc-one-third">
                        <input id="subject" name="txtsubject" type="text" placeholder="Subject" required="">
                    </p>
                    <p>
                        <textarea id="comment" name="txtmessage" placeholder="Message"></textarea>
                    </p>
                    <div id="ajax_contact_msg"> </div>
                    <p>
                        <input name="submit" type="submit" id="submit" class="dt-sc-button medium" value="Send Email">
                    </p>
                </form>
            </div>
        </div>
    </section>
</div>
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
