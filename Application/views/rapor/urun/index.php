<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Ürün Rapor Listesi</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Ad</th>
                                <th>Toplam Gider</th>
                                <th>Toplam Giren Ürün</th>
                                <th>Toplam Gelir</th>
                                <th>Toplam Çıkan Ürün</th>
                                <th>Fiyat Kalan</th>
                                <th>Ürün Kalan</th>
                            </tr>
                            <?php
                            if(count($params['data'])!=0)
                            {
                                foreach($params['data'] as $key => $value)
                                {
                                    $toplamGiren = $this->model('raporModel')->girenUrunToplam($value['id']);
                                    $toplamCikan = $this->model('raporModel')->cikanUrunToplam($value['id']);

                                    $toplamKalan = $toplamCikan-$toplamGiren;

                                    $girenAdet = $this->model('raporModel')->girenUrunAdet($value['id']);
                                    $cikanAdet = $this->model('raporModel')->cikanUrunAdet($value['id']);
                                    $toplamAdet = $girenAdet-$cikanAdet;
                                    ?>
                                    <tr>
                                        <td><?=$value['id'];?></td>
                                        <td><?=$value['modeli'];?></td>
                                        <td>-<?=$toplamGiren;?></td>
                                        <td><?=$girenAdet;?></td>
                                        <td><?=$toplamCikan;?></td>
                                        <td><?=$cikanAdet;?></td>
                                        <td><?=$toplamKalan;?></td>
                                        <td><?=$toplamAdet;?></td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>



                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>

