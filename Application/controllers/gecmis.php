<?php
class gecmis extends controller
{
    public function index()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL); die();}
        $data = $this->model('gecmisModel')->listview();
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('islemler/index',['data'=>$data]);
        $this->render('site/footer');
    }
    private function error_page()
    {
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('Perm_Error');
        $this->render('site/footer');
    }
}