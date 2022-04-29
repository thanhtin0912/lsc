

$(document).ready(function() {

});
function contact(){
    var name            = $('#txtName').val();
    var phone           = $('#txtPhone').val();
    var old             = $('#txtOld').val();
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

    if(old === ''){
        notify('Vui lòng nhập tuổi học viên.', 'danger');
        return false;
    }
    $('#send').hide();
    $.post(root + 'vn/saveInfoContact',{
        name        : name,
        phone       : phone,
        old         : old,
        mail        : mail,
        isType      : true,
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
