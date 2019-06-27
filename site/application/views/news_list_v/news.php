
<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-12">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">Haber Listesi</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->

                <!-- timeline grid start -->
                <!-- ================ -->
                <div class="timeline clearfix">


                    <?php $counter = 0; ?>
                    <?php foreach($news_list as $news) { ?>

                        <!-- timeline grid item start -->
                        <div class="timeline-item <?php echo (($counter++ % 2) == 0) ? "pull-left" : "pull-right";?> ">
                            <!-- blogpost start -->
                            <article
                                class="blogpost shadow-2 light-gray-bg bordered <?php echo ($news->news_type == "video") ? "object-non-visible" : ""; ?>"
                                <?php echo ($news->news_type == "video") ? 'data-animation-effect="fadeInUpSmall" data-effect-delay="100"' : ''; ?>>

                                <?php if($news->news_type == "image") { ?>

                                    <div class="overlay-container text-center">
                                        <img src="<?php echo get_picture("news_v", $news->img_url, "513x289"); ?>" alt="<?php echo $news->url; ?>">
                                        <a class="overlay-link" href="<?php echo base_url("haber/$news->url"); ?>"><i class="fa fa-link"></i></a>
                                    </div>

                                <?php } else { ?>

                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="//www.youtube.com/embed/<?php echo $news->video_url; ?>"></iframe>
                                    </div>

                                <?php } ?>

                                <header>
                                    <h2><a href="<?php echo base_url("haber/$news->url"); ?>"><?php echo $news->title; ?></a></h2>
                                    <div class="post-info">
                                            <span class="post-date">
                                              <i class="icon-calendar"></i>
                                              <span class="month"><?php echo get_readable_date($news->createdAt); ?></span>
                                            </span>
                                        <span class="comments"><i class="icon-eye"></i> <a href="#"><?php echo $news->viewCount; ?> Görüntülenme</a></span>
                                    </div>
                                </header>
                                <div class="blogpost-content">
                                    <p>Mauris dolor sapien, malesuada at interdum ut, hendrerit eget lorem. Nunc interdum mi neque, et  sollicitudin purus fermentum ut. Suspendisse faucibus nibh odio, a vehicula eros pharetra in. Maecenas  ullamcorper commodo rutrum. In iaculis lectus vel augue eleifend dignissim. Aenean viverra semper sollicitudin.</p>
                                </div>
                                <footer class="clearfix">
                                    <div class="link pull-right"><i class="icon-link"></i><a href="<?php echo base_url("haber/$news->url"); ?>">Detayına Git</a></div>
                                </footer>
                            </article>
                            <!-- blogpost end -->
                        </div>
                        <!-- timeline grid item end -->

                    <?php } ?>




                </div>
                <!-- timeline grid end -->

            </div>
            <!-- main end -->

        </div>
    </div>
</section>



<!-- ================ -->
<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-12">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title">Portfolyo Listesi</h1>
                <div class="separator-2"></div>
                <!-- page-title end -->
                <p class="lead">Aşağıda sizin için seçtiğimiz çalışmalarımızdan bazılarını bulabilirsiniz.</p>

                <?php foreach($news_list as $news) { ?>

                    <div class="image-box style-3-b">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="overlay-container">

                                    <?php
                                    $image = get_portfolio_cover_image($news->id);
                                    // $image = ($image) ? base_url("panel/uploads/portfolio_v/$image") : base_url("assets/images/portfolio-1.jpg");
                                    $image = get_picture("news_v", $news->img_url, "513x289");
                                    ?>

                                    <img src="<?php echo $image; ?>" alt="<?php echo $news->title; ?>">

                                    <div class="overlay-to-top">
                                        <p class="small margin-clear"><em><?php echo $news->title; ?></em></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-8 col-xl-9">
                                <div class="body">
                                    <h3 class="title"><a href="<?php echo base_url("haber/$news->url"); ?>"><?php echo $news->title ; ?></a></h3>
                                    <p class="small mb-10"><i class="icon-calendar"></i> <?php echo get_readable_date($news->createdAt); ?>
                                    <div class="separator-2"></div>
                                    <p class="mb-10"><?php echo character_limiter(strip_tags($news->description),400); ?></p>
                                    <a href="<?php echo base_url("haber/$news->url"); ?>" class="btn btn-default btn-hvr hvr-shutter-out-horizontal margin-clear">Görüntüle<i class="fa fa-arrow-right pl-10"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <!-- main end -->

        </div>
    </div>
</section>
<!-- main-container end -->