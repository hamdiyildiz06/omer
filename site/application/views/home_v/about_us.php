<?php $settings = get_settings(); ?>
<section class="pv-40">
    <div class="container">
        <div class="row">
            <!-- main start -->
            <!-- ================ -->
            <div class="main col-12">
                <h3 class="title"><strong class="text-default"><?php echo $settings->company_name; ?></strong></h3>
                <div class="separator-2"></div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="title"><strong class="text-default">Misyon</strong></h6>
                                <p>
                                    <?php echo character_limiter(strip_tags($settings->mission), 500); ?>
                                </p>
                            </div>
                            <div class="col-md-12">
                                <h6 class="title"><strong class="text-default">Vizyon</strong></h6>
                                <p>
                                    <?php echo character_limiter(strip_tags($settings->vision), 500); ?>
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="owl-carousel content-slider-with-controls">

                            <?php foreach ($football_catogorys as $football_catogory ): ?>
                                <div class="overlay-container overlay-visible">
                                    <img src="<?= get_picture("football_categories_v",$football_catogory->img_url,"540x334") ?>" alt="anadolu balkan <?= $football_catogory->title; ?> takım kadrosu">
                                    <div class="overlay-bottom hidden-sm-down">
                                        <div class="text">
                                            <h3 class="title"><?= $football_catogory->title ?> Takım Kadromuz</h3>
                                        </div>
                                    </div>
                                    <a href="<?= get_picture("football_categories_v",$football_catogory->img_url,"750x464") ?>" class="owl-carousel--popup-img overlay-link" title="<?= $football_catogory->title ?> Takım Kadromuz"><i class="icon-plus-1"></i></a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main end -->

        </div>
    </div>
</section>