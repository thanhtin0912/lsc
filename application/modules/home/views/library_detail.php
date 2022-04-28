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
                <span class="current"><?=lang('menu_document')?></span>
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
                        <a href="#"><img src="<?=PATH_URL.DIR_UPLOAD_PROJECTS.$res[0]->avata ?>" alt="" title="" width="100%"></a>
                    </div>		
                    <div class="entry-details px-3">	
                        <div class="entry-title">
                            <h3><a href="#"><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $res[0]->$name ?> </a></h3>
                        </div>
                        <div class="entry-author mb-3">
                            <p class="comments"><a href="#"><span class="fa fa-pencil"></span> Image</span></a> |</p>
                            <p class="date"><a href="#"><i class="fa fa-calendar"></i> <?php $date = $res[0]->created ;echo date("d/m/Y", strtotime($date)); ?> </a></p>
                        </div>			
                        <!--entry-metadata ends-->
                        <?php if(count($res[0]->description_vn) > 0 || $res[0]->description_vn != '') { ?>
                        <div class="entry-body">
                            <blockquote class="mb-3">
                                <q><?php $lang = $this->lang->lang(); $description = "description_".$lang; echo $res[0]->$description ?></q> 
                            </blockquote>
                        </div>
                        <?php } ?>
	
                        <?php foreach ($listimages as $key => $v): ;?>
                        <div class="entry-thumb">
                            <img src="<?=PATH_URL.DIR_UPLOAD_PROJECTS.$v ?>" width="100%" alt="Awesome Image">
                        </div>	
                        <?php endforeach ?> 		
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
            
            <?php if ($likeLibraries) { ?>
            <aside class="widget widget_recent_entries">
                <h3 class="widgettitle"><?= lang('news_title')?></h3>
                <!--dt-sc-tabs-container starts-->            
                <div class="dt-sc-tabs-container">
                    <div class="dt-sc-tabs-content">
                        <?php foreach ($likeLibraries as $key => $v):?>
                        <img src="<?=PATH_URL.DIR_UPLOAD_PROJECTS.$v->image ?>" alt="Awesome Image">
                        <h5><a href="<?=PATH_URL.$this->lang->lang().'/library/'.$v->slug?>"><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $v->$name ?></a></h5>
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