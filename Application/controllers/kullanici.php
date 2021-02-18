<?php
class kullanici extends controller
{
    public function index()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur') {
        $data = $this->model('uyeModel')->listview();
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('uyeler/index',['data'=>$data]);
        $this->render('site/footer');}
        else{
            $this->error_page();
        }
    }

    public function create()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur') {
            $this->render('site/header');
            $this->render('site/sidebar');
            $this->render('uyeler/create');
            $this->render('site/footer');
        }
        else{
            $this->error_page();
        }
    }

    public function send()
    {
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur') {
        if($_POST)
        {
            if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
            if(!$this->model('uyeModel')->permission($this->myuserid,6)){helper::redirect(SITE_URL); die();}
            $adi = helper::cleaner($_POST['adi']);
            $soyadi = helper::cleaner($_POST['soyadi']);
            $parola = helper::cleaner($_POST['parola']);
            $unvan = $_POST['unvan'];
            if($adi!="" and $soyadi!="" and $parola!="")
            {

                $insert = $this->model('uyeModel')->create($adi,$soyadi,md5($parola),$unvan);
                if($insert)
                {
                    helper::flashData("statu","Çalışan Eklendi");
                    helper::redirect(SITE_URL."/kullanici/create/");
                }
                else
                {
                    helper::flashData("statu","Çalışan Eklenemedi");
                    helper::redirect(SITE_URL."/kullanici/create/");
                }

            }
            else
            {
                helper::flashData("statu","Gerekli Alanları doldurunuz");
                helper::redirect(SITE_URL."/kullanici/create/");
            }

        }
        else
        {
            exit("Yasaklı Giriş");
        }}
        else{
            $this->error_page();
        }


    }

    public function edit($id)
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur') {
        $data = $this->model('uyeModel')->getData($id);
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('uyeler/edit',['data'=>$data]);
        $this->render('site/footer');}
        else{
            $this->error_page();
        }
    }

    public function update($id)
    {
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur') {
            if ($_POST) {
                if (!$this->sessionManager->isLogged()) {
                    helper::redirect(SITE_URL);
                    die();
                }
                if (!$this->model('uyeModel')->permission($this->myuserid, 6)) {
                    helper::redirect(SITE_URL);
                    die();
                }
                $adi = helper::cleaner($_POST['adi']);
                $soyadi = helper::cleaner($_POST['soyadi']);
                $parola = $_POST['parola'];
                $unvan = $_POST['unvan'];
                if ($adi != "" and $soyadi != "") {
                    if ($parola == "") {
                        $data = $this->model('uyeModel')->getData($id);
                        $parola = $data['parola'];
                    } else {
                        $parola = md5($parola);
                    }


                    $insert = $this->model('uyeModel')->updateData($id, $adi, $soyadi, $parola, $unvan);
                    if ($insert) {
                        helper::flashData("statu", "Kullanıcı düzenlendi");
                        helper::redirect(SITE_URL . "/kullanici/edit/" . $id);
                    } else {
                        helper::flashData("statu", "Kullanıcı düzenlendi");
                        helper::redirect(SITE_URL . "/kullanici/edit/" . $id);
                    }


                } else {
                    helper::flashData("statu", "Gerekli Alanları doldurunuz");
                    helper::redirect(SITE_URL . "/kullanici/edit/" . $id);
                }

            } else {
                exit("Yasaklı Giriş");
            }
        }
        else{
            $this->error_page();
        }
    }

    public function delete($id)
    {
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur') {
            $delete = $this->model('uyeModel')->getDelete($id);

            helper::redirect(SITE_URL . "/kullanici");
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