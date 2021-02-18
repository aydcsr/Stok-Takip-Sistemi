<?php
class logout extends controller
{
    public function index()
    {
        unset($_SESSION['id']);
        unset($_SESSION['password']);
        helper::redirect(SITE_URL);
    }
}