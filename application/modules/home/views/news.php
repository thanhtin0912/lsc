
<script type="text/javascript">
    $(document).ready(function() {
        showAllNews(0);
    });
    function showAllNews(start){
        var module_url = '<?= PATH_URL ?><?=$this->lang->lang();?>/';
        var per_page        = 8;
        $.post(module_url+'showAllNews',{
            start            : start,
            per_page         : per_page,
            csrf_token: $('#csrf_token').val()
        },function(data){
            $('#wrap-post-news').html(data);
            
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
                <span class="current"><?=lang('menu_news')?></span>
            </div>
        </div>
    </div>
    <!--breadcrumb-section ends-->
    <!--container starts-->
    <div class="container" id="wrap-post-news">
        
    </div>
    <!--container ends-->
</div>
<!--main ends-->
