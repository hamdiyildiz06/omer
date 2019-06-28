<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Eğitim Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("football/save"); ?>" method="post" enctype="multipart/form-data">


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Adınız</label>
                            <input class="form-control" placeholder="Adınız ve Soyadınız" name="title">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Doğum Yeri</label>
                            <input class="form-control" placeholder="Doğduğunuz Şehir Bilgisi" name="city">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("city"); ?></small>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Mevki</label>
                            <select name="mevki" class="form-control">
                                    <option value="Kaleci">Kaleci</option>
                                    <option value="Stoper">Stoper</option>
                                    <option value="SolBek">Sol Bek</option>
                                    <option value="SagBek">Sag Bek</option>
                                    <option value="SolKanat">Sol Kanat</option>
                                    <option value="SagKanat">Sag Kanat</option>
                                    <option value="OrtaSaha">Orta Saha</option>
                                    <option value="Forvet">Forvet</option>
                            </select>
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("mevki"); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Kategori</label>
                            <select name="category_id" class="form-control">
                                <?php foreach($categories as $category) { ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
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
                            <input class="form-control" placeholder="Boyunuz" name="size">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("size"); ?></small>
                            <?php } ?>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Kilo</label>
                            <input class="form-control" placeholder="Kilonuz" name="weight">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("weight"); ?></small>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>facebook</label>
                            <input class="form-control" placeholder="facebook Adresiniz" name="facebook">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("facebook"); ?></small>
                            <?php } ?>
                        </div>


                        <div class="form-group col-md-6">
                            <label>twitter</label>
                            <input class="form-control" placeholder="twitter Adresiniz" name="twitter">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("twitter"); ?></small>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>instagram</label>
                            <input class="form-control" placeholder="instagram Adresiniz" name="instagram">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("instagram"); ?></small>
                            <?php } ?>
                        </div>


                        <div class="form-group col-md-6">
                            <label>youtube</label>
                            <input class="form-control" placeholder="youtube Adresiniz" name="youtube">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("youtube"); ?></small>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="datetimepicker1">Doğum Tarihi</label>
                            <input type="hidden" name="event_date" id="datetimepicker1" data-plugin="datetimepicker" data-options="{inline: true, viewMode: 'days', format : 'YYYY-MM-DD HH:mm:ss'}" />
                        </div><!-- END column -->

                        <div class="form-group image_upload_container col-md-8">
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