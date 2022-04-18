
<script type="text/javascript">
    // $(document).ready(function() {
    //     showAllNews(0);
    // });
    // function showAllNews(start){
    //     var module_url = '<?= PATH_URL ?><?=$this->lang->lang();?>/';
    //     var per_page        = 8;
    //     $.post(module_url+'showAllNews',{
    //         start            : start,
    //         per_page         : per_page,
    //         csrf_token: $('#csrf_token').val()
    //     },function(data){
    //         $('#wrap-post-news').html(data);
            
    //     });
    // }
</script>
<style>
    .blog-entry {
        color: #5c5c5c ! important;
        margin-bottom: 10px !important;
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
    <!--breadcrumb-section ends-->
    <!--container starts-->
    <div class="container">
        <!--primary starts-->
        <section id="primary" class="content-full-width mt-3">
            <!--dt-sc-portfolio-container starts-->
            <div class="dt-sc-portfolio-container">
                <div class="portfolio dt-sc-one-third column first music">
                    <div class="portfolio-thumb">
                        <img class="item-mask" src="images/portfolio-mask.png" alt="" title="">
                        <img src="http://placehold.it/1170x1010" alt="" title="">
                        <div class="image-overlay">
                            <a href="portfolio-detail.html" class="link"><span class="fa fa-link"></span></a>
                            <a href="http://placehold.it/1170x1010" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="portfolio-detail.html"> Arts &amp; Craft </a></h5>
                            <p><a href="#">Cool</a>, <a href="#">Fun</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="portfolio dt-sc-one-third column all music">
                    <div class="portfolio-thumb">
                        <img class="item-mask" src="images/portfolio-mask.png" alt="" title="">
                        <img src="http://placehold.it/1170x1010" alt="" title="">
                        <div class="image-overlay">
                            <a href="portfolio-detail.html" class="link"><span class="fa fa-link"></span></a>
                            <a href="http://placehold.it/1170x1010" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="portfolio-detail.html"> Summer Fun </a></h5>
                            <p><a href="#">Lead</a>, <a href="#">Sustain</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="portfolio dt-sc-one-third column all arts fun listen">
                    <div class="portfolio-thumb">
                        <img class="item-mask" src="images/portfolio-mask.png" alt="" title="">
                        <img src="http://placehold.it/1170x1010" alt="" title="">
                        <div class="image-overlay">
                            <a href="portfolio-detail.html" class="link"><span class="fa fa-link"></span></a>
                            <a href="http://placehold.it/1170x1010" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="portfolio-detail.html"> Swim Lesson </a></h5>
                            <p><a href="#">Joy</a>, <a href="#">Enjoy</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="portfolio dt-sc-one-third column first all music">
                    <div class="portfolio-thumb">
                        <img class="item-mask" src="images/portfolio-mask.png" alt="" title="">
                        <img src="http://placehold.it/1170x1010" alt="" title="">
                        <div class="image-overlay">
                            <a href="portfolio-detail.html" class="link"><span class="fa fa-link"></span></a>
                            <a href="http://placehold.it/1170x1010" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="portfolio-detail.html"> Fly with me </a></h5>
                            <p><a href="#">Slick</a>, <a href="#">bless</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="portfolio dt-sc-one-third column all fun music listen">
                    <div class="portfolio-thumb">
                        <img class="item-mask" src="images/portfolio-mask.png" alt="" title="">
                        <img src="http://placehold.it/1170x1010" alt="" title="">
                        <div class="image-overlay">
                            <a href="portfolio-detail.html" class="link"><span class="fa fa-link"></span></a>
                            <a href="http://placehold.it/1170x1010" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="portfolio-detail.html"> Active Learning </a></h5>
                            <p><a href="#">Learn</a>, <a href="#">Lead</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="portfolio dt-sc-one-third column all innovation listen">
                    <div class="portfolio-thumb">
                        <img class="item-mask" src="images/portfolio-mask.png" alt="" title="">
                        <img src="http://placehold.it/1170x1010" alt="" title="">
                        <div class="image-overlay">
                            <a href="portfolio-detail.html" class="link"><span class="fa fa-link"></span></a>
                            <a href="http://placehold.it/1170x1010" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="portfolio-detail.html"> Our Approach </a></h5>
                            <p><a href="#">Blow</a>, <a href="#">Relax</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="portfolio dt-sc-one-third column all listen">
                    <div class="portfolio-thumb">
                        <img class="item-mask" src="images/portfolio-mask.png" alt="" title="">
                        <img src="http://placehold.it/1170x1010" alt="" title="">
                        <div class="image-overlay">
                            <a href="portfolio-detail.html" class="link"><span class="fa fa-link"></span></a>
                            <a href="http://placehold.it/1170x1010" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="portfolio-detail.html"> Our School </a></h5>
                            <p><a href="#">Fun</a>, <a href="#">Enjoy</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="portfolio dt-sc-one-third first column all fun">
                    <div class="portfolio-thumb">
                        <img class="item-mask" src="images/portfolio-mask.png" alt="" title="">
                        <img src="http://placehold.it/1170x1010" alt="" title="">
                        <div class="image-overlay">
                            <a href="portfolio-detail.html" class="link"><span class="fa fa-link"></span></a>
                            <a href="http://placehold.it/1170x1010" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="portfolio-detail.html"> Karate Kid </a></h5>
                            <p><a href="#">Slick</a>, <a href="#">bless</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="portfolio dt-sc-one-third column all innovation music listen">
                    <div class="portfolio-thumb">
                        <img class="item-mask" src="images/portfolio-mask.png" alt="" title="">
                        <img src="http://placehold.it/1170x1010" alt="" title="">
                        <div class="image-overlay">
                            <a href="portfolio-detail.html" class="link"><span class="fa fa-link"></span></a>
                            <a href="http://placehold.it/1170x1010" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="portfolio-detail.html"> Play Time </a></h5>
                            <p><a href="#">Learn</a>, <a href="#">Lead</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="portfolio dt-sc-one-third column all">
                    <div class="portfolio-thumb">
                        <img class="item-mask" src="images/portfolio-mask.png" alt="" title="">
                        <img src="http://placehold.it/1170x1010" alt="" title="">
                        <div class="image-overlay">
                            <a href="portfolio-detail.html" class="link"><span class="fa fa-link"></span></a>
                            <a href="http://placehold.it/1170x1010" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="portfolio-detail.html"> Your Innovations </a></h5>
                            <p><a href="#">Slick</a>, <a href="#">bless</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="portfolio dt-sc-one-third column all innovation">
                    <div class="portfolio-thumb">
                        <img class="item-mask" src="images/portfolio-mask.png" alt="" title="">
                        <img src="http://placehold.it/1170x1010" alt="" title="">
                        <div class="image-overlay">
                            <a href="portfolio-detail.html" class="link"><span class="fa fa-link"></span></a>
                            <a href="http://placehold.it/1170x1010" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="portfolio-detail.html"> Music Hour </a></h5>
                            <p><a href="#">Learn</a>, <a href="#">Lead</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="portfolio dt-sc-one-third column all fun music">
                    <div class="portfolio-thumb">
                        <img class="item-mask" src="images/portfolio-mask.png" alt="" title="">
                        <img src="http://placehold.it/1170x1010" alt="" title="">
                        <div class="image-overlay">
                            <a href="portfolio-detail.html" class="link"><span class="fa fa-link"></span></a>
                            <a href="http://placehold.it/1170x1010" data-gal="prettyPhoto[gallery]" class="zoom"><span class="fa fa-search"></span></a>
                        </div>
                    </div>
                    <div class="portfolio-detail">
                        <div class="portfolio-title">
                            <h5><a href="portfolio-detail.html"> Get Ready for Adventure </a></h5>
                            <p><a href="#">Fun</a>, <a href="#">Enjoy</a></p>
                        </div>
                    </div>
                </div>
                
            </div>
            <!--dt-sc-portfolio-container ends-->
        </section>
        <!--primary ends-->
    </div>
    <!--container ends-->
</div>
<!--main ends-->