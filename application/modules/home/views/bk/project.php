<style type="text/css">
    .main-menu .navigation > li:hover > a, .main-menu .navigation > li.project > a {
      color: #006699;
      opacity: 1;
    }
</style>
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(<?=PATH_URL?>assets/images/breadcrumb/breadcrumb-bg.jpg);">
	<div class="container-fluid text-center">
		<h1>Projects Fullwidth</h1>
		<div class="breadcrumb-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left pull-left">
                            <ul>
                                <li><a href="<?=PATH_URL.$this->lang->lang();?>/"><?=lang('menu_home')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><?=lang('menu_project')?></li>
                            </ul>    
                        </div>

                    </div>
                </div>
            </div>
		</div>
	</div>
</section>
<!--End breadcrumb area-->
                                              
<!--Start project full width area--> 
<section id="project-area" class="pro-fullwidth-area">
    <div class="container-fluid">
        <ul class="project-filter post-filter text-center">
                <li class="active" data-filter=".filter-item"><span><?=lang('title_view_all')?></span></li>
                <?php foreach ($cataproject as $key => $v): ;?>
                <li data-filter=".<?=$v->id ?>"><span><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $v->$name ?></span></li>
                <?php endforeach ?>
        </ul>
        <div class="row project-content masonary-layout filter-layout">
                        <!--Start single project-->
            <?php if ($listproject!='') { ?>
            <?php foreach ($listproject as $key => $v): ;?>
            <div class="col-md-3 col-sm-6 col-xs-12 filter-item <?=$v->type ?>">
                <div class="single-project-item">
                    <div class="img-holder">
                        <img src="<?=PATH_URL.DIR_UPLOAD_PROJECTS.$v->avata ?>" alt="<?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $v->$name ?>">
                        <div class="overlay">
                            <div class="box">
                                <div class="content">
                                    <a href="<?= PATH_URL ?><?=$this->lang->lang();?>/project/<?=$v->slug?>"><h3><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $v->$name ?></h3></a>
                                    <p><?php $lang = $this->lang->lang(); $cataname = "cataname_".$lang; echo $v->$cataname ?></p>
                                    <!-- <div class="icon-holder">
                                        <a href="<?= PATH_URL ?><?=$this->lang->lang();?>projects/<?=$v->slug?>" data-rel="prettyPhoto" title="Interrio Project"><i class="fa fa-camera"></i></a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
            <!--End single project-->
            <?php endforeach ?>
            <?php }else{ ?> 
            <!--Start single project-->
            <div class="col-md-3 col-sm-6 col-xs-12 filter-item industrial corporate">
                <div class="single-project-item">
                    <div class="img-holder">
                        <img src="<?=PATH_URL?>assets/images/project/lat-pj-2.jpg" alt="Awesome Image">
                        <div class="overlay">
                            <div class="box">
                                <div class="content">
                                    <a href="project-single-v1.html"><h3>Modern Living Room</h3></a>
                                    <p>Residential</p>
                                    <div class="icon-holder">
                                        <a href="<?=PATH_URL?>assets/images/project/lat-pj-2.jpg" data-rel="prettyPhoto" title="Interrio Project"><i class="fa fa-camera"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
            <!--End single project-->
            <!--Start single project-->
            <div class="col-md-3 col-sm-6 col-xs-12 filter-item corporate residential restaurant">
                <div class="single-project-item">
                    <div class="img-holder">
                        <img src="<?=PATH_URL?>assets/images/project/lat-pj-3.jpg" alt="Awesome Image">
                        <div class="overlay">
                            <div class="box">
                                <div class="content">
                                    <a href="project-single-v1.html"><h3>Modern Living Room</h3></a>
                                    <p>Residential</p>
                                    <div class="icon-holder">
                                        <a href="<?=PATH_URL?>assets/images/project/lat-pj-3.jpg" data-rel="prettyPhoto" title="Interrio Project"><i class="fa fa-camera"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
            <!--End single project-->
            <!--Start single project-->
            <div class="col-md-3 col-sm-6 col-xs-12 filter-item corporate residential industrial">
                <div class="single-project-item">
                    <div class="img-holder">
                        <img src="<?=PATH_URL?>assets/images/project/lat-pj-4.jpg" alt="Awesome Image">
                        <div class="overlay">
                            <div class="box">
                                <div class="content">
                                    <a href="project-single-v1.html"><h3>Modern Living Room</h3></a>
                                    <p>Residential</p>
                                    <div class="icon-holder">
                                        <a href="<?=PATH_URL?>assets/images/project/lat-pj-4.jpg" data-rel="prettyPhoto" title="Interrio Project"><i class="fa fa-camera"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
            <!--End single project-->
            <!--Start single project-->
            <div class="col-md-3 col-sm-6 col-xs-12 filter-item residential corporate industrial">
                <div class="single-project-item">
                    <div class="img-holder">
                        <img src="<?=PATH_URL?>assets/images/project/lat-pj-5.jpg" alt="Awesome Image">
                        <div class="overlay">
                            <div class="box">
                                <div class="content">
                                    <a href="project-single-v1.html"><h3>Modern Living Room</h3></a>
                                    <p>Residential</p>
                                    <div class="icon-holder">
                                        <a href="<?=PATH_URL?>assets/images/project/lat-pj-5.jpg" data-rel="prettyPhoto" title="Interrio Project"><i class="fa fa-camera"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
            <!--End single project-->
            <!--Start single project-->
            <div class="col-md-3 col-sm-6 col-xs-12 filter-item residential industrial restaurant">
                <div class="single-project-item">
                    <div class="img-holder">
                        <img src="<?=PATH_URL?>assets/images/project/lat-pj-6.jpg" alt="Awesome Image">
                        <div class="overlay">
                            <div class="box">
                                <div class="content">
                                    <a href="project-single-v1.html"><h3>Modern Living Room</h3></a>
                                    <p>Residential</p>
                                    <div class="icon-holder">
                                        <a href="<?=PATH_URL?>assets/images/project/lat-pj-6.jpg" data-rel="prettyPhoto" title="Interrio Project"><i class="fa fa-camera"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
            <!--End single project-->
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="loadmore-btn text-center">
                    <a class="thm-btn bg-cl-1" href="#">Load More</a>
                </div>
            </div>
        </div>
    </div>
</section>                            
<!--End project full width area--> 