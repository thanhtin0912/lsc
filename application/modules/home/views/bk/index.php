<style type="text/css">
    .main-menu .navigation > li:hover > a, .main-menu .navigation > li.home > a {
      color: #006699;
      opacity: 1;
    }
</style>
<!--Start rev slider wrapper-->     
<section class="rev_slider_wrapper">
    <div id="slider1" class="rev_slider"  data-version="5.0">
        <ul>
            <?php foreach ($banner as $key => $v): ;?>
            <?php $du= ($key+1)%2;
            if ($du!=0) { ?>
            <li data-transition="slidingoverlayleft">
                <img src="<?=PATH_URL.DIR_UPLOAD_BANNER.$v->image ?>"  alt="" width="1920" height="800" data-bgposition="top center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="1" >
                
            </li>
            <?php } else { ?>
            <li data-transition="slidingoverlayleft">
                <img src="<?=PATH_URL.DIR_UPLOAD_BANNER.$v->image ?>"  alt="" width="1920" height="800" data-bgposition="top center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="1" >
                
            </li>
            <?php }?>
            <?php endforeach ?>
        </ul>
    </div>
</section>
    

<!--Start project with text area--> 
<section id="project-area" class="pro-fullwidth-area">
    <div class="container-fluid">
        <ul class="project-filter post-filter text-center">
            <li class="active" data-filter=".filter-item"><span>View All</span></li>
            <?php foreach ($cataparent as $key => $p): ;?>
            <li data-filter=".<?php echo $p->id ?>"><span><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $p->$name ?></span></li>
            <?php endforeach ?>
        </ul>
        <div class="row project-content masonary-layout filter-layout">
            <!--Start single project item-->
            <?php foreach ($cataproduct as $key => $c): ;?>
            <div class="single-project-item col-md-2 col-sm-3 col-xs-6 filter-item <?php echo $c->type ?>">
                <div class="img-holder">
                    <img src="<?=PATH_URL.DIR_UPLOAD_CATA.$c->avata ?>" alt="Awesome Image">
                    <div class="overlay">
                        <div class="box">
                            <div class="content">
                                <a href="<?=PATH_URL.$this->lang->lang().'/cata/'.$c->slug ?>"><h3><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $c->$name ?></h3></a>
                                <div class="icon-holder">
                                    <a href="images/project/pj-fullwidth/1.jpg" data-rel="prettyPhoto" title="Interrio Project"><i class="fa fa-camera"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>                           
<!--End project with text area--> 

<section class="pro-withtext-area">
    <div class="container">
        <div class="container">
            <div class="sec-title pull-left">
                <h2><?=lang('menu_service')?></h2>
                <span class="decor"></span>
            </div>   
        </div>

        <div class="row project-content masonary-layout">
            <?php if ($services!='') { ?>
            <?php foreach ($services as $key => $v): ;?>
            <div class="single-project-item col-md-6 col-sm-6 col-xs-12" style="position: absolute; left: 0px; top: 0px;">
                <div class="img-holder">
                    <img src="<?=PATH_URL.DIR_UPLOAD_SERVICES.$v->image ?>" alt="Awesome Image">
                    <a href="<?=PATH_URL.$this->lang->lang().'/service/'.$v->slug?>" data-rel="prettyPhoto" title="Interrio Project">
                        <div class="overlay">
                            <div class="box">
                                <div class="content">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="text-holder">
                    <a href="<?=PATH_URL.$this->lang->lang().'/service/'.$v->slug?>"><h3><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?></h3></a>
                    <p><?php $lang = $this->lang->lang(); $description = "description_".$lang; cutText($v->$description, 100) ?></p>
                </div>   
            </div>
            <?php endforeach ?>
            <?php }else{ ?>
            <div class="single-project-item col-md-4 col-sm-4 col-xs-12" style="position: absolute; left: 0px; top: 0px;">
                <div class="img-holder">
                    <img src="<?=PATH_URL.DIR_UPLOAD_SERVICES.$v->image ?>" alt="Awesome Image">
                    <a href="<?=PATH_URL.$this->lang->lang().'/service/'.$v->slug?>" data-rel="prettyPhoto" title="Interrio Project">
                        <div class="overlay">
                            <div class="box">
                                <div class="content">
                                    <!-- <div class="icon-holder">
                                        <span class="flaticon-cross"></span>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="text-holder">
                    <a href="<?=PATH_URL.$this->lang->lang().'/service/'.$v->slug?>"><h3><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?></h3></a>
                    <p><?php $lang = $this->lang->lang(); $description = "description_".$lang; cutText($v->$description, 100) ?></p>
                </div>   
            </div>
            <?php }?>
        </div>     
    </div>
</section>

<!--Start latest blog area-->
<section class="latest-blog-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="sec-title pull-left">
                    <h2><?=lang('footer_row2_news')?></h2>
                    <span class="decor"></span>
                </div>
                <div class="more-blog-button pull-right">
                    <a class="thm-btn bg-cl-1" href="<?= PATH_URL ?><?=$this->lang->lang();?>/news"><?=lang('title_view_all')?></a> 
                </div>
            </div>
        </div>   
        <div class="row">
            <!--Start single blog item-->
            <?php foreach ($newsfooter as $key => $v):?>
            <div class="col-md-4">
                <div class="single-blog-item">
                    <div class="img-holder">
                        <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>">
                            <img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$v->image ?>" alt="<?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?>">
                            <div class="overlay">
                                <div class="box">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="text-holder">
                        <a href="blog-single.html">
                            <h3 class="blog-title"><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?></h3>
                        </a>
                        <ul class="meta-info">
                            <li><i class="fa fa-user" aria-hidden="true"></i><a href="#">Fletcher</a></li>
                            <li><i class="fa fa-clock-o" aria-hidden="true"></i><a href="#"><?php $date = $v->created ;echo date("d/m/Y", strtotime($date)); ?></a></li>
                        </ul>
                        <div class="text">
                            <p><?= $lang = $this->lang->lang(); $description = "description_".$lang; cutText($v->$description, 150) ?></p>
                            <a class="readmore" href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>">Read More<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        </div>
                    </div>    
                </div>    
            </div>
            <!--End single blog item-->
            <?php endforeach ?>
        </div>
    </div>
</section>
<!--End latest blog area-->