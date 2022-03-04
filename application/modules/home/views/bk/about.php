<style type="text/css">
    .main-menu .navigation > li:hover > a, .main-menu .navigation > li.about > a {
      color: #006699;
      opacity: 1;
    }
</style>
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style='background-image: url(<?= PATH_URL ?>assets/images/breadcrumb/breadcrumb-bg.jpg);'>
	<div class="container-fluid text-center">
		<h1><?=lang('menu_about')?></h1>
		<div class="breadcrumb-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left pull-left">
                            <ul>
                                <li><a href="<?=$this->lang->lang();?>/"><?=lang('menu_home')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><?=lang('menu_about')?></li>
                            </ul>    
                        </div>  
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>
<!--End breadcrumb area--> 
<?php $lang = $this->lang->lang(); $content = "content_".$lang; echo $pages[0]->$content ?>
<!-- <section class="about-interrio-area">
    <div class="container">
        <div class="sec-title">
            <h2>Huong J.S.C <span>Company</span></h2>
            <span class="decor"></span>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="text-holder">
                    <h3>Design and Construction Consultant Joint Stock Company Huong Viet</h3>
                    <p>With a team of architects, engineers, experienced staff, high skill has quickly completed the organizational system, management process, research and application of new technology for design work, The quality of products and services; meet the highest demands of customers.</p>
                    <div class="signature-and-name">
                        <div class="signature">
                            <img src="http://localhost:88/huongviet/assets/images/about/signature.png" alt="Signature">
                        </div>
                        <div class="name">
                            <h4>Mr.Trung,</h4>
                            <p>CEO & Founder</p>
                        </div>
                    </div>   
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-item">
                    <div class="img-holder">
                        <img src="http://localhost:88/huongviet/assets/images/about/mission.jpg" alt="Awesome Image">
                        <div class="overlay">
                            <div class="box">
                                <div class="content">
                                    <a href="services-single.html"><i class="fa fa-link" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-box">
                        <h3> Design Consultant</h3>
                         <ul>
                             <li>General planning design, detail. </li>
                             <li>Drawings, structures. </li>
                             <li>Interior design. </li>
                             <li>Measure the current status of the building. </li>
                             <li>Consultant to check design, estimate. </li>
                             <li>Construction supervision consultant. </li>
                         </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-item pdtop">
                    <div class="img-holder">
                        <img src="http://localhost:88/huongviet/assets/images/about/vision.jpg" alt="Awesome Image">
                        <div class="overlay">
                            <div class="box">
                                <div class="content">
                                    <a href="services-single.html"><i class="fa fa-link" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-box">
                        <h3>Construction</h3>
                         <ul>
                             <li>Construction of civil works. </li>
                             <li>Construction of industrial projects. </li>
                             <li>Leveling. </ li>
                             <li>Construction quality inspection.</li>
                         </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>           
<section class="choose-area">
    <div class="container">
        <div class="sec-title text-center">
            <h2>Why you choose Huong Viet J.S.C</h2>
            <span class="border"></span>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="single-item">
                    <div class="icon-holder">
                        <span class="flaticon-internet"></span>
                    </div>
                    <div class="text-holder">
                        <h3>10 years of experience</h3>
                        <p>Professional, dedicated, skilled and experienced...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="single-item">
                    <div class="icon-holder">
                        <span class="flaticon-idea"></span>
                    </div>
                    <div class="text-holder">
                        <h3>Always update trends</h3>
                        <p>Bring many smart solutions, beautiful, creative, new...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="single-item">
                    <div class="icon-holder">
                        <span class="flaticon-construction"></span>
                    </div>
                    <div class="text-holder">
                        <h3>Work quality</h3>
                        <p>We are always on top and committed to ensuring.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="single-item">
                    <div class="icon-holder">
                        <span class="flaticon-cup"></span>
                    </div>
                    <div class="text-holder">
                        <h3>Construction costs</h3>
                        <p>Transparent and optimal savings for customers.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="single-item">
                    <div class="icon-holder">
                        <span class="flaticon-interface"></span>
                    </div>
                    <div class="text-holder">
                        <h3>Save time, effort</h3>
                        <p>If you do not have much knowledge about the construction field.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="single-item">
                    <div class="icon-holder">
                        <span class="flaticon-24-hours"></span>
                    </div>
                    <div class="text-holder">
                        <h3>Work progress</h3>
                        <p>We closely monitor and commit to ensure.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>
    
