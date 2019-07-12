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

                    <div class="image-box style-3-b" <?php echo ($news->news_type == "video") ? "object-non-visible" : ""; ?>">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 col-xl-3  <?php echo ($news->news_type == "video") ? "object-non-visible" : ""; ?>"
                                <?php echo ($news->news_type == "video") ? 'data-animation-effect="fadeInUpSmall" data-effect-delay="100"' : ''; ?>>

                                <?php if($news->news_type == "image") { ?>

                                    <div class="overlay-container">
                                        <?php
                                        $image = get_picture("news_v", $news->img_url, "513x289");
                                        ?>

                                        <img src="<?php echo $image; ?>" alt="<?php echo $news->title; ?>">

                                        <div class="overlay-to-top">
                                            <p class="small margin-clear"><em><?php echo $news->title; ?></em></p>
                                        </div>
                                    </div>

                                <?php } else { ?>

                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe
                                                width="150"
                                                src="https://www.youtube.com/embed/<?php echo $news->video_url; ?>"
                                                allowfullscreen>
                                        </iframe>
                                    </div>

                                <?php } ?>

















                            </div>















                            <div class="col-md-6 col-lg-8 col-xl-9">
                                <div class="body">
                                    <h3 class="title"><a href="<?php echo base_url("haber/$news->url"); ?>"><?php echo $news->title ; ?></a></h3>
                                    <p class="small mb-10"><i class="icon-calendar"></i> <?php echo get_readable_date($news->createdAt); ?>
                                        <span class="comments"><i class="icon-eye"></i> <a href="#"> <?php echo $news->viewCount; ?> Görüntülenme</a></span>
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
