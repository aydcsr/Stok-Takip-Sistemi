<?php

class stok extends controller
{

    public function index()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur' or !$this->sessionManager->getUserInfo()["unvan"] != 'reyon_calisani') {
            $data = $this->model('stokModel')->listview();
            $this->render('site/header');
            $this->render('site/sidebar');
            $this->render('stok/index', ['data' => $data]);
            $this->render('site/footer');
        }
        else{
            $this->error_page();
        }
    }

    public function create()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur' or !$this->sessionManager->getUserInfo()["unvan"] != 'reyon_calisani') {
            $urun = $this->model('urunlerModel')->listview();
            $musteri = $this->model('musterilerModel')->listview();
            $kasa = $this->model('kasaModel')->listview();
            $this->render('site/header');
            $this->render('site/sidebar');
            $this->render('stok/create', ['urun' => $urun, 'musteri' => $musteri, 'kasa' => $kasa]);
            $this->render('site/footer');
        }
        else{
            $this->error_page();
        }
    }
    public function send()
    {

        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur' or !$this->sessionManager->getUserInfo()["unvan"] != 'reyon_calisani') {
            if ($_POST) {
                $urun_id = intval($_POST['urun_id']);
                $musteri_id = intval($_POST['musteri_id']);
                $islem_tipi = intval($_POST['islem_tipi']);
                $adet = intval($_POST['adet']);
                $fiyat = helper::cleaner($_POST['fiyat']);
                $kasa_id = intval($_POST['kasa_id']);


                if ($adet != 0 and $fiyat != "") {
                    $insert = $this->model('stokModel')->create($urun_id, $musteri_id, $islem_tipi, $adet, $fiyat, $kasa_id);
                    if ($insert) {
                        helper::flashData("statu", "Stok Başarı ile eklendi");
                        helper::redirect(SITE_URL . "/stok/create");
                    } else {
                        helper::flashData("statu", "Stok Eklenemedi");
                        helper::redirect(SITE_URL . "/stok/create");
                    }
                } else {
                    helper::flashData("statu", "Stok fiyat ve adeti boş bırakılamaz");
                    helper::redirect(SITE_URL . "/stok/create");
                }
            } else {
                helper::flashData("statu", "Stokta ürün yok");
                helper::redirect(SITE_URL . "/stok/create");
            }
        }
        else{
            $this->error_page();
        }
    }

    public function edit($id)
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur' or !$this->sessionManager->getUserInfo()["unvan"] != 'reyon_calisani') {
            $data = $this->model('stokModel')->getData($id);
            $urun = $this->model('urunlerModel')->listview();
            $musteri = $this->model('musterilerModel')->listview();
            $kasa = $this->model('kasaModel')->listview();
            $this->render('site/header');
            $this->render('site/sidebar');
            $this->render('stok/edit', ['data' => $data, 'urun' => $urun, 'musteri' => $musteri, 'kasa' => $kasa]);
            $this->render('site/footer');
        }
        else{
            $this->error_page();
        }
    }

    public function update($id)
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur' or !$this->sessionManager->getUserInfo()["unvan"] != 'reyon_calisani') {
            if ($_POST) {
                $urun_id = intval($_POST['urun_id']);
                $musteri_id = intval($_POST['musteri_id']);
                $islem_tipi = intval($_POST['islem_tipi']);
                $adet = intval($_POST['adet']);
                $fiyat = helper::cleaner($_POST['fiyat']);
                $kasa_id = intval($_POST['kasa_id']);
                if ($adet != 0 and $fiyat != "") {
                    $insert = $this->model('stokModel')->updateData($id, $urun_id, $musteri_id, $islem_tipi, $adet, $fiyat, $kasa_id);
                    if ($insert) {
                        helper::flashData("statu", "Stok Başarı ile düzenlendi");
                        helper::redirect(SITE_URL . "/stok/edit/" . $id);
                    } else {
                        helper::flashData("statu", "Stok düzenlenemedi");
                        helper::redirect(SITE_URL . "/stok/edit/" . $id);
                    }
                } else {
                    helper::flashData("statu", "Stok fiyat ve adeti boş bırakılamaz");
                    helper::redirect(SITE_URL . "/stok/edit/" . $id);
                }
            } else {
                exit("yasaklı giriş");
            }
        }
        else{
            $this->error_page();
        }
    }

    public function delete($id)
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur' or !$this->sessionManager->getUserInfo()["unvan"] != 'reyon_calisani') {
            $query = $this->model('stokModel')->getDelete($id);
            helper::redirect(SITE_URL . "/stok");
        }
        else{
            $this->error_page();
        }
    }
    private function error_page()
    {
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('Perm_Error');
        $this->render('site/footer');
    }

}