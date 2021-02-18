<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <a href="<?=SITE_URL;?>/excel/export" class="btn btn-info">Excel Olarak indir</a>
                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title">Ürün Listesi</h3>
                    </div>

                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Ürün Modeli</th>
                                <th>Ürün Markası</th>
                                <th>Düzenle</th>
                                <th>Kaldır</th>
                            </tr>
                                <?php
                                if(count($params['data'])!=0)
                                {
                                foreach($params['data'] as $key => $value)
                                {?>
                                <tr>
                                <td><?=$value['modeli'];?></td>
                                <td><?=$value['markasi'];?></td>
                                <th><a href="<?=SITE_URL;?>/urunler/edit/<?=$value['id'];?>">Düzenle</a></th>
                                <th><a href="<?=SITE_URL;?>/urunler/delete/<?=$value['id'];?>">Sil</a></th>
                                </tr>
                            <?php
                                }
                                }?>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
        </div>
    </section>
</div>