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
                        <h3 class="box-title">Yeni Müşteri Oluştur</h3>
                    </div>


                    <form role="form" action="<?=SITE_URL;?>/musteriler/send" method="post">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Adı:</label>
                                <input type="text" class="form-control" name="adi">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Soyad:</label>
                                <input type="text" class="form-control" name="soyadi">
                            </div>

                            <div class="form-group">
                                <label for="example-tel-input" >Telefon</label>
                                <input class="form-control" type="number" name="telefon" minlength="11" maxlength="11">
                            </div>
                            <div class="form-group">
                                <label for="example-date-input" >Doğum Tarihi:</label>
                                <input class="form-control" type="date"  name="dogum_tarihi">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Adres:</label>
                                <textarea class="form-control form-control-solid" rows="3" name="adres"></textarea>
                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Ekle</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>