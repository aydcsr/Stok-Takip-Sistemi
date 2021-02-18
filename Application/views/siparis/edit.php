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
                        <h3 class="box-title">Siparişi Düzenle</h3>
                    </div>


                    <form role="form" action="<?=SITE_URL;?>/siparis/update/<?=$params['data']['id'];?>" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Müşteri Seçiniz:</label>
                                <select name="musteri_id" class="form-control">
                                    <?php
                                    foreach($this->model('musterilerModel')->listview() as $key => $value)
                                    {
                                        ?>
                                        <option <?php if($value['id'] == $params['data']['musteri_id']){ echo 'selected'; } ?> value="<?=$value['id'];?>"><?=$value['adi'];?> <?=$value['soyadi'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sipariş Tarihi:</label>
                                <input type="date" name="tarih" class="form-control" value="<?=$params['data']['tarih'];?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sipariş Tutarı:</label>
                                <input type="text" name="fiyat" class="form-control" value="<?=$params['data']['fiyat'];?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sipariş Numarası:</label>
                                <input type="text" name="no" class="form-control" value="<?=$params['data']['no'];?>">
                            </div>


                            <div class="form-group">
                                <label style="display: block">Ürünler</label>
                                <button id="yeniEkle" class="btn btn-info" type="button">Yeni Ürün Ekle</button>
                                <div id="urunOzellikAlani">
                                    <?php
                                    if(count(json_decode($params['data']['urunler'],true))!=0)
                                    {
                                        foreach(json_decode($params['data']['urunler'],true) as $key => $value)
                                        {
                                            ?>
                                    <div class="items row">
                                        <div class="col-md-3">
                                            <label>Ürün Seçiniz:</label>
                                            <select name="urun[<?=$key;?>][id]" class="form-control">
                                                <?php
                                                    foreach($this->model('urunlerModel')->listview() as $key2 => $value2)
                                                    {
                                                        echo '<option value="'.$value2['id'].'"';
                                                        if($value2['id'] == $value['id']) {echo 'selected';}
                                                        echo '>'.$value2['modeli'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Ürün adet:</label>
                                            <input  type="text" class="form-control" name="urun[<?=$key;?>][adet]" value="<?=$value['adet'];?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Ürün Birim Fiyat:</label>
                                            <input type="text" class="form-control" name="urun[<?=$key;?>][fiyat]" value="<?=$value['fiyat'];?>">
                                        </div>
                                        <div class="col-md-3">
                                            <button style="margin-top:25px;" type="button" id="removeItem" class="btn btn-danger">Sil</button>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
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
<script src="http://stoktakipsistemi.local/public/bower_components/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var i = $(".items").length;
        $("#yeniEkle").click(function () {
            $.ajax({
                url: "http://stoktakipsistemi.local/siparis/getUrunList",
                dataType:"json",
                success: function(result)
                {
                    var temp = '<div class="items row"><div class="col-md-3">' +
                        '<label>Ürün Seçiniz:</label>'+
                        '<select name="urun['+i+'][id]" class="form-control">';


                    $.each(result, function(i, item) {
                        temp+='<option value="'+item.id+'">'+item.modeli+'</option>';
                    });

                    temp +='</select></div><div class="col-md-3">' +
                        '<label>Ürün adet:</label>' +
                        '<input  type="text" class="form-control" name="urun['+i+'][adet]">' +
                        '</div>' +
                        '<div class="col-md-3">' +
                        '<label>Ürün Birim Fiyat:</label>' +
                        '<input type="text" class="form-control" name="urun['+i+'][fiyat]">' +
                        '</div>' +
                        '<div class="col-md-3">' +
                        '<button style="margin-top:25px;" type="button" id="removeItem" class="btn btn-danger">Sil</button>' +
                        '</div></div>';
                    $("#urunOzellikAlani").append(temp)
                }
            });

            i++;
        });

        $("body").on("click","#removeItem",function () {
            $(this).closest(".items").remove();
        })
    })
</script>