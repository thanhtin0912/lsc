<!DOCTYPE HTML>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en-gb" class="no-js"> <!--<![endif]-->
<head>
<meta http-equiv="content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
<title>Kids Life- Home</title>
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<link href="<?= PATH_URL; ?>assets/css/frontend/style.css" rel="stylesheet" type="text/css">
<link href="<?= PATH_URL; ?>assets/css/frontend/shortcodes.css" rel="stylesheet" type="text/css">
<link href="<?= PATH_URL; ?>assets/css/frontend/responsive.css" rel="stylesheet" type="text/css">
<link href="<?= PATH_URL; ?>assets/css/frontend/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?= PATH_URL; ?>assets/css/frontend/shortcodes.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?= PATH_URL; ?>assets/css/frontend/layerslider.css" type="text/css">
<!--prettyPhoto-->
<link href="<?= PATH_URL; ?>assets/js/frontend/prettyPhoto.css" rel="stylesheet" type="text/css" media="all" />   

<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Bubblegum+Sans' rel='stylesheet' type='text/css'>
<!--jquery-->
<script src="<?= PATH_URL; ?>assets/js/frontend/modernizr-2.6.2.min.js"></script>
</head>
<body class="main">
	<!--wrapper starts-->
    <div class="wrapper">
        <!--header starts-->
        <header>
            <div class="container">
                <div class="logo">
                    <a href="index.html" title="Kids Life"><img src="<?= PATH_URL; ?>assets/images/logo.png" alt="Kids Life" title="Kids Life"></a>
                </div>
                <div class="contact-details">
                    <p class="mail">
                        <a href="#"><?=$info[0]->mail?></a>
                        <span class="fa fa-envelope"></span>
					</p>
                    <p class="phone-no">
                        <i>+(<?=$info[0]->phoneother?>)</i>
                        <span class="fa fa-phone"></span>
                	</p>        
                </div>
            </div>
            <!--menu-container starts-->
            <div id="menu-container">
                <div class="container">
                    <!--nav starts-->
                    <nav id="main-menu">
                    	<div class="dt-menu-toggle" id="dt-menu-toggle">Menu<span class="dt-menu-toggle-icon"></span></div>
                        <ul id="menu-main-menu" class="menu">
                            <li class="mustard"> <a href="<?= PATH_URL ?><?=$this->lang->lang();?>"><?=lang('menu_home')?></a> </li>
                            <li class="green"> <a href="<?= PATH_URL ?><?=$this->lang->lang();?>/about"><?=lang('menu_about')?></a></li>
                            <li class="blue"> <a href="<?= PATH_URL ?><?=$this->lang->lang();?>/course"><?=lang('menu_course')?></a></li>
                            <li class="yellow"> <a href="<?= PATH_URL ?><?=$this->lang->lang();?>/news"><?=lang('menu_news')?></a></li>    
                            <li class="lavender"><a href="<?= PATH_URL ?><?=$this->lang->lang();?>/document"><?=lang('menu_document')?></a></li>
                            <li class="pink"><a href="<?= PATH_URL ?><?=$this->lang->lang();?>/contact"><?=lang('menu_contact')?></a></li>
                        </ul>
                    </nav>
                    <!--nav ends-->

                    <ul class="dt-sc-social-icons">
                        <li><a href="<?=$info[0]->facebook?>" title="Facebook" class="dt-sc-tooltip-top facebook"><span class="fa fa-facebook"></span></a></li>
                        <li><a href="https://www.youtube.com/channel/UCYm-kGTw-1mp3kKbD7W_5NQ" title="Youtube" class="dt-sc-tooltip-top youtube"><span class="fa fa-youtube"></span></a></li>
                        <li><a href="<?= PATH_URL . $this->lang->switch_uri('en') ?>" title="English" class="dt-sc-tooltip-top"><img width="100%" src="<?= PATH_URL; ?>assets/images/en.png"></a></li>
                        <li><a href="<?= PATH_URL . $this->lang->switch_uri('vn') ?>" title="Vietnamese" class="dt-sc-tooltip-top "><img src="<?= PATH_URL; ?>assets/images/vn.png"></a></li>
                    </ul>
                </div>
            </div>
            <!--menu-container ends-->
        </header>
        <!--header ends-->
        <?= $content; ?>
            
        <!--footer starts-->
        <footer>
            <!--footer-widgets-wrapper starts-->
            <div class="footer-widgets-wrapper">
                <!--container starts-->
                <div class="container">
                    
                    <div class="column dt-sc-one-fourth first">
                        <aside class="widget widget_text">
                            <h3 class="widgettitle red_sketch"> About Kids Life </h3>
                            <p><a href=""><strong>Let's Start Center</strong></a> <?php $lang = $this->lang->lang(); $description = "description_".$lang; echo $info[0]->$description ?></p>
                            <ul>
                                <?php foreach ($services as $key => $v): ;?>
                                <li><a href="<?= PATH_URL ?><?=$this->lang->lang();?>/service/<?=$v->slug ?>"><?php $lang = $this->lang->lang(); $title = "title_".$lang; echo $v->$title ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </aside>
                    </div>
                    <div class="column dt-sc-one-fourth">
                        <aside class="widget widget_recent_entries">
                            <h3 class="widgettitle green_sketch"> <?=lang('footer_row2_news')?> </h3>
                            <ul>
                                <?php foreach ($newsfooter as $key => $v):?>
                                <li>
                                    <a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>">
                                        <img src="<?=PATH_URL.DIR_UPLOAD_NEWS.$v->image ?>" alt="">
                                    </a>    
                                    <h6><a href="<?=PATH_URL.$this->lang->lang().'/news-detail/'.$v->slug?>"> <?php $lang = $this->lang->lang(); $title = "title_".$lang; echo cutText($v->$title,60) ?> </a></h6>
                                    <span> <?= date('d/m/yy',strtotime($v->created))?></span>       
                                </li>
                                <?php endforeach ?>
                            </ul>
                        </aside>
                    </div>
                    <div class="column dt-sc-one-fourth">
                        <aside class="widget tweetbox">
                            <h3 class="widgettitle yellow_sketch"><a href="#"> Facebook </a></h3>
                            <div class="fb-page" data-href="https://www.facebook.com/kynangsong.ngoaingu.LS/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/kynangsong.ngoaingu.LS/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/kynangsong.ngoaingu.LS/">Kỹ Năng Sống Và Ngoại Ngữ Lets Start Nha Trang</a></blockquote>
                            </div>
                        </aside>
                    </div>
                    <div class="column dt-sc-one-fourth">
                        <aside class="widget widget_text">
                        <h3 class="widgettitle steelblue_sketch">Contact</h3>
                            <div class="textwidget">
                                <p class="dt-sc-contact-info"><span class="fa fa-map-marker"></span> <?php $lang = $this->lang->lang(); $address = "address_".$lang; echo $info[0]->$address ?> </p>
                                <p class="dt-sc-contact-info"><span class="fa fa-phone"></span> <?=$info[0]->phoneother?> </p>
                                <p class="dt-sc-contact-info"><span class="fa fa-envelope"></span><a href="mailto:<?=$info[0]->mail?>"> <?=$info[0]->mail?> </a></p>
                            </div>
                        </aside>
                        <aside class="widget mailchimp">
                            <p> We're social </p>
                            <form name="frmnewsletter" class="mailchimp-form" action="php/subscribe.php" method="post">
                                <p>
                                    <span class="fa fa-envelope-o"> </span>
                                    <input type="email" placeholder="Email Address" name="mc_email" required />	
                                </p>	
                                <input type="submit" value="Subscribe" class="button" name="btnsubscribe">
                            </form>
                            <div id="ajax_subscribe_msg"></div>
                        </aside>
                    </div>
                    
                </div>    
                <!--container ends-->
            </div>
            <!--footer-widgets-wrapper ends-->  
            <div class="copyright">
        		<div class="container">
                	<p class="copyright-info">© 2014 Kids Life. All rights reserved. Design by <a href="http://themeforest.net/user/designthemes" title=""> thanhtin0912@gmail.com </a></p>
        			<div class="footer-links">
                        <p>Follow us</p>
                        <ul class="dt-sc-social-icons">
                        	<li class="facebook"><a href="#"><img src="assets/images/facebook.png" alt="" title=""></a></li>
                            <li class="twitter"><a href="#"><img src="assets/images/twitter.png" alt="" title=""></a></li>
                            <li class="gplus"><a href="#"><img src="assets/images/gplus.png" alt="" title=""></a></li>
                            <li class="pinterest"><a href="#"><img src="assets/images/pinterest.png" alt="" title=""></a></li>
                        </ul>
                    </div>
        		</div>
        	</div>  
        </footer>
        <!--footer ends-->
        
    </div>
    <!--wrapper ends-->
    <a href="" title="Go to Top" class="back-to-top">To Top ↑</a>
    <!--Java Scripts-->
    <script type="text/javascript">
        var root = '<?=PATH_URL?>';
        var csrf_token;
    </script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0&appId=589670775117215&autoLogAppEvents=1"></script>
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.js"></script>
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery-migrate.min.js"></script>

    
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery-easing-1.3.js"></script>
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.sticky.js"></script>
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.inview.js"></script>
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/validation.js"></script>
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.tipTip.minified.js"></script>
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.bxslider.min.js"></script>       
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.prettyPhoto.js"></script>  
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/twitter/jquery.tweet.min.js"></script>
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.parallax-1.1.3.js"></script>   
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/shortcodes.js"></script>   
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/custom.js"></script>
     
    <!-- Layer Slider --> 
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery-transit-modified.js"></script> 
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/layerslider.kreaturamedia.jquery.js"></script> 
    <script type='text/javascript' src="<?= PATH_URL; ?>assets/js/frontend/greensock.js"></script> 
    <script type='text/javascript' src="<?= PATH_URL; ?>assets/js/frontend/layerslider.transitions.js"></script> 
    <script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.carouFredSel-6.2.0-packed.js"></script>  
    <!--<script type="text/javascript">var lsjQuery = jQuery;</script>--> 
    <script type="text/javascript">var lsjQuery = jQuery;</script><script type="text/javascript"> lsjQuery(document).ready(function() { if(typeof lsjQuery.fn.layerSlider == "undefined") { lsShowNotice('layerslider_1','jquery'); } else { lsjQuery("#layerslider_4").layerSlider({responsiveUnder: 1240, layersContainer: 1060, skinsPath: '<?= PATH_URL; ?>assets/js/frontend/layerslider/skins/'}) } }); </script>
    <script type="text/javascript">
        var root = '<?=PATH_URL?>';
        var csrf_token;
    </script>
</body>
</html>