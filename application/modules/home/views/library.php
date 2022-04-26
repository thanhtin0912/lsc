
<script type="text/javascript">
    $(document).ready(function() {
        showAllLibraries(0);
    });
    function showAllLibraries(start){
        var module_url = '<?= PATH_URL ?><?=$this->lang->lang();?>/';
        var per_page        = 12;
        $.post(module_url+'showAllLibraries',{
            start            : start,
            per_page         : per_page,
            csrf_token: $('#csrf_token').val()
        },function(data){
            $('#wrap-post-library').html(data);
            
        });
    }
    function close_popup() {
        var popup = document.getElementById("popup_advisory");
        popup.parentNode.classList.remove("active");
        $('#appendYoutube').children().remove();
    }

    function show_popup(id) {
        var module_url = '<?= PATH_URL ?><?=$this->lang->lang();?>/';
        $.post(module_url+'getDetailProject',{
            id            : id,
            csrf_token: $('#csrf_token').val()
        },function(data){
            let req = JSON.parse(data)
            if (req.data) {
                let tr = '';
                tr += "<iframe width='500' height='360' src='" + req.data[0].urlVideo + "' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                $('#appendYoutube').children().remove();
                $('#appendYoutube').append(tr);
                var popup = document.getElementById("popup_advisory");
                popup.parentNode.className += " active";
                return
            }
        });
    }
</script>
<style>
    .blog-entry {
        color: #5c5c5c ! important;
        margin-bottom: 10px !important;
    }
</style>
<!--main starts-->
<div id="main">
    <!--breadcrumb-section starts-->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?=PATH_URL.$this->lang->lang();?>/"><?=lang('menu_home')?></a>
                <span class="fa fa-angle-double-right"></span>
                <span class="current"><?=lang('menu_document')?></span>
            </div>
        </div>
    </div>
    <!--breadcrumb-section ends-->
    <!--container starts-->
    <div class="container" id="wrap-post-library">

    </div>
    <!--container ends-->
</div>
<!--main ends-->


<div class="car_popup">
    <div id="popup_advisory">
        <button class="close-icon" onclick="close_popup()" title="Close">×</button>
        <div class="d-md-flex">
            <div class="banner" id="appendYoutube">
            </div>
        </div>
    </div>
</div>

<style>
    .car_popup.active {
        visibility: visible;
        opacity: 1;
        pointer-events: auto;
    }

    .car_popup {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 99999999999;
        background-color: rgba(0, 0, 0, 0.6);
        overflow: auto;
        visibility: hidden;
        pointer-events: none;
        display: -webkit-flex;
        display: -ms-flex;
        display: flex;
        align-items: center;
        justify-content: center;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -ms-transition: all 0.5s;
        transition: all 0.5s;
        opacity: 0;
    }

    #popup_advisory .dropdown-list:after {
        content: '';
        display: block;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 8px 6px 0;
        border-color: #fff transparent transparent;
        pointer-events: none;
        position: absolute;
        right: 12px;
        top: 50%;
        margin-top: -4px;
    }

    @media (min-width: 768px) {
        #popup_advisory {
            max-width: 900px;
            overflow: hidden;
        }
    }

    #popup_advisory {
        /* width: 100%; */
        margin: auto;
        padding: 0;
        position: relative;
    }

    #popup_advisory * {
        box-sizing: border-box;
    }

    [type='button']:not(:disabled),
    [type='reset']:not(:disabled),
    [type='submit']:not(:disabled),
    button:not(:disabled) {
        cursor: pointer;
    }

    .close-icon {
        position: absolute;
        top: 0;
        right: 0;
        width: 40px;
        height: 40px;
        z-index: 2;
        border: none;
        background-color: #fff;
        cursor: pointer;
        font-size: 24px;
    }


    .car_popup.active {
        visibility: visible;
        opacity: 1;
        pointer-events: auto;
    }

    #popup_advisory .img {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        width: 100%;
        height: 100%;
    }

    .showErr {
        margin: 0;
        padding-left: 6px;
        color: red;
        display: none;
        margin-top: 4px;
        font-size: 12px;
    }

    .loader {
        border: 4px solid #f3f3f3;
        border-radius: 50%;
        border-top: 4px solid rgba(0, 0, 0, 1);
        width: 40px;
        height: 40px;
        -webkit-animation: spin 2s linear infinite;
        /* Safari */
        animation: spin 2s linear infinite;
        padding: 0;
        background-color: transparent;
        display: none;
        margin: 0 auto;
    }

    .link_popup {
        display: block;
        cursor: pointer;
        position: fixed;
        right: 10px;
        bottom: 150px;
        width: 70px;
        height: 70px;
        background: url(/camry/pintop.png) center center/contain no-repeat;
        z-index: 999;
    }
</style>