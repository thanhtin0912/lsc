<style type="text/css">
    .main-menu .navigation > li:hover > a, .main-menu .navigation > li.news > a {
      color: #006699;
      opacity: 1;
    }
</style>
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(<?= PATH_URL ?>assets/images/breadcrumb/breadcrumb-bg.jpg);">
	<div class="container-fluid text-center">
		<h1><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $news[0]->$title ?></h1>
		<div class="breadcrumb-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left pull-left">
                            <ul>
                                <li><a href="<?=PATH_URL.$this->lang->lang();?>/"><?=lang('menu_home')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><a href="<?=PATH_URL.$this->lang->lang();?>/news"><?=lang('menu_news')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $news[0]->$title ?></li>
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
                            <img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$news[0]->image ?>" alt="Awesome Image">
                        </div>
                        <div class="text-holder">
                            <h3 class="blog-title"><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $news[0]->$title ?></h3>
                            <ul class="meta-info">
                                <li><i class="fa fa-user" aria-hidden="true"></i><a href="javascript:void(0);">By Hương Việt</a></li>
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i><a href="javascript:void(0);"><?php $date = $news[0]->created ;echo date("d/m/Y", strtotime($date)); ?></a></li>
                                <li><i class="fa fa-folder-open-o" aria-hidden="true"></i><a href="javascript:void(0);"><?php $lang = $this->lang->lang(); $cataname = "cataname_".$lang; echo $news[0]->$cataname ?></a></li>
                            </ul>
                            <div class="text">
                                <p class="mar-bottom"><?php $lang = $this->lang->lang(); $description = "description_".$lang; echo $news[0]->$description ?></p>
                                <?php $lang = $this->lang->lang(); $content = "content_".$lang; echo $news[0]->$content ?>
                            </div>
                        </div>    

                    </div>
                    <!--End single blog post-->
                    <!--Start tag and social share box-->
                    <div class="tag-social-share-box">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="social-share pull-right">
                                    <h5>Share<i class="fa fa-share-alt" aria-hidden="true"></i></h5>
                                    <ul class="social-share-links">
                                        <li><a href="javascript:void(0);"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Start sidebar Wrapper-->
            <div class="col-lg-3 col-md-4 col-sm-7 col-xs-12">
                <div class="sidebar-wrapper">
                    <!--Start single sidebar-->
                    <div class="single-sidebar">
                        <form class="search-form" action="#">
							<input placeholder="Search..." type="text">
							<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
						</form>
                    </div>

                    <!--Start single sidebar--> 
                    <div class="single-sidebar">
                        <div class="sidebar-title">
                            <h1><?= lang('news_title')?></h1>
                        </div>
                        <ul class="recent-post">
                            
                            <?php foreach ($likenews as $key => $v):?>
                            <li>
                                <div class="img-holder">
                                    <img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$v->image ?>" alt="Awesome Image">
                                    <div class="overlay">
                                        <div class="box">
                                            <div class="content">
                                                <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="title">
                                    <h3><a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>"><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?></a></h3>
                                    <p><?php $lang = $this->lang->lang(); $cataname = "cataname_".$lang; echo $v->$cataname ?></p>
                                </div>
                            </li>
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
  