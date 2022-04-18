        <!--main starts-->
        <div id="main">
            <!--breadcrumb-section starts-->
            <div class="breadcrumb-section">
                <div class="container">
                    <div class="breadcrumb">
                        <a href="<?=PATH_URL.$this->lang->lang();?>/"><?=lang('menu_home')?></a>
                        <span class="fa fa-angle-double-right"></span>
                        <span class="current"><?=lang('menu_about')?></span>
                    </div>
                </div>
            </div>
            <div class="container">
            	<section id="primary">
                    <div class="content-full-width p-5">
                        <div class="dt-sc-one-half column first">
                            <div class="author-details">
                                <div class="author-thumb">
                                    <img class="item-mask" src="https://wedesignthemes.com/html/kidslife/images/author-hexa-bg.png" alt="" title="">
                                    <img src="https://wedesignthemes.com/html/kidslife/images/founder.jpg">
                                </div>
                                <div class="author-description">
                                    <h5><a href="">Ms Thuong</a></h5>
                                    <span class="author-role">  <a href="#">CEO & Founder </a></span>
                                    <p>Phasellus lorem augue, vulputate vel orci id, ultricies aliquet risus. Sed cursus ipsum vitae justo scelerisque, ac viverra tellus eleifend. Etiam interdum justo nunc, ac volutpat erat elementum id. Fusce dapibus mauris ac dictum porta. Sed pretium luctus elementum. In sollicitudin felis semper purus imperdiet lobortis. In odio tellus, rhoncus eget dolor in, </p>
                                </div>
                            </div>
                        </div>      
                        <div class="dt-sc-one-half column"> 
                            <div class="dt-sc-testimonial-carousel-wrapper">
                                <ul class='dt-sc-testimonial-carousel'> 
                                    <li>
                                        <div class='dt-sc-testimonial'>
                                            <blockquote><q>Let’s Start luôn đưa ra nhiều phương pháp giảng dạy mới nhằm truyền đạt những kiến thức bổ ích, vừa học vừa vui tạo hứng thú cho học sinh tránh nhàm chán và đem lại một kết quả hiệu quả nhất. Với những thành tích tối ưu của Trung tâm thì đã nhận được sự tin tưởng của nhiều phụ huynh và học sinh. Nhiều em trong số đó đã đạt nhiều thành tích tốt trong kỳ thi Cambridge.</q></blockquote>

                                            <div class="author-meta">
                                                <p> PHƯƠNG PHÁP GIẢNG DẠY </p>
                                                <span class="author-rating rating-5"></span>
                                            </div>        
                                        </div>
                                    </li>
                                    <li>
                                        <div class='dt-sc-testimonial'>
                                            <blockquote><q>Đội ngũ giảng viên tại Let’s Start gồm giáo viên bản ngữ và giáo viên Việt Nam đều được đào tạo chuyên môn Sư phạm Tiếng Anh. Cùng với sự nhiệt huyết với nghề và yêu mến học sinh, các GV ở Trung tâm luôn truyền tải nhiều kiến thức cho học viên trong một môi trường năng động nhằm đưa đến một kết quả tốt nhất.</q></blockquote>
                                            <div class="author-meta">
                                                <p> ĐỘI NGŨ GIÁO VIÊN </p>
                                                <span class="author-rating rating-5"></span>
                                            </div>        
                                        </div>
                                    </li>
                                </ul>
                                <div class="carousel-arrows">	
                                    <a href="#" class="testimonial-prev"><span class="fa fa-angle-left"></span></a>	
                                    <a href="#" class="testimonial-next"><span class="fa fa-angle-right"></span></a>
                                </div>
                            </div>
                        </div>      
                    </div>
                </section>
                <section class="content-full-width">
                    <h2 class="dt-sc-hr-green-title"><?= lang('our_staff') ?></h2>
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
                                <p> Phasellus lorem augue, vulputate vel orci id, ultricies aliquet risus. </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </section>
                <!--primary ends-->
            </div>
            <!--container ends-->
        </div>
        <!--main ends-->