<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<b>$item->title</b> kaydını düzenliyorsunuz"; ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("football_team/update/{$item->id}"); ?>" method="post" enctype="multipart/form-data">


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Adınız</label>
                            <input class="form-control" placeholder="Adınız ve Soyadınız" name="title" value="<?= $item->title; ?>">
                            <?php if(isset($form_error)){ ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
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
                        <div class="form-group image_upload_container col-md-1">
                            <label>Görsel Seçiniz</label>
                            <img src="<?= get_picture("football_team_v", $item->img_url, "125x125"); ?>" alt="">
                        </div>



                        <div class="form-group image_upload_container col-md-11">
                            <label>Görsel Seçiniz</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?php echo base_url("football_team"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>