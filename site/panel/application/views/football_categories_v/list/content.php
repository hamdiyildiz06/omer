<div class="row">
    <div class="col-md-12">
        <?php if (isAllowedWriteModule()){ ?>
            <h4 class="m-b-lg">
                Futbol Kategori Listesi
                <a href="<?php echo base_url("football_categories/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
            </h4>
        <?php } ?>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">

            <?php if(empty($items)) { ?>

                <div class="alert alert-info text-center">
                    <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?php echo base_url("football_categories/new_form"); ?>">tıklayınız</a></p>
                </div>

            <?php } else { ?>

                <table class="table table-hover table-striped table-bordered content-container">
                    <thead>
                        <th class="w50">#id</th>
                        <th>Görsel</th>
                        <th>Kategori Başlık</th>
                        <th>Durumu</th>
                        <th>İşlem</th>
                    </thead>
                    <tbody>

                        <?php foreach($items as $item) { ?>

                            <tr>
                                <td class="w50 text-center">#<?php echo $item->id; ?></td>
                                <td class="text-center w100">
                                    <img width="75"
                                         src="<?php echo get_picture($viewFolder, $item->img_url, "730x411"); ?>"
                                         alt="" class="img-rounded">
                                </td>
                                <td><a href="<?= base_url("football/category/{$item->id}"); ?>"><?php echo $item->title; ?></a></td>
                                <td class="text-center w100">
                                    <input
                                        data-url="<?php echo base_url("football_categories/isActiveSetter/$item->id"); ?>"
                                        class="isActive"
                                        type="checkbox"
                                        data-switchery
                                        data-color="#10c469"
                                        <?php echo ($item->isActive) ? "checked" : ""; ?>
                                    />
                                </td>
                                <td class="text-center w200">
                                    <?php if (isAllowedDeleteModule("football_categories")){ ?>
                                        <button
                                            data-url="<?php echo base_url("football_categories/delete/$item->id"); ?>"
                                            class="btn btn-sm btn-danger btn-outline remove-btn">
                                            <i class="fa fa-trash"></i> Sil
                                        </button>
                                    <?php } ?>
                                    <?php if (isAllowedUpdateModule("football_categories")){ ?>
                                        <a href="<?php echo base_url("football_categories/update_form/$item->id"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Düzenle</a>
                                    <?php } ?>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } ?>

        </div><!-- .widget -->
    </div><!-- END column -->
</div>