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
            <div class="col-md-4">
                <div class="project-info">
                    <h3><?=lang('project_tile_about')?></h3>
                    <?php $lang = $this->lang->lang(); $content = "content_".$lang; echo $project[0]->$content ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
               <div class="project-info">
                    <h3></h3>
                    <div class="col-md-4">
                        <ul class="project-info-list">
                            <li>
                                <div class="icon-holder">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <div class="text-holder">
                                    <h5><?=lang('project_tile_client')?></h5>
                                    <p><?=$project[0]->customer ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="project-info-list">
                            <li>
                                <div class="icon-holder">
                                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                                </div>
                                <div class="text-holder">
                                    <h5><?=lang('project_tile_category')?></h5>
                                    <?php $lang = $this->lang->lang(); $cataname = "cataname_".$lang; echo $project[0]->$cataname ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="project-info-list">
                            <li>
                                <div class="icon-holder">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </div>
                                <div class="text-holder">
                                    <h5><?=lang('project_tile_startdate')?></h5>
                                    <p><?=$project[0]->startdate ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="project-info-list">
                            <li>
                                <div class="icon-holder">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </div>
                                <div class="text-holder">
                                    <h5><?=lang('project_tile_enddate')?></h5>
                                    <p><?=$project[0]->enddate ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="project-info-list">
                            <li>
                                <div class="icon-holder">
                                    <i class="fa fa-usd" aria-hidden="true"></i>
                                </div>
                                <div class="text-holder">
                                    <h5><?=lang('project_tile_projectby')?></h5>
                                    <p><?=$project[0]->projectby ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="project-info-list">
                            <li>
                                <div class="icon-holder">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </div>
                                <div class="text-holder">
                                    <h5><?=lang('project_tile_location')?></h5>
                                    <p><?=$project[0]->location ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<!--         <div class="row">
            <div class="col-md-12">
                <div class="project-description-content">
                    <h3><?=lang('project_tile_description')?></h3>
                    <div class="text">
                        <?php $lang = $this->lang->lang(); $content = "content_".$lang; echo $project[0]->$content ?>
                    </div>
                    <?php if ($project[0]->comment!='') { ?>
                    <div class="project-manager-box">
                        <h4><?=$project[0]->comment ?> </h4>
                        <h5><span><?=$project[0]->customer ?></span></h5>
                    </div>
                     <?php }else{ ?> 
                    <?php } ?>
                </div>
            </div>
        </div> -->
        <!--Start related project items-->
        <?php if ($likeprojects!='') { ?>
        <div class="row">
            <div class="related-project-items">
                <div class="sec-title text-center">
                    <h2><?=lang('project_tile_related')?></h2>
                </div>
                <?php foreach ($likeprojects as $key => $v): ;?>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="single-project-item">
                        <div class="img-holder">
                            <img src="<?=PATH_URL.DIR_UPLOAD_PROJECTS.$v->avata ?>" alt="Awesome Image">
                            <a href="images/project/pj-single/rel-pj-1.jpg" data-rel="prettyPhoto" title="Interrio Project">
                                <div class="overlay">
                                    <div class="box">
                                        <div class="content">
                                            <div class="icon-holder">
                                                <span class="flaticon-cross"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="text-holder">
                            <a href="project-single-v1.html"><h3><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $v->$name ?></h3></a>
                            <p><?php $lang = $this->lang->lang(); $cataname = "cataname_".$lang; echo $v->$cataname ?></p>
                        </div>   
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
        <!--End related project items-->  
        <?php }else{ ?> 
        <?php } ?>
    </div>
</section>                                                                      
<!--End project single v2 area-->  