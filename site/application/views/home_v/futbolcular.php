<section id="section-3" class="section light-gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2 text-center">
                <h2 class="title">Takım <span class="text-default">Arkadaşlarımız</span></h2>
                <div class="separator"></div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae reprehenderit laboriosam, quasi ipsam adipisci, dolor facilis blanditiis, repellendus, esse porro ipsum! Quos obcaecati autem laudantium quis itaque non ducimus ea?</p>
                <div class="space-bottom"></div>
            </div>
        </div>
    </div>

    <div class="owl-carousel carousel-autoplay">
        <?php foreach ($football_players as $football_player): $football_categoris = get_football_categoris($football_player->category_id); ?>

        <div class="image-box shadow text-center">
            <div class="overlay-container">
                <img src="<?= get_picture("football_v",$football_player->img_url,"476x574") ?>" alt="<?= $football_player->title; ?>">
                <div class="overlay-top">
                    <div class="text">
                        <h3><a href="portfolio-item.html"><?= $football_player->title; ?></a></h3>
                        <p class="small"><?= $football_player->mevki; ?></p>
                    </div>
                </div>
                <div class="overlay-bottom">
                    <div class="links">

                            <a href="<?= base_url("home/football_category/$football_categoris->title"); ?>" class="btn btn-gray-transparent btn-animated"><?= $football_categoris->title ?> Ligi <i class="pl-10 fa fa-arrow-right"></i></a>

                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>