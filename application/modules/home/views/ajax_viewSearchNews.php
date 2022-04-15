
        <section class="content-full-width">
            <?php foreach ($result as $key => $v): ;?>
            <div class="column dt-sc-one-half">
                <article class="blog-entry">
                    <div class="p-3">
                        <div class="entry-thumb">
                            <a href="<?= PATH_URL . $this->lang->lang() . '/news-detail/' . $v->slug ?>"><img src="<?= resizeImage(PATH_URL . DIR_UPLOAD_NEWS . $v->image, 700 , 400) ?>" alt="" title=""></a>
                        </div>
                        <div class="entry-details">
                            <div class="entry-title">
                                <h3><a href="<?= PATH_URL . $this->lang->lang() . '/news-detail/' . $v->slug ?>"><?php $lang = $this->lang->lang();
                                    $title = "title_" . $lang;
                                    echo $v->$title ?></a></h3>
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
        </section>
        <?php if($result){ ?>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="pagination">
                    <ul>
                        <?=$this->adminpagination->create_links();?>
                    </ul>        		
                </div>
            </div>
        </div>
        <?php } ?>