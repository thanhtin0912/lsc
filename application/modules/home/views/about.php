<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.appear.min.js"></script>
<script type="text/javascript" src="<?= PATH_URL; ?>assets/js/frontend/jquery.countTo.js"></script>
<style>
    .author-details blockquote:after {
        content: "";
        border-width: 15px 15px 0px 15px;
        border-style: solid;
        border-color: #818181 transparent transparent;
        width: 0;
        height: 0;
        position: absolute;
        bottom: -15px;
        left: 25px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        StatisticsCount();
    });
    function StatisticsCount() {
        if($('.statistics_item .count').length) {
            $('.statistics_item').appear(function () {
                var count_element = $('.count', this).html();
                $(".count", this).countTo({
                    from: 0,
                    to: count_element,
                    speed: 2000,
                    refreshInterval: 50,
                });
            });
        }
    }
</script>

<!--main starts-->
<div id="main">
    <!--breadcrumb-section starts-->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?= PATH_URL . $this->lang->lang(); ?>/"><?= lang('menu_home') ?></a>
                <span class="fa fa-angle-double-right"></span>
                <span class="current"><?= lang('menu_about') ?></span>
            </div>
        </div>
    </div>
    <div class="container">

        <?php $lang = $this->lang->lang();
                $content = "content_" . $lang;
                echo $about[0]->$content ?>
        <section class="content-full-width pt-4">
            <h2 class="dt-sc-hr-green-title"><?= lang('our_staff') ?></h2>
            <?php foreach ($staffs as $key => $v) : ?>
                <div class="column dt-sc-one-fourth first">
                    <div class="dt-sc-team">
                        <div class="image">
                            <img class="item-mask" src="<?= PATH_URL ?>assets/images/mask.png" title="<?= $v->name ?>">
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
        <!--primary ends-->
    </div>
    <!--container ends-->
    <section class="fullwidth-background dt-sc-parallax-section turquoise-bg">
        <div class="container">
            <div class="statistics">
                <h2 class="dt-sc-hr-green-title">Số liệu thống kê</h2>
                <div class="content-full-width statistics_content">
                    <div class="column dt-sc-one-fourth">
                        <div class="statistics_item">
                            <span class="count">3000</span>
                            STUDENT
                        </div>
                    </div>
                    <div class="column dt-sc-one-fourth">
                        <div class="statistics_item">
                            <span class="count">30</span>
                            CLASS ROOM
                        </div>
                    </div>
                    <div class="column dt-sc-one-fourth">
                        <div class="statistics_item">
                            <span class="count">+5000</span>
                            FACEBOOK
                        </div>
                    </div>
                    <div class="column dt-sc-one-fourth">
                        <div class="statistics_item">
                            <span class="count">3</span>
                            STORE
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!--main ends-->
