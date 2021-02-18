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
                        <h3 class="box-title">"<?=$params['data']['adi'];?> <?=$params['data']['soyadi'];?>" Düzenle</h3>
                    </div>


                    <form role="form" action="<?=SITE_URL;?>/musteriler/update/<?=$params['data']['id'];?>" method="post">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Adı:</label>
                                <input type="text" class="form-control" name="adi" value="<?=$params['data']['adi'];?>"
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Soyad:</label>
                                <input type="text" class="form-control" name="soyadi" value="<?=$params['data']['soyadi'];?>"
                            </div>

                            <div class="form-group">
                                <label for="example-tel-input" >Telefon</label>
                                <input class="form-control" type="number" name="telefon" minlength="11" maxlength="11" value="<?=$params['data']['telefon_no'];?>"
                            </div>
                            <div class="form-group">
                                <label for="example-date-input" >Doğum Tarihi:</label>
                                <input class="form-control" type="date"  name="dogum_tarihi" value="<?=$params['data']['dogum_tarihi'];?>"
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Adres:</label>
                                <input type="text" class="form-control" name="adres" value="<?=$params['data']['adres'];?>">

                            </div>

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