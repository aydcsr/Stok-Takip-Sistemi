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
                        <h3 class="box-title">Kullanıcı Düzenle</h3>
                    </div>


                    <form role="form" action="<?=SITE_URL;?>/kullanici/update/<?=$params['data']['id'];?>" method="post">

                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Çalışan Adı:</label>
                                <input type="text" class="form-control" name="adi" value="<?=$params['data']['adi'];?>">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Çalışan Soyadı:</label>
                                <input type="text" class="form-control" name="soyadi" value="<?=$params['data']['soyadi'];?>">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Çalışan Şifre:</label>
                                <input type="text" class="form-control" name="parola">
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label>Unvan</label>
                                <select class="form-control select2-hidden-accessible form-group" id="kt_select2_1" name="unvan" data-select2-id="kt_select2_1" tabindex="-1" aria-hidden="true">

                                    <option value="mudur" >Müdür</option>
                                    <option value="kasa_calisani" >Kasa Çalışanı</option>
                                    <option value="reyon_calisani" >Reyon Çalışanı</option>
                                    <br/>
                                </select>
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