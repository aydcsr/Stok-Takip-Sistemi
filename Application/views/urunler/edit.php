<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <?php
                helper::flashDataView("statu");
                ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">"<?=$params['data']['modeli'];?>" Düzenle</h3>
                    </div>


                    <form role="form" action="<?=SITE_URL;?>/urunler/update/<?=$params['data']['id'];?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Ürün Kategorisi:</label>
                                <select name="kategoriId" class="form-control" id="">
                                    <?php foreach ($params['category'] as $key => $value)
                                    {
                                        ?>
                                        <option value="<?=$value['id'];?>"><?=$value['ad'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ürün Modeli:</label>
                                <input type="text" class="form-control" name="modeli" value="<?=$params['data']['modeli'];?>">
                            </div>

                            <div class="form-group">
                                <label>Ürün Markası:</label>
                                <input type="text" class="form-control" name="markasi" value="<?=$params['data']['markasi'];?>">
                            </div>


                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Düzenle</button>
                            </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>
<script src="http://stoktakipsistemi.local/public/bower_components/jquery/dist/jquery.min.js"></script>
