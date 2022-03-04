

            <div class="row">
                <?php foreach ($result as $key => $v): ;?>
                <?php  if(($key+1) != $total){  ?>
                <?php    $sodu = (($key+1) % 3); ?>
                <?php    if($sodu==0){ ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="single-blog-item">
                        <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>">
                        <div class="img-holder">
                            <img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$v->image ?>" alt="<?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?>">
                            <div class="overlay">
                                <div class="box">
                                    <div class="content">
                                        <i class="fa fa-link"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a> 
                        <div class="text-holder">
                            <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>">
                                <h3 class="blog-title"><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?></h3>
                            </a>
                            <ul class="meta-info">
                                <li><i class="fa fa-folder-open-o" aria-hidden="true"></i><a href="javascript:void(0);"><?php $lang = $this->lang->lang(); $cataname = "cataname_".$lang; echo $v->$cataname ?></a></li>
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i><a href="javascript:void(0);"><?php $date = $v->created ;echo date("d/m/Y", strtotime($date)); ?></a></li>
                            </ul>
                            <div class="text">
                                <p><?= $lang = $this->lang->lang(); $description = "description_".$lang; cutText($v->$description, 150) ?></p>
                                <a class="readmore" href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>">
                                    <?=lang('btn_viewmore')?><i class="fa fa-caret-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="row">
                <?php } else { ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="single-blog-item">
                        <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>">
                        <div class="img-holder">
                            <img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$v->image ?>" alt="<?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?>">
                            <div class="overlay">
                                <div class="box">
                                    <div class="content">
                                        <i class="fa fa-link"></i> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                        <div class="text-holder">
                            <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>">
                                <h3 class="blog-title"><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?></h3>
                            </a>
                            <ul class="meta-info">
                                <li><i class="fa fa-folder-open-o" aria-hidden="true"></i><a href="javascript:void(0);"><?php $lang = $this->lang->lang(); $cataname = "cataname_".$lang; echo $v->$cataname ?></a></li>
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i><a href="javascript:void(0);"><?php $date = $v->created ;echo date("d/m/Y", strtotime($date)); ?></a></li>
                            </ul>
                            <div class="text">
                                <p><?= $lang = $this->lang->lang(); $description = "description_".$lang; cutText($v->$description, 150) ?></p>
                                <a class="readmore" href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>">
                                    <?=lang('btn_viewmore')?><i class="fa fa-caret-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>    
                    </div>
                </div>
                <?php } ?> 
                
                
                <?php } else {  ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="single-blog-item">
                        <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>">
                        <div class="img-holder">
                            <img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$v->image ?>" alt="<?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?>">
                            <div class="overlay">
                                <div class="box">
                                    <div class="content">
                                        <i class="fa fa-link"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a> 
                        <div class="text-holder">
                            <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>">
                                <h3 class="blog-title"><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?></h3>
                            </a>
                            <ul class="meta-info">
                                <li><i class="fa fa-folder-open-o" aria-hidden="true"></i><a href="javascript:void(0);"><?php $lang = $this->lang->lang(); $cataname = "cataname_".$lang; echo $v->$cataname ?></a></li>
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i><a href="javascript:void(0);"><?php $date = $v->created ;echo date("d/m/Y", strtotime($date)); ?></a></li>
                            </ul>
                            <div class="text">
                                <p><?= $lang = $this->lang->lang(); $description = "description_".$lang; cutText($v->$description, 100) ?></p>
                                <a class="readmore" href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>">
                                    <?=lang('btn_viewmore')?><i class="fa fa-caret-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php endforeach ?>
          
        </div>
        <?php if($result){ ?>
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <ul class="post-pagination text-center" style="visibility: visible;">
                    <?=$this->adminpagination->create_links();?>
                </ul>
            </div>
        </div>
        <?php } ?>