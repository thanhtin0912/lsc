<style type="text/css">
    .main-menu .navigation > li:hover > a, .main-menu .navigation > li.news > a {
      color: #006699;
      opacity: 1;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        showAllNews(0);
    });
    function showAllNews(start){
        var module_url = '<?= PATH_URL ?><?=$this->lang->lang();?>/home/';
        var per_page        = 12;
        $.post(module_url+'showAllNews',{
            start            : start,
            per_page         : per_page,
            csrf_token: $('#csrf_token').val()
        },function(data){
            $('#wrap-post-news').html(data);
            
        });
    }
</script>
<section class="breadcrumb-area" style="background-image: url(<?= PATH_URL ?>assets/images/breadcrumb/breadcrumb-bg.jpg);">
	<div class="container-fluid text-center">
		<h1><?=lang('title_news')?></h1>
		<div class="breadcrumb-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left pull-left">
                            <ul>
                                <li><a href="<?=PATH_URL.$this->lang->lang();?>/"><?=lang('menu_home')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><?=lang('menu_news')?></li>
                            </ul>    
                        </div>
                        <!--<div class="right pull-right">
                            <a href="#"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>Get a Quote</a>
                        </div> -->    
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>
<!--End breadcrumb area-->

<!--Start blog area-->
<section id="blog-area" class="blog-with-sidebar-area">
    <div class="container" id="wrap-post-news">

    </div>
</section>