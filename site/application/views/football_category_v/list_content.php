<section class="main-container">
    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">Tüm Kategori</h1>
                <div class="separator-2"></div>
                <div class="row">

                    <?php foreach($ligs as $lig) { ?>

                        <div class="col-sm-4">
                            <div class="image-box shadow text-center mb-20">
                                <div class="overlay-container overlay-visible">
                                    <img
                                            src="<?php echo get_picture("football_categories_v",$lig->img_url, "730x411"); ?>"
                                            alt="<?php echo $lig->title; ?>">
                                    <a href="<?php echo base_url("futbol-kategori/$lig->title"); ?>" class="overlay-link"><i class="fa fa-link"></i></a>
                                    <div class="overlay-bottom hidden-xs">
                                        <div class="text">
                                            <p class="lead margin-clear">
                                                <?php echo $lig->title; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</section>