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
                echo $page[0]->$content ?>
    </section>
    <section id="primary" class="content-full-width">
        <div class="container"> 
            <div class="contact_form_outer">
                <!--container starts-->
                <div  class="contact-form">
                    <h2>We'd Like to Hear From You!</h2>
                    <div class="dt-sc-one-third column first">
                        <input id="txtName" type="text" placeholder="Name">
                    </div>
                    <div class="dt-sc-one-third column">
                        <input id="txtPhone" type="text" placeholder="Phone">
                    </div>
                    <div class="dt-sc-one-third column">
                        <input id="txtMail" type="text" placeholder="Mail">
                    </div>
                    <div class="dt-sc-one-column mt-2">
                        <textarea id="txtDescription" placeholder="Message"></textarea>
                    </div>
                    <div id="ajax_admission_msg"> </div>
                    <p class="aligncenter pt-3">
                        <input class="px-5" type="submit" onclick="send()" value="<?= lang('btn_contact'); ?>">
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- PAGE BANNER SECTION -->
<script type="text/javascript">
function send(){
    var name            = $('#txtName').val();
    var phone           = $('#txtPhone').val();
    var description             = $('#txtDescription').val();
    var mail           = $('#txtMail').val();
    if(name === '' ){
        notify('Vui lòng nhập họ tên.', 'danger');
        return false;
    }
    if(phone === ''){
        notify('Vui lòng nhập số điện thoại.', 'danger');
        return false;
    }
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if( !emailReg.test(mail)) {
        notify('Địa chỉ email không hợp lệ', 'danger');
        return false;
    }else if(mail === ''){
        notify('Vui lòng nhập địa chỉ email.', 'danger');
        return false;
    }

    if(description === ''){
        notify('Vui lòng nhập thông tin cần hỗ trợ.', 'danger');
        return false;
    }
    $('#send').hide();
    $.post('<?= PATH_URL ?><?=$this->lang->lang();?>/saveInfoContact',{
        name        : name,
        phone       : phone,
        description         : description,
        mail        : mail,
        isType      : false,
        csrf_token: $('#csrf_token').val()
    },function(data){
        var req = JSON.parse(data);     
        if(req.status === true){
            notify('Gửi yêu cầu tư vấn thành công.', 'success');
        } else {
            notify('Gửi yêu cầu tư vấn không thành công.', 'danger');
        }
    }); 
}
</script>
