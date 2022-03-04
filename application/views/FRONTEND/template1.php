<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>

    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- master stylesheet -->
    <link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/style.css">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/responsive.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= PATH_URL; ?>assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?= PATH_URL; ?>assets/images/favicon/apple-touch-icon.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?= PATH_URL; ?>assets/images/favicon/apple-touch-icon.png" sizes="16x16">
    <!-- main jQuery -->
    <script src="<?= PATH_URL; ?>assets/js/frontend/jquery-1.11.1.min.js"></script>
    <!-- Fixing Internet Explorer-->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="js/html5shiv.js"></script>
    <![endif]-->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=281639632256185&autoLogAppEvents=1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
</head>
<body>
    <input type="hidden" value="<?=$this->security->get_csrf_hash()?>" id="csrf_token" />
    <section class="top-bar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <!--Start contact info left-->
                    <div class="contact-info-left clearfix">
                        <ul>
                            <li><span class="flaticon-technology"></span>+ (<?=$info[0]->phone?>)</li>
                            <li><span class="flaticon-new-email-outline envelop"></span><?=$info[0]->mail?></li>
                        </ul>
                    </div>
                    <!--End contact info left-->    
                </div>
                <div class="col-lg-5 col-md-5">
                    <!--Start contact info right-->
                    <div class="contact-info-right">
                        <div class="top-social-links">
                            <ul>
                                <li><a href="<?= PATH_URL . $this->lang->switch_uri('en') ?>" title="<?=lang('top_en')?>"><i id=en ></i></a></li>
                                <li><a href="<?= PATH_URL . $this->lang->switch_uri('vn') ?>" title="<?=lang('top_vn')?>"><i id=es></i></a></li>
                                <li><a href="<?=$info[0]->facebook?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!--End contact info right--> 
                </div>
            </div>
        </div>
    </section>

    <!--Start header-search  area-->
    <section class="header-search">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <!-- <div class="search-form pull-right">
                        <div class="search">
                            <input type="search" name="search" value="" placeholder="Search Something">
                            <button type="submit"><span class="icon fa fa-search"></span></button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!--End header-search  area-->  

    <!--Start header area-->
    <header class="header-area stricky">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="outer-box clearfix">
                        <!--Start logo-->
                        <div class="logo">
                            <a href="<?= PATH_URL ?><?=$this->lang->lang();?>/">
                                <img src="<?= PATH_URL; ?>assets/images/resources/logo.png" alt="Awesome Logo">
                            </a>
                        </div>
                        <!--Start mainmenu-->
                        <nav class="main-menu">
                            <div class="navbar-header">     
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse clearfix">
                                <ul class="navigation clearfix">
                                    <li class="home"><a href="<?= PATH_URL ?><?=$this->lang->lang();?>"><?=lang('menu_home')?></a></li>
                                    <li class="about"><a href="<?= PATH_URL ?><?=$this->lang->lang();?>/about"><?=lang('menu_about')?></a></li>
                                    <li class="product dropdown"><a href="<?= PATH_URL ?><?=$this->lang->lang();?>/products"><?=lang('menu_products')?></a>
                                        <ul>
                                            <?php foreach ($cataparent as $key => $p): ;?>
                                            <li class="dropdown"><a href="project-grid-v1.html"><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $p->$name ?></a>
                                                <ul>
                                                    <?php foreach ($cataproduct as $key => $c): ;?> 
                                                    <?php if ($c->type==$p->id) { ?>
                                                    <li><a href="<?=PATH_URL.$this->lang->lang().'/cata/'.$c->slug ?>"><?php $lang = $this->lang->lang(); $title = "name_".$lang; echo $c->$name ?></a></li>
                                                    <?php } ?>
                                                    <?php endforeach ?> 
                                                </ul>
                                            </li>
                                            <?php endforeach ?> 
                                        </ul>
                                    </li>
                                    <li class="dropdown service"><a href="javascript:void(0);"><?=lang('menu_service')?></a>
                                        <ul>
                                            <?php if ($services!='') { ?>
                                            <?php foreach ($services as $key => $v): ;?>
                                            <li><a href="<?= PATH_URL ?><?=$this->lang->lang();?>/service/<?=$v->slug ?>"><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?></a></li>
                                            <?php endforeach ?>
                                            <?php }else{ ?> 
                                            <li><a href="">No services</a></li>
                                            <?php }?>
                                        </ul>
                                    </li>
                                    <li class="news"><a href="<?= PATH_URL ?><?=$this->lang->lang();?>/news"><?=lang('menu_news')?></a></li>
                                    <li class="contact"><a href="<?= PATH_URL ?><?=$this->lang->lang();?>/contact"><?=lang('menu_contact')?></a></li>
                                </ul>
                            </div>
                        </nav>
                        <!--End mainmenu-->
                    </div>
                </div>
            </div>
        </div>
    </header>  
    <!--End header area-->     

    <?= $content; ?>

     
      
    <!--Start footer area-->  
    <footer class="footer-area">
        <div class="container">
            <div class="row">
                <!--Start single footer widget-->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="single-footer-widget pd-bottom">
                       <div class="title">
                            <h3><?=lang('menu_about')?></h3>
                        </div>
                        <div class="interrio-info">
                            <p><?php $lang = $this->lang->lang(); $description = "description_".$lang; echo $info[0]->$description ?></p>
                        </div>
                        <ul class="footer-contact-info">
                            <li>
                                <div class="icon-holder">
                                    <span class="flaticon-building"></span>
                                </div>
                                <div class="text-holder">
                                    <p><?php $lang = $this->lang->lang(); $address = "address_".$lang; echo $info[0]->$address ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon-holder">
                                    <span class="flaticon-technology"></span>
                                </div>
                                <div class="text-holder">
                                    <p>+ (<?=$info[0]->phone?>)</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon-holder">
                                    <span class="flaticon-e-mail-envelope"></span>
                                </div>
                                <div class="text-holder">
                                    <p><?=$info[0]->mail?></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon-holder time">
                                    <span class="flaticon-clock"></span>
                                </div>
                                <div class="text-holder">
                                    <p>Thứ 2 - thứ 7 từ 08.00 đến 17.00<br> chủ nhật nghỉ</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--End single footer widget-->
                <!--Start single footer widget-->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="single-footer-widget pd-bottom">
                        <div class="title">
                            <h3><?=lang('footer_row2_news')?></h3>
                        </div>
                        <ul class="popular-news clearfix">
                            <?php foreach ($newsfooter as $key => $v):?>
                            <li class="single-popular-news-item clearfix">
                                <div class="img-holder">
                                    <img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$v->image ?>" alt="<?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?>">
                                    <div class="overlay">
                                        <div class="box">
                                            <div class="content">
                                                <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-holder">
                                    <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>">
                                        <p><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?></p>
                                    </a>
                                    <ul class="info">
                                        <li>by admin</li>
                                        <li><?php $date = $v->created ;echo date("d/m/Y", strtotime($date)); ?></li>  
                                    </ul>    
                                </div>
                            </li>

                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <!--End single footer widget-->
                <!--Start single footer widget-->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="single-footer-widget pd-bottom">
                        <div class="title">
                            <h3>Danh mục</h3>
                        </div>
                        <style type="text/css">
                            .single-footer-widget .subscribe-form .copyright-text > p > a {
                              color: #fff;
                            }
                            .single-footer-widget .subscribe-form .copyright-text > p > a:hover {
                              color: #57b6e6;
                            }
                        </style>
                        <div class="subscribe-form">
                            <div class="copyright-text">
                                <p>
                                    <?php foreach ($cataproduct as $key => $v): ;?>
                                        <a href="<?=PATH_URL.$this->lang->lang().'/cata/'.$v->slug?>"><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $v->$name ?></a> |
                                    <?php endforeach ?>
                                </p>
                            </div>   
                        </div>
                    </div>
                </div>
                <!--End single footer widget-->
            </div>
        </div>
    </footer>   
    <!--End footer area--> 

    <!--Start footer bottom area-->   
    <section class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="copyright-text">
                        <p>Design and develop-by <a href="#"><?=$info[0]->mail?></a></p>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="footer-menu">
                        <ul>
                            <li><a href="https://www.facebook.com/huongvietnhatrang/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>    
        </div>
    </section>    
    <!--End footer bottom area-->


    <!-- bootstrap -->
    <script src="<?= PATH_URL; ?>assets/js/frontend/bootstrap.min.js"></script>
    <!-- bx slider -->
    <script src="<?= PATH_URL; ?>assets/js/frontend/jquery.bxslider.min.js"></script>
    <!-- count to -->
    <script src="<?= PATH_URL; ?>assets/js/frontend/jquery.countTo.js"></script>
    <!-- owl carousel -->
    <script src="<?= PATH_URL; ?>assets/js/frontend/owl.carousel.min.js"></script>
    <!-- validate -->
    <script src="<?= PATH_URL; ?>assets/js/frontend/validate.js"></script>
    <!-- mixit up -->
    <script src="<?= PATH_URL; ?>assets/js/frontend/jquery.mixitup.min.js"></script>
    <!-- easing -->
    <script src="<?= PATH_URL; ?>assets/js/frontend/jquery.easing.min.js"></script>
    <!-- gmap helper -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHzPSV2jshbjI8fqnC_C4L08ffnj5EN3A"></script>
    <!--gmap script-->
    <script src="<?= PATH_URL; ?>assets/js/frontend/gmaps.js"></script>
    <script src="<?= PATH_URL; ?>assets/js/frontend/map-helper-2.js"></script>
    <!-- video responsive script -->    
    <script src="<?= PATH_URL; ?>assets/js/frontend/jquery.fitvids.js"></script>
    <!-- jQuery ui js -->
    <script src="<?= PATH_URL; ?>assets/plugins/jquery-ui-1.11.4/jquery-ui.js"></script>
    <!-- Language Switche  -->
    <script src="<?= PATH_URL; ?>assets/plugins/language-switcher/jquery.polyglot.language.switcher.js"></script>
    <!-- fancy box -->
    <script src="<?= PATH_URL; ?>assets/js/frontend/jquery.fancybox.pack.js"></script>
    <script src="<?= PATH_URL; ?>assets/js/frontend/jquery.appear.js"></script>
    <!-- isotope script-->
    <script src="<?= PATH_URL; ?>assets/js/frontend/isotope.js"></script>
    <script src="<?= PATH_URL; ?>assets/js/frontend/jquery.prettyPhoto.js"></script>            
    <script src="<?= PATH_URL; ?>assets/js/frontend/jquery.flexslider.js"></script>  
    <!-- Bootstrap Touchspin -->
    <script src="<?= PATH_URL; ?>assets/js/frontend/jquery.bootstrap-touchspin.js"></script>
    <!-- Price Filter script -->
    <script src="<?= PATH_URL; ?>assets/plugins/price-filter/nouislider.js"></script>            
    <!-- revolution slider js -->
    <script src="<?= PATH_URL; ?>assets/plugins/timepicker/timePicker.js"></script>
    <script src="<?= PATH_URL; ?>assets/plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="<?= PATH_URL; ?>assets/plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script src="<?= PATH_URL; ?>assets/plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="<?= PATH_URL; ?>assets/plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
    <script src="<?= PATH_URL; ?>assets/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="<?= PATH_URL; ?>assets/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="<?= PATH_URL; ?>assets/plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script src="<?= PATH_URL; ?>assets/plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="<?= PATH_URL; ?>assets/plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="<?= PATH_URL; ?>assets/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="<?= PATH_URL; ?>assets/plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>



    <!-- thm custom script -->
    <script src="<?= PATH_URL; ?>assets/js/frontend/custom.js"></script>


    <script type="text/javascript">
        var root = '<?=PATH_URL?>';
        var csrf_token;
    </script>

</body>
</html>