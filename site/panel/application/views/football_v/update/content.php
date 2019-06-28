<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<b>$item->title</b> kaydını düzenliyorsunuz"; ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("football/update/{$item->id}"); ?>" method="post" enctype="multipart/form-data">


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Adınız</label>
                            <input class="form-control" name="title" value="<?= (isset($form_error)) ? set_value("title") : $item->title; ?>">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Doğum Yeri</label>
                            <input class="form-control" name="city" value="<?= (isset($form_error)) ? set_value("city") : $item->city; ?>">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("city"); ?></small>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Mevki</label>
                            <select name="mevki" class="form-control">
                                    <option <?= ($item->mevki == "Kaleci") ? "selected" : null; ?> value="Kaleci">Kaleci</option>
                                    <option <?= ($item->mevki == "Stoper") ? "selected" : null; ?> value="Stoper">Stoper</option>
                                    <option <?= ($item->mevki == "SolBek") ? "selected" : null; ?> value="SolBek">Sol Bek</option>
                                    <option <?= ($item->mevki == "SagBek") ? "selected" : null; ?> value="SagBek">Sag Bek</option>
                                    <option <?= ($item->mevki == "SolKanat") ? "selected" : null; ?> value="SolKanat">Sol Kanat</option>
                                    <option <?= ($item->mevki == "SagKanat") ? "selected" : null; ?> value="SagKanat">Sag Kanat</option>
                                    <option <?= ($item->mevki == "OrtaSaha") ? "selected" : null; ?> value="OrtaSaha">Orta Saha</option>
                                    <option <?= ($item->mevki == "Forvet") ? "selected" : null; ?>value="Forvet">Forvet</option>
                            </select>
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("mevki"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Kategori</label>
                            <select name="category_id" class="form-control">
                                <?php foreach($categories as $category) { ?>
                                    <option
                                            <?= ($category->id == $item->category_id) ? "selected" : null; ?>
                                            value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
                                <?php } ?>
                            </select>
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("category"); ?></small>
                            <?php } ?>
                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>Boy</label>
                            <input class="form-control" name="size" value="<?= (isset($form_error)) ? set_value("size") : $item->size; ?>">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("size"); ?></small>
                            <?php } ?>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Kilo</label>
                            <input class="form-control"  name="weight" value="<?= (isset($form_error)) ? set_value("weight") : $item->weight; ?>">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("weight"); ?></small>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>facebook</label>
                            <input class="form-control" name="facebook" value="<?= (isset($form_error)) ? set_value("facebook") : $item->facebook; ?>">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("facebook"); ?></small>
                            <?php } ?>
                        </div>


                        <div class="form-group col-md-6">
                            <label>twitter</label>
                            <input class="form-control" name="twitter" value="<?= (isset($form_error)) ? set_value("twitter") : $item->twitter; ?>">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("twitter"); ?></small>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>instagram</label>
                            <input class="form-control" name="instagram" value="<?= (isset($form_error)) ? set_value("instagram") : $item->instagram; ?>">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("instagram"); ?></small>
                            <?php } ?>
                        </div>


                        <div class="form-group col-md-6">
                            <label>youtube</label>
                            <input class="form-control" name="youtube" value="<?= (isset($form_error)) ? set_value("youtube") : $item->youtube; ?>">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("youtube"); ?></small>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="datetimepicker1">Doğum Tarihi</label>
                            <input type="hidden"
                                   name="event_date"
                                   id="datetimepicker1"
                                   data-plugin="datetimepicker"
                                   data-options="{inline: true, viewMode: 'days', format : 'YYYY-MM-DD HH:mm:ss'}"
                                   value="<?php echo (isset($form_error)) ? set_value("event_date") : $item->event_date ; ?>"
                            />
                        </div><!-- END column -->

                        <div class="col-md-1 image_upload_container">
                            <img src="<?php echo get_picture($viewFolder,$item->img_url, "312x370"); ?>" alt="" class="img-responsive">
                        </div>

                        <div class="form-group image_upload_container col-md-7">
                            <label>Görsel Seçiniz</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?php echo base_url("football"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>