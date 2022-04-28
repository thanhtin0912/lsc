<style type="text/css">
    .main-menu .navigation > li:hover > a, .main-menu .navigation > li.project > a {
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
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(<?=PATH_URL?>/assets/images/breadcrumb/breadcrumb-bg.jpg);">
	<div class="container-fluid text-center">
		<h1><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $project[0]->$name ?></h1>
		<div class="breadcrumb-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left pull-left">
                            <ul>
                                <li><a href="<?=PATH_URL.$this->lang->lang();?>/"><?=lang('menu_home')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><a href="<?=PATH_URL.$this->lang->lang();?>/projects"><?=lang('menu_project')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $project[0]->$name ?></li>
                            </ul>    
                        </div>   
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>
<!--End breadcrumb area-->
                                              
<!--Start project single v2 area-->
<section id="project-single-area" class="project-single-v1-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <?php if ($listimages!='') { ?>
                <div id="project-single-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php foreach ($listimages as $key => $v): ;?>
                        <li data-target="#project-single-carousel" data-slide-to="<?=$key?>" class="<?php if($key==0){echo 'active';} ?>"></li>
                        <?php endforeach ?>

                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php foreach ($listimages as $key => $v): ;?>
                        <div class="item <?php if($key==0){echo 'active';} ?>">
                            <div class="single-item">
                                <div class="img-holder">
                                    <img src="<?=PATH_URL.DIR_UPLOAD_PROJECTS.$v ?>" alt="Awesome Image">
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>

                    </div>
                </div>
                
                <?php }else{ ?> 
                <div class="single-project-item">
                    <div class="img-holder">
                        <img src="<?=PATH_URL.DIR_UPLOAD_PROJECTS.$project[0]->avata ?>" alt="Awesome Image">
                    </div> 
                </div>
                <?php } ?> 
            </div>
        </div>
    </div>
</section>                                                                      
<!--End project single v2 area-->  