        <!--main starts-->
        <div id="main">
            <!--slider starts-->
            <div id="slider"> 
                <div id="layerslider_4" class="ls-wp-container" style="width:100%;height:610px;max-width:1920px;margin:0 auto;margin-bottom: 0px;">
                    <?php foreach ($banner as $key => $v): ;?>
                    <div class="ls-slide" data-ls="slidedelay:7000; transition2d: all;">
                        <img src="<?=PATH_URL.DIR_UPLOAD_BANNER.$v->image ?>" class="ls-bg" alt="Slide background" />
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
            <!--slider ends-->
            <!--primary starts-->
            <section id="primary" class="content-full-width">
                <!--container starts-->
                <div class="container">
                    <h2 class="dt-sc-hr-green-title"> <?=lang('menu_course')?> </h2>
                    <?php foreach ($services as $key => $v): ;?>
                    <div class="column dt-sc-one-fourth">
                        <div class="activity <?php if (($key%2)==1) {echo 'box1';}else{echo 'box4';} ?>">
                            <a href="<?=PATH_URL.$this->lang->lang().'/service/'.$v->slug?>"><img src="<?=PATH_URL.DIR_UPLOAD_SERVICES.$v->image ?>" alt="" title=""></a>
                            <h4> <?php $lang = $this->lang->lang(); $title = "title_".$lang; cutText($v->$title,30) ?></h4>
                            <p><?php $lang = $this->lang->lang(); $description = "description_".$lang; cutText($v->$description, 100) ?></p>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <!--container ends-->
                <div class="dt-sc-hr"></div>
                <!--fullwidth-background starts-->
                <section class="fullwidth-background dt-sc-parallax-section turquoise-bg">
                    <!--container starts-->
                    <div class="container">
                        <!--dt-sc-one-half starts-->
                        <div class="dt-sc-one-half column first">
                            <h2>Play As You Learn</h2>
                            <!--dt-sc-one-half starts-->
                            <div class="dt-sc-one-half column first">
                                
                                <div class="dt-sc-ico-content type2">
                                    <div class="icon"> 
                                        <span class="fa fa-glass"> </span> 
                                    </div>
                                    <h4><a href="#" target="_blank"> English Summer Camp </a></h4>
                                    <p>Nam ullamcorper, diam sit amet euismod pelleontesque, eros risus rhoncus libero, inst tibulum nisl ligula....</p>
                                </div>
                                <div class="dt-sc-hr-very-small"></div>
                                <div class="dt-sc-ico-content type2">
                                    <div class="icon"> 
                                        <span class="fa fa-pencil"> </span> 
                                    </div>
                                    <h4><a href="#" target="_blank"> Drawing & Painting </a></h4>
                                    <p>Nam ullamcorper, diam sit amet euismod pelleontesque, eros risus rhoncus libero, inst tibulum nisl ligula....</p>
                                </div>
                                <div class="dt-sc-hr-very-small"></div>
                                <div class="dt-sc-ico-content type2">
                                    <div class="icon"> 
                                        <span class="fa fa-bullseye"> </span> 
                                    </div>
                                    <h4><a href="#" target="_blank"> Swimming Camp </a></h4>
                                    <p>Nam ullamcorper, diam sit amet euismod pelleontesque, eros risus rhoncus libero, inst tibulum nisl ligula....</p>
                                </div>
                            
                            </div>
                            <!--dt-sc-one-half ends-->
                            
                            <!--dt-sc-one-half starts-->
                            <div class="dt-sc-one-half column">
                                
                                <div class="dt-sc-ico-content type2">
                                    <div class="icon"> 
                                        <span class="fa fa-tachometer"> </span> 
                                    </div>
                                    <h4><a href="#" target="_blank"> Sports Camp </a></h4>
                                    <p>Nam ullamcorper, diam sit amet euismod pelleontesque, eros risus rhoncus libero, inst tibulum nisl ligula....</p>
                                </div>
                                <div class="dt-sc-hr-very-small"></div>
                                <div class="dt-sc-ico-content type2">
                                    <div class="icon"> 
                                        <span class="fa fa-magic"> </span> 
                                    </div>
                                    <h4><a href="#" target="_blank"> Personalizing </a></h4>
                                    <p>Nam ullamcorper, diam sit amet euismod pelleontesque, eros risus rhoncus libero, inst tibulum nisl ligula....</p>
                                </div>
                                <div class="dt-sc-hr-very-small"></div>
                                <div class="dt-sc-ico-content type2">
                                    <div class="icon"> 
                                        <span class="fa fa-music"> </span> 
                                    </div>
                                    <h4><a href="#" target="_blank"> Sing & Dance </a></h4>
                                    <p>Nam ullamcorper, diam sit amet euismod pelleontesque, eros risus rhoncus libero, inst tibulum nisl ligula....</p>
                                </div>
                            
                            </div>
                            <!--dt-sc-one-half ends-->
                        </div>
                        <!--dt-sc-one-half ends-->
                        
                        <!--dt-sc-one-half starts-->
                        <div class="dt-sc-one-half column">
                            <h2>With Music4Kids, music is child's play!</h2>
                            <div class="add-slider-wrapper">
                                <ul class="add-slider">
                                    <li> <img src="http://placehold.it/464x345" alt="" title=""> </li>
                                    <li> <img src="http://placehold.it/464x345" alt="" title=""> </li>
                                    <li> <img src="http://placehold.it/464x345" alt="" title=""> </li>
                                </ul>
                            </div>
                        </div>
                        <!--dt-sc-one-half ends-->
                    </div>
                    <!--container ends-->
                </section>
                <!--fullwidth-background ends-->
                <div class="dt-sc-hr"></div>
                <!--container starts-->
                <div class="container">
                    <h2 class="dt-sc-hr-green-title"><?=lang('our_staff')?></h2>
                    
                    <div class="column dt-sc-one-fourth first">
                        <div class="dt-sc-team">    
                            <div class="image">
                                <img class="item-mask" src="assets/images/mask.png" alt="" title="">
                                <img src="https://kidslifedev.wpengine.com/wp-content/uploads/2014/12/team2.jpg" alt="" title="">
                                <div class="dt-sc-image-overlay">
                                    <a href="#" class="link"><span class="fa fa-link"></span></a>
                                    <a href="#" class="zoom"><span class="fa fa-search"></span></a>
                                </div>
                            </div>
                            <div class="team-details">
                                <h4> Jack Daniels </h4>
                                <h6> Senior Supervisor </h6>
                                <p> Phasellus lorem augue, vulputate vel orci id, ultricies aliquet risus. </p>
                            </div>
                        </div>
                    </div>
                    <div class="column dt-sc-one-fourth">
                        <div class="dt-sc-team">    
                            <div class="image">
                                <img class="item-mask" src="assets/images/mask.png" alt="" title="">
                                <img src="https://kidslifedev.wpengine.com/wp-content/uploads/2014/12/team2.jpg" alt="" title="">
                                <div class="dt-sc-image-overlay">
                                    <a href="#" class="link"><span class="fa fa-link"></span></a>
                                    <a href="#" class="zoom"><span class="fa fa-search"></span></a>
                                </div>
                            </div>
                            <div class="team-details">
                                <h4> Linda Glendell </h4>
                                <h6> Teaching Professor </h6>
                                <p> Phasellus lorem augue, vulputate vel orci id, ultricies aliquet risus. </p>
                            </div>
                        </div>
                    </div>
                    <div class="column dt-sc-one-fourth">
                        <div class="dt-sc-team">    
                            <div class="image">
                                <img class="item-mask" src="assets/images/mask.png" alt="" title="">
                                <img src="https://kidslifedev.wpengine.com/wp-content/uploads/2014/12/team2.jpg" alt="" title="">
                                <div class="dt-sc-image-overlay">
                                    <a href="#" class="link"><span class="fa fa-link"></span></a>
                                    <a href="#" class="zoom"><span class="fa fa-search"></span></a>
                                </div>
                            </div>
                            <div class="team-details">
                                <h4> Kate Dennings </h4>
                                <h6> Children Diet </h6>
                                <p> Phasellus lorem augue, vulputate vel orci id, ultricies aliquet risus. </p>
                            </div>
                        </div>
                    </div>
                    <div class="column dt-sc-one-fourth">
                        <div class="dt-sc-team">    
                            <div class="image">
                                <img class="item-mask" src="assets/images/mask.png" alt="" title="">
                                <img src="https://kidslifedev.wpengine.com/wp-content/uploads/2014/12/team2.jpg" alt="" title="">
                                <div class="dt-sc-image-overlay">
                                    <a href="#" class="link"><span class="fa fa-link"></span></a>
                                    <a href="#" class="zoom"><span class="fa fa-search"></span></a>
                                </div>
                            </div>
                            <div class="team-details">
                                <h4> Kristof Slinghot </h4>
                                <h6> Management </h6>
                                <p> Phasellus lorem augue, vulputate vel orci id, ultricies aliquet risus. </p>
                            </div>
                        </div>
                    </div>
                
                </div>
                <!--container ends-->
                
                <div class="dt-sc-hr"></div>
                <!--fullwidth-background starts-->
                <section class="fullwidth-background dt-sc-parallax-section orange-bg">
                    <!--container starts-->
                    <div class="container">
                        <h2 class="dt-sc-hr-white-title"><?=lang('footer_row2_news')?></h2>
                        <?php foreach ($newsfooter as $key => $v):?>
                        <div class="column dt-sc-one-half">
                            <article class="blog-entry">
                                <div class="blog-entry-inner">
                                    <div class="entry-meta">
                                        <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>" class="blog-author"><img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$v->image ?>" alt="" title=""></a>
                                        <div class="date">
                                            <span> <?= date('d', strtotime($v->created))?> </span> 
                                            <p> <?= date('M', strtotime($v->created))?> <br> <?= date('Y', strtotime($v->created))?> </p> 
                                        </div>
                                        <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>" class="comments">
                                            12 <span class="fa fa-comment"> </span>
                                        </a>
                                        <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>" class="entry_format"><span class="fa fa-picture-o"></span></a>  
                                    </div>      
                                    <div class="entry-thumb">
                                        <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>"><img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$v->image ?>" alt="" title=""></a>
                                    </div>      
                                    <div class="entry-details"> 
                                        <div class="entry-title">
                                            <h3><a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>"> <?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?> </a></h3>
                                        </div>          
                                        <!--entry-metadata ends-->  
                                        <div class="entry-body">
                                            <p><?= $lang = $this->lang->lang(); $description = "description_".$lang; cutText($v->$description, 150) ?></p>
                                        </div>          
                                        <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>" class="dt-sc-button small"> <?=lang('btn_viewmore')?> <span class="fa fa-chevron-circle-right"> </span></a>      
                                    </div>  
                                </div>
                            </article>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <!--container ends-->    
                </section>
                <!--fullwidth-background ends-->
                <div class="dt-sc-hr"></div>

            </section>
            <!--primary ends-->
        </div>
        <!--main ends-->