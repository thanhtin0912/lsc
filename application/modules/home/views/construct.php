<style type="text/css">
    .main-menu .navigation > li:hover > a, .main-menu .navigation > li.service > a {
      color: #006699;
      opacity: 1;
    }
</style>
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(<?= PATH_URL ?>assets/images/breadcrumb/breadcrumb-bg.jpg);">
    <div class="container-fluid text-center">
        <h1><?=lang('menu_service_c2')?></h1>
        <div class="breadcrumb-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left pull-left">
                            <ul>
                                <li><a href="<?=$this->lang->lang();?>/"><?=lang('menu_home')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><?=lang('menu_service')?></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><?=lang('menu_service_c2')?></li>
                            </ul>    
                        </div>
                        <div class="right pull-right">
                            <a href="#"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>Get a Quote</a>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->

<?php $lang = $this->lang->lang(); $content = "content_".$lang; echo $pages[0]->$content ?> 

