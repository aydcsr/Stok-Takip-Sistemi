<?php
class kasa extends controller
{
    public function index()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur' or !$this->sessionManager->getUserInfo()["unvan"] != 'kasa_calisani') {
            $data = $this->model('kasaModel')->listview();
            $this->render('site/header');
            $this->render('site/sidebar');
            $this->render('kasa/index', ['data' => $data]);
            $this->render('site/footer');
        }
        else{
            $this->error_page();
        }
    }
    public function create()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur' or !$this->sessionManager->getUserInfo()["unvan"] != 'kasa_calisani') {
            $this->render('site/header');
            $this->render('site/sidebar');
            $this->render('kasa/create');
            $this->render('site/footer');
        }
        else{
            $this->error_page();
        }
    }

    public function send()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur' or !$this->sessionManager->getUserInfo()["unvan"] != 'kasa_calisani') {
            if ($_POST) {
                $ad = helper::cleaner($_POST['ad']);
                if ($ad != "") {
                    $insert = $this->model('kasaModel')->create($ad);
                    if ($insert) {
                        helper::flashData("statu", "Kasa Başarı ile eklendi");
                        helper::redirect(SITE_URL . "/kasa/create/");
                    } else {
                        helper::flashData("statu", "Kasa Eklenemedi");
                        helper::redirect(SITE_URL . "/kasa/create/");
                    }
                } else {
                    helper::flashData("statu", "Kasa adı boş bırakılamaz");
                    helper::redirect(SITE_URL . "/kasa/create/");
                }
            } else {
                exit("yasaklı giriş");
            }
        }
        else{
            $this->error_page();
        }
    }

    public function edit($id)
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur' or !$this->sessionManager->getUserInfo()["unvan"] != 'kasa_calisani') {
        $data = $this->model('kasaModel')->getData($id);
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('kasa/edit',['data'=>$data]);
        $this->render('site/footer');}
        else{
            $this->error_page();
        }
    }

    public function update($id)
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur' or !$this->sessionManager->getUserInfo()["unvan"] != 'kasa_calisani') {
            if ($_POST) {
                $ad = helper::cleaner($_POST['ad']);
                if ($ad != "") {
                    $insert = $this->model('kasaModel')->updateData($id, $ad);
                    if ($insert) {
                        helper::flashData("statu", "Kasa Başarı ile Düzenlendi");
                        helper::redirect(SITE_URL . "/kasa/edit/" . $id);
                    } else {
                        helper::flashData("statu", "Kasa Düzenlenemedi");
                        helper::redirect(SITE_URL . "/kasa/edit/" . $id);
                    }
                } else {
                    helper::flashData("statu", "Kasa adı boş bırakılamaz");
                    helper::redirect(SITE_URL . "/kasa/edit/" . $id);
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
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur' or !$this->sessionManager->getUserInfo()["unvan"] != 'kasa_calisani') {
            $this->model('kasaModel')->getDelete($id);
            helper::redirect(SITE_URL . "/kasa");
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