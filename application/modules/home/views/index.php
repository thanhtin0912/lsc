        <!--main starts-->
        <script>
            window.jssor_1_slider_init = function() {
                var jssor_1_SlideoTransitions = [
                    [{
                        b: -1,
                        d: 1,
                        ls: 0.5
                    }, {
                        b: 0,
                        d: 1000,
                        y: 5,
                        e: {
                            y: 6
                        }
                    }],
                    [{
                        b: -1,
                        d: 1,
                        ls: 0.5
                    }, {
                        b: 200,
                        d: 1000,
                        y: 25,
                        e: {
                            y: 6
                        }
                    }],
                    [{
                        b: -1,
                        d: 1,
                        ls: 0.5
                    }, {
                        b: 400,
                        d: 1000,
                        y: 45,
                        e: {
                            y: 6
                        }
                    }],
                    [{
                        b: -1,
                        d: 1,
                        ls: 0.5
                    }, {
                        b: 600,
                        d: 1000,
                        y: 65,
                        e: {
                            y: 6
                        }
                    }],
                    [{
                        b: -1,
                        d: 1,
                        ls: 0.5
                    }, {
                        b: 800,
                        d: 1000,
                        y: 85,
                        e: {
                            y: 6
                        }
                    }],
                    [{
                        b: -1,
                        d: 1,
                        ls: 0.5
                    }, {
                        b: 500,
                        d: 1000,
                        y: 195,
                        e: {
                            y: 6
                        }
                    }],
                    [{
                        b: 0,
                        d: 2000,
                        y: 30,
                        e: {
                            y: 3
                        }
                    }],
                    [{
                        b: -1,
                        d: 1,
                        rY: -15,
                        tZ: 100
                    }, {
                        b: 0,
                        d: 1500,
                        y: 30,
                        o: 1,
                        e: {
                            y: 3
                        }
                    }],
                    [{
                        b: -1,
                        d: 1,
                        rY: -15,
                        tZ: -100
                    }, {
                        b: 0,
                        d: 1500,
                        y: 100,
                        o: 0.8,
                        e: {
                            y: 3
                        }
                    }],
                    [{
                        b: 500,
                        d: 1500,
                        o: 1
                    }],
                    [{
                        b: 0,
                        d: 1000,
                        y: 380,
                        e: {
                            y: 6
                        }
                    }],
                    [{
                        b: 300,
                        d: 1000,
                        x: 80,
                        e: {
                            x: 6
                        }
                    }],
                    [{
                        b: 300,
                        d: 1000,
                        x: 330,
                        e: {
                            x: 6
                        }
                    }],
                    [{
                        b: -1,
                        d: 1,
                        r: -110,
                        sX: 5,
                        sY: 5
                    }, {
                        b: 0,
                        d: 2000,
                        o: 1,
                        r: -20,
                        sX: 1,
                        sY: 1,
                        e: {
                            o: 6,
                            r: 6,
                            sX: 6,
                            sY: 6
                        }
                    }],
                    [{
                        b: 0,
                        d: 600,
                        x: 150,
                        o: 0.5,
                        e: {
                            x: 6
                        }
                    }],
                    [{
                        b: 0,
                        d: 600,
                        x: 1140,
                        o: 0.6,
                        e: {
                            x: 6
                        }
                    }],
                    [{
                        b: -1,
                        d: 1,
                        sX: 5,
                        sY: 5
                    }, {
                        b: 600,
                        d: 600,
                        o: 1,
                        sX: 1,
                        sY: 1,
                        e: {
                            sX: 3,
                            sY: 3
                        }
                    }]
                ];
                var jssor_1_options = {
                    $AutoPlay: 1,
                    $LazyLoading: 1,
                    $CaptionSliderOptions: {
                        $Class: $JssorCaptionSlideo$,
                        $Transitions: jssor_1_SlideoTransitions
                    },
                    $ArrowNavigatorOptions: {
                        $Class: $JssorArrowNavigator$
                    },
                    $BulletNavigatorOptions: {
                        $Class: $JssorBulletNavigator$,
                        $SpacingX: 20,
                        $SpacingY: 20
                    }
                };
                var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
                var MAX_WIDTH = 1920;

                function ScaleSlider() {
                    var containerElement = jssor_1_slider.$Elmt.parentNode;
                    var containerWidth = containerElement.clientWidth;
                    if (containerWidth) {
                        var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
                        jssor_1_slider.$ScaleWidth(expectedWidth);
                    } else {
                        window.setTimeout(ScaleSlider, 30);
                    }
                }
                ScaleSlider();
                $Jssor$.$AddEvent(window, "load", ScaleSlider);
                $Jssor$.$AddEvent(window, "resize", ScaleSlider);
                $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
                /*#endregion responsive code end*/
            };
        </script>
        <div id="main">
            <div class="wrapper">
                <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1600px;height:560px;overflow:hidden;visibility:hidden;">
                    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1600px;height:560px;overflow:hidden;">
                        <?php foreach ($banner as $key => $banner) :; ?>
                            <div>
                                <a href="<?= $banner->url ?>"><img data-u="image" data-src="<?= PATH_URL . DIR_UPLOAD_BANNER . $banner->image ?>" src="<?= PATH_URL . DIR_UPLOAD_BANNER . $banner->image ?>" /></a>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <!-- Bullet Navigator -->
                    <div data-u="navigator" class="jssorb132" style="position:absolute;bottom:24px;right:16px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                        <div data-u="prototype" class="i" style="width:12px;height:12px;">
                            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                            </svg>
                        </div>
                    </div>
                    <!-- Arrow Navigator -->
                    <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                        </svg>
                    </div>
                    <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                        </svg>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                jssor_1_slider_init();
            </script>
            <!--primary starts-->
            <section id="primary" class="content-full-width">
                <!--container starts-->
                <div class="container">
                    <h2 class="dt-sc-hr-green-title"> <?= lang('menu_course') ?> </h2>
                    <?php foreach ($services as $key => $v) :; ?>
                        <div class="column dt-sc-one-third pb-3">
                            <div class="activity <?php if (($key % 2) == 1) {
                                                        echo 'box1';
                                                    } else {
                                                        echo 'box4';
                                                    } ?>">
                                <a href="<?= PATH_URL . $this->lang->lang() . '/service/' . $v->slug ?>"><img src="<?= PATH_URL . DIR_UPLOAD_SERVICES . $v->image ?>" alt="" title=""></a>
                                <h4><?php $lang = $this->lang->lang();
                                    $title = "title_" . $lang;
                                    echo $v->$title ?></h4>
                                <p class="pt-3"><?php $lang = $this->lang->lang();
                                                $description = "description_" . $lang;
                                                echo $v->$description ?></p>
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
                        <h2 class="dt-sc-hr-white-title"><?= lang('btn_contact') ?></h2>
                        <div class="admission-form p-3" novalidate="novalidate">
                            <p class="dt-sc-one-fourth column first">
                                <input id="txtName" type="text" placeholder="Name">
                            </p>
                            <p class="dt-sc-one-fourth column">
                                <input id="txtPhone" type="text" placeholder="Phone">
                            </p>
                            <p class="dt-sc-one-fourth column">
                                <input id="txtOld" type="text" placeholder="Tuổi">
                            </p>
                            <p class="dt-sc-one-fourth column">
                                <input id="txtMail" type="text" placeholder="Mail">
                            </p>
                            <div id="ajax_admission_msg"> </div>
                            <p class="aligncenter pt-3">
                                <input class="px-5" name="submit" type="submit" onclick="contact()" value="<?= lang('btn_contact') ?>">
                            </p>
                        </div>
                    </div>
                </section>
                <!--fullwidth-background ends-->
                <div class="dt-sc-hr"></div>
                <div class="container">
                    <h2 class="dt-sc-hr-green-title"><?= lang('our_activities') ?></h2>
                    
                    <!--portfolio-content starts-->
                    <div class="front-portfolio-container">
                    
                        <?php foreach ($comments as $key => $v) : ?>
                       <div class="portfolio-content portfolio-content<?=$key+1 ?>">
                           <div class="front-portfolio">
                              <div class="portfolio-outer">
                                  <div class="portfolio-thumb">
                                  	  <img src="<?= PATH_URL . DIR_UPLOAD_COMMENTS . $v->image ?>" alt="" title="">
                                      <div class="image-overlay">
                                        <a href="<?= PATH_URL . DIR_UPLOAD_COMMENTS . $v->image ?>" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                                    </div>
                                  </div>
                              </div>
                           </div>
                       </div>
                       <?php endforeach ?>
                    </div>
                    <!--front-portfolio-container ends-->
                </div>
                
                <div class="dt-sc-hr"></div>
                <!--fullwidth-background starts-->
                <section class="fullwidth-background dt-sc-parallax-section turquoise-bg mb-5">
                    <!--container starts-->
                    <div class="container">
                        <div class="dt-sc-one-half column first px-2">
                            <h2>What do we teach?</h2>
                                
                            <div class="dt-sc-ico-content type2">
                                <div class="icon"> 
                                    <span> 1 </span> 
                                </div>
                                <h4><a href="#" target="_blank">Ngôn ngữ phổ biến</a></h4>
                                <p>Xu hướng ngày nay là kinh tế hội nhập toàn cầu , có 53 quốc gia trên thế giới sử dụng tiếng Anh là ngôn ngữ chính thức. Nên tiếng Anh được lựa chọn là ngôn ngữ chung để các luồng thông tin dễ dàng tiếp nhận hơn.</p>
                            </div>
                            <div class="dt-sc-hr-very-small"></div>
                            <div class="dt-sc-ico-content type2">
                                <div class="icon"> 
                                    <span> 2 </span> 
                                </div>
                                <h4><a href="#" target="_blank">Tốt nhất để bắt đầu</a></h4>
                                <p>Theo các nhà nghiên cứu, não bộ sẽ hoạt động và phát triển tốt hơn khi vận động liên tục .Trẻ học ngôn ngữ giúp tăng cường khả năng ghi nhớ vốn từ vựng, giúp tăng cường phát triển cơ thần kinh . </p>
                            </div>
                            <div class="dt-sc-hr-very-small"></div>
                            <div class="dt-sc-ico-content type2">
                                <div class="icon"> 
                                    <span> 3 </span> 
                                </div>
                                <h4><a href="#" target="_blank">Tư duy toàn diện</a></h4>
                                <p>Học tiếng Anh sớm, trẻ sẽ biết cách liên kết các sự vật, sự việc liên quan khi gặp tình huống ngoài xã hội và chọn cách giải quyết tình huống phù hợp .Chỉ số IQ, EQ của trẻ học tốt tiếng Anh cao hơn đáng kể, khả năng giải quyết các tình huống phức tạp nhanh hơn và tốt hơn trẻ khác.</p>
                            </div>
                        
                            
                            <div class="dt-sc-ico-content type2">
                                <div class="icon"> 
                                    <span> 4 </span> 
                                </div>
                                <h4><a href="#" target="_blank">Phát triển mọi kỹ năng</a></h4>
                                <p>Trẻ học tiếng Anh sẽ tiếp xúc nhiều thông tin thú vị, trẻ sẽ biết cách quan tâm đến điều mình thích và thể hiện những lĩnh vực không yêu thích .Giúp trẻ tìm ra ưu điểm để phát triển và khuyết điểm để bồi dưỡng, xem trẻ phù hợp với lĩnh vực nào và chọn giải pháp học tập để con phát huy khả năng , gia tăng hiểu biết lựa chọn nghề nghiệp tương lai. </p>
                            </div>
                        </div>

                        <div class="dt-sc-one-half column">
                            <h2>Học viên sẽ nhận được những gì ?</h2>
                            <video class="video-fluid w-100" loop controls muted>
                                <source src="<?= PATH_URL .'/assets/video/demo.mp4' ?>" type="video/mp4" height="400" />
                            </video>
                        </div>
                    </div>
                    <!--container ends-->
                </section>
                <!--fullwidth-background ends-->
                <div class="container">
                    <h2 class="dt-sc-hr-green-title"><?= lang('our_staff') ?></h2>
                    <section id="primary" class="content-full-width pb-3">
                        
                        <?php foreach ($staffs as $key => $v) : ?>
                        <div class="column dt-sc-one-fourth first">
                            <div class="dt-sc-team">	
                                <div class="image">
                                    <img class="item-mask" src="<?= PATH_URL?>assets/images/mask.png" title="<?= $v->name ?>">
                                    <img src="<?= PATH_URL . DIR_UPLOAD_STAFF . $v->image ?>" title="<?= $v->name ?>">
                                </div>
                                <div class="team-details">
                                    <h4> <?= $v->name ?> </h4>
                                    <h6> <?= $v->position ?> </h6>
                                    <p><?php $lang = $this->lang->lang(); $description = "description_" . $lang; echo $v->$description ?>  </p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </section>
                </div>
                <!--fullwidth-background starts-->
                <section class="fullwidth-background dt-sc-parallax-section turquoise-bg">
                    <!--container starts-->
                    <div class="container">
                        <h2 class="dt-sc-hr-white-title"><?= lang('footer_row2_news') ?></h2>
                        <div class="content-full-width">
                            <?php foreach ($news as $key => $v) : ?>
                                <div class="column dt-sc-one-half">
                                    <article class="blog-entry">
                                        <div class="p-3">
                                            <div class="entry-thumb">
                                                <a href="<?= PATH_URL . $this->lang->lang() . '/news-detail/' . $v->slug ?>"><img src="<?= resizeImage(PATH_URL . DIR_UPLOAD_NEWS . $v->image, 700 , 400) ?>" alt="" title=""></a>
                                            </div>
                                            <div class="entry-details">
                                                <div class="entry-title">
                                                    <h3><?php $lang = $this->lang->lang();
                                                        $title = "title_" . $lang;
                                                        echo $v->$title ?></h3>
                                                </div>
                                                <!--entry-metadata ends-->
                                                <div class="entry-body">
                                                    <p><?php $lang = $this->lang->lang();  $description = "description_" . $lang; echo $v->$description ?></p>
                                                </div>
                                                <a href="<?= PATH_URL . $this->lang->lang() . '/news-detail/' . $v->slug ?>" class="dt-sc-button small"> <?= lang('btn_viewmore') ?> <span class="fa fa-chevron-circle-right"> </span></a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endforeach ?>
                        </div>

                    </div>
                    <!--container ends-->
                </section>
                <!--fullwidth-background ends-->
            </section>
            <!--primary ends-->
        </div>
        <!--main ends-->