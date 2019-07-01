<section class="main-container" xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title"><?= $cat->title ?>' Ligi Futbolcularımız.</h1>
                <div class="separator-2"></div>
                <div class="row">

                    <div class="row grid-space-10">
                        <?php foreach ($items as $item): ?>
                        <div class="col-sm-6 col-md-4">
                            <div class="team-member image-box style-2 mb-20 dark-bg text-center">
                                <div class="overlay-container overlay-visible">
                                    <img src="<?= get_picture("football_v",$item->img_url,"476x574") ?>" alt="467x574">
                                    <div class="overlay-bottom">
                                        <ul class="social-links circle dark margin-clear">
                                            <?php if ($item->facebook){ ?>
                                                <li class="facebook"><a target="_blank" href="<?= $item->facebook; ?>"><i class="fa fa-facebook"></i></a></li>
                                            <?php } ?>
                                            <?php if ($item->youtube){ ?>
                                            <li class="youtube"><a target="_blank" href="<?= $item->youtube; ?>"><i class="fa fa-youtube"></i></a></li>
                                            <?php } ?>
                                            <?php if ($item->twitter){ ?>
                                            <li class="twitter"><a target="_blank" href="<?= $item->twitter; ?>"><i class="fa fa-twitter"></i></a></li>
                                            <?php } ?>
                                            <?php if ($item->instagram){ ?>
                                            <li class="instagram"><a target="_blank" href="<?= $item->instagram; ?>"><i class="fa fa-instagram"></i></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="body">
                                    <h3 class="margin-clear"><?= $item->title; ?></h3>
                                    <small><?= $item->mevki; ?></small>
                                    <div class="separator mt-10"></div>
                                    <ul>
                                        <li>
                                            <strong class="pull-left">D.Y.</strong>
                                            <span class="pull-right"><?= $item->city; ?></span>
                                        </li>
                                        <li>
                                            <strong class="pull-left">D.T.</strong>
                                            <span class="pull-right"><?= get_readable_date($item->event_date); ?></span>
                                        </li>
                                        <li>
                                            <strong class="pull-left">Boy</strong>
                                            <span class="pull-right"><?= $item->size; ?></span>
                                        </li>
                                        <li>
                                            <strong class="pull-left">Kilo</strong>
                                            <span class="pull-right"><?= $item->weight; ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>




                </div>
            </div>
        </div>
    </div>
</section>