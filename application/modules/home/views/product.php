
<style type="text/css">
    .main-menu .navigation > li:hover > a, .main-menu .navigation > li.product > a {
      color: #006699;
      opacity: 1;
    }
    .sec-title{
        padding-bottom: 10px ! important;
    }
    .shop-withsidebar-area .more-blog-button a {
        padding: 7px 23px 5px;
    }
    .single-shop-item .title-holder .top .product-title h5 a{
        color: #252525;
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
        text-transform: capitalize ! important;
    }
</style>


<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(<?= PATH_URL ?>assets/images/breadcrumb/breadcrumb-bg.jpg);">
	<div class="container-fluid text-center">
		<h1><?=lang('title_product')?></h1>
		<div class="breadcrumb-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left pull-left">
                            <ul>
                                <li><a href="<?=$this->lang->lang();?>/"><?=lang('menu_home')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><?=lang('menu_products')?></li>
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
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="sidebar-wrapper">
                    <!--End single sidebar-->
                    <!--Start single sidebar-->
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
                    <!--End single sidebar-->

                </div>    
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <?php foreach ($cataproduct as $key => $p): ?>
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-md-12 col-xs-12">
                        <div class="sec-title pull-left ">
                            <h2><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $p->$name ?></h2>
                            <span class="decor"></span>
                        </div>
                        <div class="more-blog-button pull-right">
                            <a class="thm-btn bg-cl-1" href="<?=PATH_URL.$this->lang->lang().'/cata/'.$p->slug?>"><?=lang('title_view_all')?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a> 
                        </div>
                    </div>
                </div>
                <?php if($p->total==0){ ?>
                <div class="row checkout-area" style="padding: 0 ! important">
                    <div class="col-md-12">
                        <div class="exisitng-customer">
                            <h5>Don't have item</h5>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                <div class="row">
                    <?php foreach ($listproduct as $key => $c): ?>
                    <?php if ($c->type == $p->id ): ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="single-shop-item">
                            <a href="<?=PATH_URL.$this->lang->lang().'/product/'.$c->slug?>">
                                <div class="img-holder">
                                    <img src="<?=PATH_URL.DIR_UPLOAD_PRODUCTS.$c->avata?>" alt="Awesome Image">
                                   
                                </div>
                            </a>
                            <div class="title-holder">
                                <div class="top clearfix">
                                    <div class="product-title pull-left">
                                        <h5><a href="<?=PATH_URL.$this->lang->lang().'/product/'.$c->slug?>"><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $c->$name ?></a></h5>
                                    </div>
                                </div>
                                <?php if($c->price==0 || $c->price==''){?> <h4><?=lang('price_product')?>: <?= lang('menu_contact')?></h4> <?php }else { ?> <h4><?=lang('price_product')?>: <?php echo number_format($c->price)?></h4> <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>                            
                    <?php endforeach ?>
                </div>
                <?php } ?>
                <?php endforeach ?>
            </div>

        </div>
    </div>
</section>                 
<!--End shop area-->  