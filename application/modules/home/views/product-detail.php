<style type="text/css">
    .main-menu .navigation > li:hover > a, .main-menu .navigation > li.product > a {
      color: #006699;
      opacity: 1;
    }
    .single-shop-item .title-holder .top .product-title h5 a{
        color: #252525;
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
    }
</style>

<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(<?= PATH_URL ?>assets/images/breadcrumb/breadcrumb-bg.jpg);">
    <div class="container-fluid text-center">
        <h1><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $product[0]->$name ?></h1>
        <div class="breadcrumb-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left pull-left">
                            <ul>
                                <li><a href="<?=PATH_URL.$this->lang->lang()?>/"><?=lang('menu_home')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><a href="<?=PATH_URL.$this->lang->lang()?>/products"><?=lang('menu_products')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><a href="<?=PATH_URL.$this->lang->lang().'/cata/'.$product[0]->cataslug?>"><?php $lang = $this->lang->lang(); $cataname = "cataname_".$lang; echo $product[0]->$cataname ?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $product[0]->$name ?></li>
                            </ul>    
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->
 
<!--Start Shop single area-->
<section class="shop-single-area" id="project-single-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                <div class="single-products-details">       
                    <div class="product-content-box">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="single-project-item">
                                    <div class="img-holder">
                                        <img src="<?=PATH_URL.DIR_UPLOAD_PRODUCTS.$product[0]->avata ?>" alt="Awesome Image">
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="project-info">
                                    <h3><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $product[0]->$name ?></h3>
                                    <?php $lang = $this->lang->lang(); $description = "description_".$lang; echo $product[0]->$description ?>
                                    <ul class="project-info-list">
                                        <li>
                                            <div class="icon-holder">
                                                <i class="fa fa-folder-open" aria-hidden="true"></i>
                                            </div>
                                            <div class="text-holder">
                                                <h5><?=lang('cata_product')?></h5>
                                                <p><?php $lang = $this->lang->lang(); $cataname = "cataname_".$lang; echo $product[0]->$cataname ?></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="icon-holder">
                                                <i class="fa fa-usd" aria-hidden="true"></i>
                                            </div>
                                            <div class="text-holder">
                                                <h5><?=lang('price_product')?></h5>
                                                <p><?php if($product[0]->price==0 || $product[0]->price==''){?> 
                                                    <span class="price"><?= lang('menu_contact')?></span> 
                                                    <?php }else { ?> 
                                                    <span class="price"><?php echo number_format($product[0]->price)?></span>
                                                    <?php } ?>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="share-project">
                                        <div class="title">
                                            <h5>share this project</h5>
                                        </div>
                                        <div class="social-share">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                
                    <div class="product-tab-box">
                        <ul class="nav nav-tabs tab-menu">
                            <li class="active"><a href="#desc" data-toggle="tab"><?=lang('project_tile_description')?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="desc">
                                <div class="product-details-content">
                                    <div class="desc-content-box">
                                        <?php $lang = $this->lang->lang(); $content = "content_".$lang; echo $product[0]->$content ?>
                                    </div>

                                </div>    
                            </div>
                        </div>      
                    </div>
                    <div class="related-product">
                        <div class="sec-title-two">
                            <h3><?=lang('like_product')?></h3>
                            <span class="border"></span>
                        </div>
                        <div class="row">
                            <div class="related-product-items">
                            <?php foreach ($likeproducts as $key => $v): ;?>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <div class="single-shop-item">
                                        <a href="<?=PATH_URL.$this->lang->lang().'/product/'.$v->slug?>">
                                            <div class="img-holder">
                                                <img src="<?=PATH_URL.DIR_UPLOAD_PRODUCTS.$v->avata?>" alt="Awesome Image">
                                            </div>
                                        </a>
                                        <div class="title-holder">
                                            <div class="top clearfix">
                                                <div class="product-title pull-left">
                                                    <h5><a href="<?=PATH_URL.$this->lang->lang().'/product/'.$v->slug?>"><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $v->$name ?></a></h5>
                                                </div>
                                            </div>
                                            <?php if($v->price==0 || $v->price==''){?> <h4><?= lang('menu_contact')?></h4> <?php }else { ?> <h4><?php echo number_format($v->price)?></h4> <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <!--Start sidebar Wrapper-->
            <div class="col-lg-3 col-md-4 col-sm-7 col-xs-12">
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
            <!--End Sidebar Wrapper-->          
        </div>
    </div>
</section>         
<!--End Shop single area-->