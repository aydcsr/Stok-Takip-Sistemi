<!-- Content Wrapper. Contains page content -->
<section class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?=$this->model('raporModel')->toplamGelir();?></h3>

                        <p>Toplam Gelir</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?=$this->model('raporModel')->toplamGider();?></h3>

                        <p>Toplam Gider</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?=$this->model('raporModel')->toplamGelir() - $this->model('raporModel')->toplamGider();?></h3>

                        <p>Kalan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.row -->
        <!-- Main row -->
        <section class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">



                <!-- quick email widget -->
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-envelope"></i>

                        <h3 class="box-title">Hızlı Ürün Ara</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">

                        </div>
                        <!-- /. tools -->
                    </div>
                    <div class="box-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="ad" placeholder="Ürün Adı Giriniz">
                            </div>

                            <?php
                                if($_POST)
                                {
                                   $data = $this->model('urunlerModel')->ara($_POST['ad']);
                                   if(count($data)!=0)
                                   {?>
                                        <table class="table table-hover">
                                            <tr>
                                                <th>ID</th>
                                                <th>Ad</th>
                                                <th>Stok Giriş</th>
                                                <th>Stok Çıkış</th>
                                                <th>Stok Kalan</th>
                                            </tr>
                                       <?php
                                       foreach($data as $key => $value)
                                       {
                                           $girenAdet = $this->model('raporModel')->girenUrunAdet($value['id']);
                                           $cikanAdet = $this->model('raporModel')->cikanUrunAdet($value['id']);
                                           ?>
                                            <tr>
                                                <td><?=$value['id'];?></td>
                                                <td><?=$value['modeli'];?></td>
                                                <td><?=$girenAdet;?></td>
                                                <td><?=$cikanAdet;?></td>
                                                <td><?=$girenAdet-$cikanAdet;?></td>
                                            </tr>

                                    <?php
                                       }
                                       ?>
                                        </table>
                                   <?php
                                   }
                                }
                            ?>
                            <div class="box-footer clearfix">
                                <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
                                    <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </form>
                    </div>

                </div>

                    <div class="box box-info">
                        <div class="box-header">
                            <i class="fa fa-envelope"></i>

                            <h3 class="box-title">En Çok Satılan Ürün</h3>

                            <table class="table table-hover">
                                <tr>
                                    <th>Ürün Modeli</th>
                                    <th>Ürün Markasi</th>
                                    <th>Kategori</th>

                                </tr>
                                <?php
                                $value1 = $this->model('stokModel')->En_cok_satılan_urun();

                                ?>
                                <tr>
                                    <td><?=$value1['modeli'];?></td>
                                    <td><?=$value1['markasi'];?></td>
                                    <td><?=$value1['ad'];?></td>

                                </tr>

                            </table>
                        </div>
                    </div>

            </section>

        </section>

    </section>

</section>
