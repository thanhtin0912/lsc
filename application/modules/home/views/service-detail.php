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
                <span class="current"><?=lang('menu_course')?></span>
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
                        <img src="<?= PATH_URL . DIR_UPLOAD_SERVICES . $result[0]->image ?>" width="100%">
                    </div>		
                    <div class="entry-details px-3">	
                        <div class="entry-title">
                            <h3><a href="#"><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $result[0]->$title ?> </a></h3>
                        </div>		
                        <!--entry-metadata ends-->	
                        <div class="entry-body">
                            <blockquote class="mb-3">
                                <q><?php $lang = $this->lang->lang(); $description = "description_".$lang; echo $result[0]->$description ?></q> 
                            </blockquote>
                            <?php $lang = $this->lang->lang(); $content = "content_".$lang; echo $result[0]->$content ?>
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
            
        </section>
        <!--secondary ends-->
        
    </div>
    <!--container ends-->
</div>
<!--main ends-->
<!--fullwidth-background starts-->
<section class="fullwidth-background dt-sc-parallax-section turquoise-bg">
    <!--container starts-->
    <div class="container">
        <form class="admission-form p-3" novalidate="novalidate">
            <p class="dt-sc-one-fourth column first">
                <input id="name" name="txtname" type="text" placeholder="Name" required="">
            </p>
            <p class="dt-sc-one-fourth column">
                <input id="age" name="txtPhone" type="text" placeholder="Phone" required="">
            </p>
            <p class="dt-sc-one-fourth column">
                <input id="course" name="txtcourse" type="text" placeholder="Course" required="">
            </p>
            <p class="dt-sc-one-fourth column">
                <input id="course" name="txtMail" type="text" placeholder="Mail" required="">
            </p>
            <div id="ajax_admission_msg"> </div>
            <p class="aligncenter pt-3">
                <input class="px-5" name="submit" type="submit" id="submit" value="<?= lang('btn_contact') ?>">
            </p>
        </form>
    </div>
</section>