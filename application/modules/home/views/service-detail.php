<style type="text/css">
    .main-menu .navigation > li:hover > a, .main-menu .navigation > li.services > a {
      color: #006699;
      opacity: 1;
    }
</style>
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(<?= PATH_URL ?>assets/images/breadcrumb/breadcrumb-bg.jpg);">
	<div class="container-fluid text-center">
		<h1><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $result[0]->$title ?></h1>
		<div class="breadcrumb-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left pull-left">
                            <ul>
                                <li><a href="<?=PATH_URL.$this->lang->lang();?>/"><?=lang('menu_home')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $result[0]->$title ?></li>
                            </ul>    
                        </div>  
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>
<!--End breadcrumb area-->

<!--Start blog area-->
<section id="blog-area" class="blog-single-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                <div class="blog-post">
                    <!--Start single blog post-->
                    <div class="single-blog-item">
                        <div class="img-holder">
                            <img src="<?=PATH_URL.DIR_UPLOAD_SERVICES.$result[0]->image ?>" alt="Awesome Image">
                        </div>
                        <div class="text-holder">
                            <h3 class="blog-title"><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $result[0]->$title ?></h3>
                            <div class="text">
                                <p class="mar-bottom"><?php $lang = $this->lang->lang(); $description = "description_".$lang; echo $result[0]->$description ?></p>
                                <?php $lang = $this->lang->lang(); $content = "content_".$lang; echo $result[0]->$content ?>
                            </div>
                        </div>    

                    </div>
                    <!--End single blog post-->
                </div>
            </div>
            <!--Start sidebar Wrapper-->
            <div class="col-lg-3 col-md-4 col-sm-7 col-xs-12">
                <div class="sidebar-wrapper">
                    <!--Start single sidebar-->
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
<!--End blog area-->                                                                        
  