<?php

class urunler extends controller
{
    public function index()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL); die();}
        $data = $this->model('urunlerModel')->listview();
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('urunler/index',['data'=>$data]);
        $this->render('site/footer');
    }


    public function create()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL); die();}
        $category = $this->model('categoryModel')->listview();
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('urunler/create',['category'=>$category]);
        $this->render('site/footer');
    }


    public function send()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL); die();}
        if($_POST)
        {
            $kategoriId = $_POST['kategoriId'];
            $modeli = $_POST['modeli'];
            $markasi = $_POST['markasi'];
            if($modeli!="" && $markasi !="")
            {
                $insert = $this->model('urunlerModel')->create($kategoriId,$modeli,$markasi);
                if($insert)
                {
                    helper::flashData("statu","Ürün Başarı ile eklendi");
                    helper::redirect(SITE_URL."/urunler/create");
                }
                else
                {
                    helper::flashData("statu","Ürün Eklenemedi");
                    helper::redirect(SITE_URL."/urunler/create");
                }
            }
            else
            {
                helper::flashData("statu","Bütün Alanları Doldurunuz");
                helper::redirect(SITE_URL."/urunler/create");
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
        $category = $this->model('categoryModel')->listview();
        $data = $this->model('urunlerModel')->getData($id);
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('urunler/edit',['category'=>$category,'data'=>$data]);
        $this->render('site/footer');
    }



    public function update($id)
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL); die();}
        if($_POST)
        {
            $kategoriId = $_POST['kategoriId'];
            $modeli = $_POST['modeli'];
            $markasi = $_POST['markasi'];

            if($modeli!="" && $markasi !="")
            {
                $insert = $this->model('urunlerModel')->updateData($id,$kategoriId,$modeli,$markasi);
                if($insert)
                {
                    helper::flashData("statu","Ürün Başarı ile Düzenlendi");
                    helper::redirect(SITE_URL."/urunler/edit/".$id);
                }
                else
                {
                    helper::flashData("statu","Ürün Düzenlenemedi");
                    helper::redirect(SITE_URL."/urunler/edit/".$id);
                }
            }
            else
            {
                helper::flashData("statu","Bütün Alanları Doldurunuz");
                helper::redirect(SITE_URL."/urunler/edit/".$id);
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
        $this->model('urunlerModel')->getDelete($id);
        helper::redirect(SITE_URL."/urunler");
    }
    private function error_page()
    {
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('Perm_Error');
        $this->render('site/footer');
    }



}