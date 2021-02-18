<?php
class musteriler extends controller
{
    public function index()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL); die();}
        if(!$this->model('uyeModel')->permission($this->myuserid,2)){helper::redirect(SITE_URL); die();}
        $data = $this->model('musterilerModel')->listview();
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('musteriler/index',['data'=>$data]);
        $this->render('site/footer');
    }

    public function create()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL); die();}
        if(!$this->model('uyeModel')->permission($this->myuserid,2)){helper::redirect(SITE_URL); die();}
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('musteriler/create');
        $this->render('site/footer');
    }

    public function send()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL); die();}
        if(!$this->model('uyeModel')->permission($this->myuserid,2)){helper::redirect(SITE_URL); die();}
        if($_POST)
        {
            $adi = helper::cleaner($_POST['adi']);
            $soyadi = helper::cleaner($_POST['soyadi']);
            $telefon = helper::cleaner($_POST['telefon']);
            $adres = helper::cleaner($_POST['adres']);
            $dogum_tarihi = helper::cleaner($_POST['dogum_tarihi']);
            if($adi!="" and $soyadi!="")
            {
                if(strlen($telefon) == 11)
                {
                    $insert = $this->model('musterilerModel')->create($adi,$soyadi,$telefon,$dogum_tarihi,$adres);
                    if($insert)
                    {
                        helper::flashData("statu","Müşteri Başarı ile eklendi");
                        helper::redirect(SITE_URL."/musteriler/create");
                    }
                    else
                    {
                        helper::flashData("statu","Müşteri Eklenemedi");
                        helper::redirect(SITE_URL."/musteriler/create");
                    }
                }
                else {
                    helper::flashData("statu","Telefon numarası 11 haneli olmalı");
                    helper::redirect(SITE_URL."/musteriler/create");

                }
            }
            else
            {
                helper::flashData("statu","Müşteri Adı Soyadı Boş bırakılamaz");
                helper::redirect(SITE_URL."/musteriler/create");
            }

        }
        else
        {
            exit("yasaklı giriş");
        }
    }

    public function edit($id)
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL); die();}
        if(!$this->model('uyeModel')->permission($this->myuserid,2)){helper::redirect(SITE_URL); die();}
        $data = $this->model('musterilerModel')->getData($id);
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('musteriler/edit',['data'=>$data]);
        $this->render('site/footer');
    }

    public function update($id)
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL); die();}
        if(!$this->model('uyeModel')->permission($this->myuserid,2)){helper::redirect(SITE_URL); die();}
        if($_POST)
        {
            $adi = helper::cleaner($_POST['adi']);
            $soyadi = helper::cleaner($_POST['soyadi']);
            $telefon = helper::cleaner($_POST['telefon']);
            $adres = helper::cleaner($_POST['adres']);
            $dogum_tarihi = helper::cleaner($_POST['dogum_tarihi']);
            if($adi!="" and $soyadi!="")
            {
                if(strlen($telefon) == 11)
                {
                    $insert = $this->model('musterilerModel')->updateData($id,$adi,$soyadi,$telefon,$dogum_tarihi,$adres);
                    if($insert)
                    {
                        helper::flashData("statu","Müşteri Başarı ile Düzenlendi");
                        helper::redirect(SITE_URL."/musteriler/edit/".$id);
                    }
                    else
                    {
                        helper::flashData("statu","Müşteri Düzenlenemedi");
                        helper::redirect(SITE_URL."/musteriler/edit/".$id);
                    }
                }
                else
                {
                    helper::flashData("statu","Telefon numarası 11 haneli olmalı");
                    helper::redirect(SITE_URL."/musteriler/edit/".$id);
                }

            }
            else
            {
                helper::flashData("statu","Müşteri Adı Soyadı Boş bırakılamaz");
                helper::redirect(SITE_URL."/musteriler/edit/".$id);
            }

        }
        else
        {
            exit("yasaklı giriş");
        }
    }


    public function delete($id)
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL); die();}
        if(!$this->model('uyeModel')->permission($this->myuserid,2)){helper::redirect(SITE_URL); die();}
        $this->model('musterilerModel')->delete($id);
        helper::redirect(SITE_URL."/musteriler");
    }


}