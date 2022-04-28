<section class="content-full-width">
    <div class="dt-sc-portfolio-container pt-3">
        <?php foreach ($result as $key => $v) :; ?>
            <div class="portfolio dt-sc-one-third column px-1">
                <div class="portfolio-thumb mb-2">
                    <img src="<?= resizeImage(PATH_URL . DIR_UPLOAD_PROJECTS . $v->avata, 700, 500) ?>" alt="<?php $lang = $this->lang->lang();
                                                                                                        $name = "name_" . $lang;
                                                                                                        echo $v->$name ?>">
                    <div class="image-overlay">
                        <?php if ($v->type == 0) { ?>
                            <a href="<?=PATH_URL.$this->lang->lang().'/library/'.$v->slug?>" class="play"><span class="fa fa-image"></span></a>
                        <?php  } else { ?>
                            <a onclick="show_popup(<?= $v->id ?>)" class="play"><span class="fa fa-play"></span></a>
                        <?php  } ?>
                    </div>
                </div>
                <div class="portfolio-detail">
                    <div class="portfolio-title">
                        <h5><a href="<?=PATH_URL.$this->lang->lang().'/library/'.$v->slug?>"><?php $lang = $this->lang->lang();
                                                            $name = "name_" . $lang;
                                                            echo $v->$name ?></a></h5>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section>

<?php if ($result) { ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="pagination">
                <ul>
                    <?= $this->adminpagination->create_links(); ?>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>
