<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <?php

                helper::flashDataView("statu");
                ?>

                <?php if(isset($_SESSION["alert"])){; ?>

                    <div class="alert alert-<?php echo $_SESSION["alert"]["type"]; ?>">
                        <?php echo $_SESSION["alert"]["message"]; ?>
                    </div>

                    <?php unset($_SESSION["alert"]); ?>

                <?php } ?>


                <form action="<?=SITE_URL;?>/rapor/send_mail" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Gönderilecek Adres</label>
                        <input class="form-control" type="email" name="to_email">
                    </div>
                    <div class="form-group">
                        <label>Gönderenin Adı</label>
                        <input class="form-control" type="text" value= <?php echo $this->myuserinfo['adi'], $this->myuserinfo['soyadi'] ; ?> required name="sender">
                    </div>

                    <div class="form-group">
                        <label>Konu</label>
                        <input class="form-control" type="text" value="Müşteri Raporu" required name="subject">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Müşteri Seçiniz:</label>
                        <select name="musteri_id" class="form-control">
                            <?php
                            foreach($this->model('musterilerModel')->listview() as $key => $value)
                            {
                                ?>
                                <option value="<?=$value['id'];?>"><?=$value['adi'];?> <?=$value['soyadi'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Mesaj</label>
                        <textarea name="message" cols="30" rows="10" required class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gönder</button>
                    <button type="reset" class="btn btn-danger">Temizle</button>
                </form>

            </div>
        </div>
    </section>
</div>