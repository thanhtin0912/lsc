<input type="hidden" value="<?=$detailcata[0]->slug ?>" id="type_product" />
<style type="text/css">
    .main-menu .navigation > li:hover > a, .main-menu .navigation > li.product > a {
      color: #006699;
      opacity: 1;
    }
    .single-shop-item .title-holder .top .product-title h5 a {
        color: #252525;
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        showAllProducts(0);
    });
    function showAllProducts(start){
        var module_url = '<?= PATH_URL ?><?=$this->lang->lang();?>/home/';
        var per_page        = 12;
        $.post(module_url+'showAllProducts',{
            link: $('#type_product').val(),
            start            : start,
            per_page         : per_page,
            csrf_token: $('#csrf_token').val()
        },function(data){
            $('#wrap-post-news').html(data);
            
        });
    }
</script>
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(<?= PATH_URL ?>assets/images/breadcrumb/breadcrumb-bg.jpg);">
	<div class="container-fluid text-center">
		<h1><?php $lang = $this->lang->lang(); $cataname = "name_".$lang; echo $detailcata[0]->$cataname ?></h1>
		<div class="breadcrumb-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left pull-left">
                            <ul>
                                <li><a href="<?=PATH_URL.$this->lang->lang()?>"><?=lang('menu_home')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><a href="<?=PATH_URL.$this->lang->lang()?>/products"><?=lang('menu_products')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><?php $lang = $this->lang->lang(); $cataname = "name_".$lang; echo $detailcata[0]->$cataname ?></li>
                            </ul>    
                        </div>   
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>
<!--End breadcrumb area-->
 
<!--Start shop with sidebar area-->
<section class="shop-withsidebar-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <div class="sidebar-wrapper">
                    <div class="single-sidebar">
                        <div class="sidebar-title">
                            <h1>Categories</h1>
                        </div>
                        <ul class="categories clearfix">
                            <?php foreach ($cataproduct as $key => $v): ;?>
                                <li><a href="<?=PATH_URL.$this->lang->lang().'/cata/'.$v->slug?>"><i class="fa fa-angle-right" aria-hidden="true"></i><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $v->$name ?><span>(<?=$v->total ?>)</span></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>    
            </div>
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                <!--Start Shop items-->
                <div class="shop-items" id="wrap-post-news">

                </div>
                <!--End Shop items-->
            </div>
        </div>
    </div>
</section>                 
<!--End shop area-->  