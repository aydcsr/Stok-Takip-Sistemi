<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class rapor extends controller
{
    public function urun()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur') {
            $data = $this->model('urunlerModel')->listview();
            $this->render('site/header');
            $this->render('site/sidebar');
            $this->render('rapor/urun/index', ['data' => $data]);
            $this->render('site/footer');
        }
        else{
            $this->error_page();
        }
    }


    public function musteri()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur') {
            $data = $this->model('musterilerModel')->listview();
            $this->render('site/header');
            $this->render('site/sidebar');
            $this->render('rapor/musteri/index', ['data' => $data]);
            $this->render('site/footer');
        }
        else{
            $this->error_page();
        }
    }

    public function mail()
    {   if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur') {
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('rapor/musteri/mail');
        $this->render('site/footer');
    }
    else{
        $this->error_page();
    }
    }

    public function send_mail()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL); die();}
        error_reporting(E_ERROR);

        require "vendor/autoload.php";



        if(isset($_POST)){


            if($_POST["to_email"] && $_POST["sender"] && $_POST["subject"] && $_POST["message"]){
                // Mail Gönderme İşlemini Gerçekleştir...

                $file = $_FILES["attachment"];

                require "vendor/phpmailer/src/PHPMailer.php";
                require "vendor/phpmailer/src/SMTP.php";
                require "vendor/phpmailer/src/Exception.php";
                $mail = new PHPMailer;
                $mail->IsSMTP(); // enable SMTP
                $musteri_info = $this->model('raporModel')->mail_info($_POST["musteri_id"]);


                try{
                        // Server Ayarları
                        $mail->SMTPDebug = 0;
                        $mail->isSMTP();
                        $mail->Host = "ssl://smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->Username = "stoktakipvtys@gmail.com"; // Mail adresinizi yazın.. test@gmail.com
                        $mail->Password = "123456789VTYS"; // Mail adresinizin Şifresi sifre123!
                        $mail->CharSet = "utf8";
                        $mail->SMTPSecure = "tls";
                        $mail->Port = 465;

                        // Alıcı Ayarları
                        $mail->setFrom("stoktakipvtys@gmail.com", $_POST["sender"]); // nereden gidecegini berliteceginiz mail adresi... test@gmail.com
                        $mail->addAddress($_POST["to_email"], "");
                        //Müşreti Bilgileri
                        $musteri_bilgi = "Adı: " .$musteri_info["adi"] . " Soyadı: " . $musteri_info["soyadi"] . "\r\n" . "Telefon Numarası: " . $musteri_info["telefon_no"] . PHP_EOL
                            ."Adres: " . $musteri_info["adres"] .PHP_EOL . "SİPARİŞLER" . PHP_EOL . "Ürünler: " . $musteri_info["urunler"] .PHP_EOL ."Tarih: " . $musteri_info["tarih"]
                            .PHP_EOL."FATURALAR". PHP_EOL. "Fatura No: " .$musteri_info["fatura_no"] . PHP_EOL . "Tutar: " .$musteri_info["tutar"].PHP_EOL."Açıklama: ".$musteri_info["aciklama"].PHP_EOL."MESAJ: " . $_POST["message"];

                        // Gonderi Ayarları
                        $mail->isHTML();
                        $mail->Subject = $_POST["subject"];

                        //$mail->Body = $_POST["message"];
                        $mail->Body = $musteri_bilgi;
                        if($mail->send()){

                            $alert = array(
                                "message"   => "Mail başarılı bir şekilde gönderilmiştir.",
                                "type"      => "success"
                            );

                        } else {
                            echo $mail->ErrorInfo;
                            $alert = array(
                                "message"   => "Mail gönderirken bir hata oluştu.",
                                "type"      => "danger"
                            );

                        }

                    } catch (Exception $e){

                        $alert = array(
                            "message"   => $e->getMessage(),
                            "type"      => "danger"
                        );
                    }
                }

            } else {


                $alert = array(
                    "message"   => "Lütfen tüm alanları doldurunuz!",
                    "type"      => "danger"
                );

            }

            $_SESSION["alert"] = $alert;
            header("location: views/rapor/musteri/index.php");
            header("location:");
    }



    public function tarih()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur') {
            if (isset($_GET['firstDate']) and isset($_GET['secondDate'])) {
                $data = $this->model('raporModel')->filtrele($_GET['firstDate'], $_GET['secondDate']);
            } else {
                $data = $this->model('raporModel')->filtrele(date("Y-m-01"), date("Y-m-d"));
            }


            $this->render('site/header');
            $this->render('site/sidebar');
            $this->render('rapor/tarih/index', ['data' => $data]);
            $this->render('site/footer');
        }
        else{
            $this->error_page();
        }
    }
    public function kasa()
    {
        if(!$this->sessionManager->isLogged()){helper::redirect(SITE_URL);die();}
        if(!$this->sessionManager->getUserInfo()["unvan"] != 'mudur') {
            $data = $this->model('kasaModel')->listview();
            $this->render('site/header');
            $this->render('site/sidebar');
            $this->render('rapor/kasa/index', ['data' => $data]);
            $this->render('site/footer');
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