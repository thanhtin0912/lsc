
            <?php if($result==''){ ?>
                <div class="row checkout-area" style="padding: 0 ! important">
                    <div class="col-md-12">
                        <div class="exisitng-customer">
                            <h5>Don't have item</h5>
                        </div>
                    </div>
                </div>
            <?php }else{ ?>
            <div class="row">
                <?php foreach ($result as $key => $v): ;?>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                        <div class="single-shop-item">
                            <a href="<?=PATH_URL.$this->lang->lang().'/product/'.$v->slug?>">
                                <div class="img-holder">
                                    <img src="<?=PATH_URL.DIR_UPLOAD_PRODUCTS.$v->avata?>" alt="Awesome Image">
                                   
                                </div>
                            </a>
                            <div class="title-holder">
                                <div class="top clearfix">
                                    <div class="product-title pull-left">
                                        <h5><a href="<?=PATH_URL.$this->lang->lang().'/product/'.$v->slug?>"><?php $lang = $this->lang->lang(); $name = "name_".$lang; echo $v->$name ?></a></h5>
                                    </div>
                                </div>
                                <?php if($v->price==0 || $v->price==''){?> <h4><?= lang('menu_contact')?></h4> <?php }else { ?> <h4><?php echo number_format($v->price)?></h4> <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <?php } ?>

        <?php if($result){ ?>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <ul class="post-pagination text-center" style="visibility: visible;">
                    <?=$this->adminpagination->create_links();?>
                </ul>
            </div>
        </div>
        <?php } ?>