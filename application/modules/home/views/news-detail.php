<style>
    .blog-entry {
        color: #5c5c5c ! important;
        margin-bottom: 10px !important;
    }
    .entry-author p {
        display: inline-block;
        clear: none;
        background: none;
        margin: 0px;
        line-height: inherit;
        padding: 0px;
        color: #b6b6b6
    }
</style>
<!--main starts-->
<div id="main">
    <!--breadcrumb-section starts-->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?=PATH_URL.$this->lang->lang();?>/"><?=lang('menu_home')?></a>
                <span class="fa fa-angle-double-right"></span>
                <span class="current"><?=lang('menu_news')?></span>
            </div>
        </div>
    </div>
    <!--container starts-->
    <div class="container">
        <!--primary starts-->
        <section id="primary" class="with-sidebar">
            <article class="blog-entry">
                <div class="blog-entry-inner">	
                    <div class="entry-thumb">
                        <a href="#"><img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$news[0]->image ?>" alt="" title="" width="100%"></a>
                    </div>		
                    <div class="entry-details px-3">	
                        <div class="entry-title">
                            <h3><a href="#"><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $news[0]->$title ?> </a></h3>

                        </div>
                        <div class="entry-author mb-3">
                            <p class="comments"><a href="#"><span class="fa fa-pencil"></span> <?php $lang = $this->lang->lang(); $cata = "cata_".$lang; echo $news[0]->$cata ?></span></a> |</p>
                            <p class="date"><a href="#"><i class="fa fa-calendar"></i> <?php $date = $news[0]->created ;echo date("d/m/Y", strtotime($date)); ?> </a></p>
                        </div>			
                        <!--entry-metadata ends-->	
                        <div class="entry-body">
                            <blockquote class="mb-3">
                                <q><?php $lang = $this->lang->lang(); $description = "description_".$lang; echo $news[0]->$description ?></q> 
                            </blockquote>
                            <?php $lang = $this->lang->lang(); $content = "content_".$lang; echo $news[0]->$content ?>
                        </div>	 		
                    </div>	
                </div>
            </article>
        </section>
        <!--primary ends-->
        
        <!--secondary starts-->
        <section id="secondary">
            <aside class="widget widget_categories">
                <h3 class="widgettitle"><?=lang('menu_course')?></h3>
                <ul>
                    <?php foreach ($services as $key => $v) :; ?>
                        <li><a href="<?= PATH_URL . $this->lang->lang() . '/service/' . $v->slug ?>">
                        <?php $lang = $this->lang->lang();
                        $title = "title_" . $lang;
                        echo $v->$title ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </aside>
            
            <?php if ($likenews) { ?>
            <aside class="widget widget_recent_entries">
                <h3 class="widgettitle"><?= lang('news_title')?></h3>
                <!--dt-sc-tabs-container starts-->            
                <div class="dt-sc-tabs-container">
                    <div class="dt-sc-tabs-content">
                        <?php foreach ($likenews as $key => $v):?>
                        <img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$v->image ?>" alt="Awesome Image">
                        <h5><a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>"><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?></a></h5>
                        <?php endforeach ?>
                    </div>
                </div>
                <!--dt-sc-tabs-container ends-->
            </aside>
            <?php } ?>
        </section>
        <!--secondary ends-->
        
    </div>
    <!--container ends-->
</div>
<!--main ends-->
