<style type="text/css">
    .main-menu .navigation > li:hover > a, .main-menu .navigation > li.product > a {
      color: #006699;
      opacity: 1;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        showAllProducts(0);
    });
    function showAllProducts(start){
        var module_url = '<?= PATH_URL ?><?=$this->lang->lang();?>/home/';
        var per_page        = 12;
        $.post(module_url+'showAllProducts',{
            start            : start,
            per_page         : per_page,
            csrf_token: $('#csrf_token').val()
        },function(data){
            $('#wrap-post-news').html(data);
            
        });
    }
</script>
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url(<?= PATH_URL ?>assets/images/breadcrumb/breadcrumb-bg.jpg);">
	<div class="container-fluid text-center">
		<h1><?=lang('title_product')?></h1>
		<div class="breadcrumb-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="left pull-left">
                            <ul>
                                <li><a href="<?=$this->lang->lang();?>/"><?=lang('menu_home')?></a></li>
                                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                                <li><?=lang('menu_products')?></li>
                            </ul>    
                        </div>   
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>
<!--End breadcrumb area-->
 
<!--Start shop with sidebar area-->
<section class="shop-withsidebar-area">
    <div class="container">
        <div class="row showing-result-shorting">
            <div class="col-lg-3 col-md-4 col-sm-7 col-xs-12">
                <div class="sidebar-wrapper">
                    <!--Start single sidebar-->
                    <div class="single-sidebar">
                        <form class="search-form" action="#">
                            <input placeholder="Search..." type="text">
                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-5 col-xs-12">
                <div class="shorting pull-right">
                    <select class="selectmenu">
                        <?php foreach ($cataproduct as $key => $v): ;?>
                         <option <?php if($key==0){ echo "selected";} else {} ?> ><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $v->$name ?></option>
                        <?php endforeach ?>

                    </select>
                </div>      
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-7 col-xs-12">
                <div class="sidebar-wrapper">
                    <!--End single sidebar-->
                    <!--Start single sidebar-->
                    <div class="single-sidebar">
                        <div class="sidebar-title">
                            <h1>Categories</h1>
                        </div>
                        <ul class="categories clearfix">
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Floor Covering<span>(15)</span></a></li>   
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Tables &amp; Chests<span>(08)</span></a></li>   
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Wall Coverings<span>(10)</span></a></li>   
                            <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Living Furnitures<span>(14)</span></a></li>  
                        </ul>
                    </div>
                    <!--End single sidebar-->
                    <!--Start single sidebar--> 
                    <div class="single-sidebar">
                        <div class="sidebar-title">
                            <h1>Recent Products</h1>
                        </div>
                        <ul class="recent-products">
                            <li>
                                <div class="img-holder">
                                    <img src="images/shop/product-thumb-1.jpg" alt="Awesome Image">
                                    <div class="overlay">
                                        <div class="box">
                                            <div class="content">
                                                <a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="title">
                                    <h5><a href="#">Wooden Chair</a></h5>
                                    <p>$34.99</p>
                                    <div class="review">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="img-holder">
                                    <img src="images/shop/product-thumb-2.jpg" alt="Awesome Image">
                                    <div class="overlay">
                                        <div class="box">
                                            <div class="content">
                                                <a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="title">
                                    <h5><a href="#">Bridcadge Tree</a></h5>
                                    <p>$24.00</p>
                                    <div class="review">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="img-holder">
                                    <img src="images/shop/product-thumb-3.jpg" alt="Awesome Image">
                                    <div class="overlay">
                                        <div class="box">
                                            <div class="content">
                                                <a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="title">
                                    <h5><a href="#">Stackable Table</a></h5>
                                    <p>$20.00</p>
                                    <div class="review">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                </div>
                            </li>
                           
                            
                        </ul>
                    </div>
                    <!--End single sidebar-->

                </div>    
            </div>
            <div class="col-lg-9 col-md-8 col-sm-5 col-xs-12">
                <!--Start Shop items-->
                <div class="shop-items" id="wrap-post-news">

                </div>
                <!--End Shop items-->
            </div>
        </div>
    </div>
</section>                 
<!--End shop area-->  