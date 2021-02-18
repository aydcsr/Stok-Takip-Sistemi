<?php
class login extends controller
{
    public function index()
    {
        $this->render('login');
    }


    public function send()
    {
        if($_POST)
        {
            $id = helper::cleaner($_POST['id']);
            $parola = helper::cleaner($_POST['parola']);

            if($id!="" and $parola!="")
            {
                $control = $this->model('uyeModel')->control($id,md5($parola));
                if($control == 0)
                {
                    helper::flashData("statu","Böyle bir kullanıcı yok");
                    helper::redirect(SITE_URL."/login");
                }
                else
                {
                    sessionManager::createSession(['id'=>$id,'parola'=>md5($parola)]);
                    helper::redirect(SITE_URL);
                }
            }
            else
            {
                helper::flashData("statu","Lütfen Tüm Alanları Giriniz");
                helper::redirect(SITE_URL."/login");
            }

        }
        else
        {
            exit("Hatalı Giriş");
        }
    }
}