<section class="team-area">
    <div class="container">
        <div class="sec-title">
            <h2>Đội ngũ <span> Nhân Viên</span></h2>
            <span class="decor"></span>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="team-members">
                    <div class="single-team-member">
                        <div class="img-holder">
                            <img src="http://localhost:88/huongviet/assets/images/team/team-1.jpg" alt="Awesome Image">
                        </div>
                        <div class="text-holder text-center">
                            <h3>Mr Trung</h3>
                            <p>CEO</p>
                        </div>
                    </div>    
                    <div class="single-team-member">
                        <div class="img-holder">
                            <img src="http://localhost:88/huongviet/assets/images/team/team-2.jpg" alt="Awesome Image">
                        </div>
                        <div class="text-holder text-center">
                            <h3>Mr Đức</h3>
                            <p>Chief of Design Department</p>
                        </div>
                    </div>    
                    <div class="single-team-member">
                        <div class="img-holder">
                            <img src="http://localhost:88/huongviet/assets/images/team/team-3.jpg" alt="Awesome Image">
                        </div>
                        <div class="text-holder text-center">
                            <h3>Mr Vũ</h3>
                            <p>Architect</p>
                        </div>
                    </div>    
                    <div class="single-team-member">
                        <div class="img-holder">
                            <img src="http://localhost:88/huongviet/assets/images/team/team-1.jpg" alt="Awesome Image">
                        </div>
                        <div class="text-holder text-center">
                            <h3>Ms Hạnh</h3>
                            <p>Interior designer</p>
                        </div>
                    </div>    
                    <div class="single-team-member">
                        <div class="img-holder">
                            <img src="http://localhost:88/huongviet/assets/images/team/team-2.jpg" alt="Awesome Image">
                        </div>
                        <div class="text-holder text-center">
                            <h3>Mr Trí</h3>
                            <p>Engineer</p>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</section>

<div class="fact-counter-area">
    <div class="container">
        <div class="sec-title">
            <h2>Số liệu thông kê</h2>
            <span class="decor"></span>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="single-item">
                    <p>The number of customers, projects, works are the numbers say, showing the efforts and success of Huong Viet J.S.C and the trust and support of our customers for our company.</p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="single-fact-counter text-center">
                            <div class="box">
                                <h2><span class="timer" data-from="1" data-to="50" data-speed="5000" data-refresh-interval="50">50 +</span><i class="fa fa-plus" aria-hidden="true"></i></h2>
                                <div class="icon-holder">
                                    <span class="flaticon-internet"></span>
                                </div>
                            </div>
                            <div class="title">
                                <h3>Công trình</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="single-fact-counter text-center">
                            <div class="box">
                                <h2><span class="timer" data-from="1" data-to="100" data-speed="5000" data-refresh-interval="50">100+</span></h2>
                                <div class="icon-holder">
                                    <span class="flaticon-people-1"></span>
                                </div>
                            </div>
                            <div class="title">
                                <h3>Khách hàng</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="single-fact-counter text-center">
                            <div class="box">
                                <h2><span class="timer" data-from="1" data-to="70" data-speed="5000" data-refresh-interval="50">70 +</span></h2>
                                <div class="icon-holder">
                                    <span class="flaticon-people"></span>
                                </div>
                            </div>
                            <div class="title">
                                <h3>Nhân viên</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="single-fact-counter text-center">
                            <div class="box">
                                <h2><span class="timer" data-from="1" data-to="2319" data-speed="5000" data-refresh-interval="50">2319</span></h2>
                                <div class="icon-holder">
                                    <span class="flaticon-multimedia"></span>
                                </div>
                            </div>
                            <div class="title">
                                <h3>Quan tâm</h3>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div> -->
