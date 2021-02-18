<?php
class sessionManager  extends model
{

    static function createSession($array = [])
    {
        foreach ($array as $key => $value)
        {
            $_SESSION[$key] = helper::cleaner($value);
        }
    }

    static function deleteSession($key)
    {
        unset($_SESSION[$key]);
    }

    static function allSessionDelete()
    {
        session_destroy();
    }

    public function isLogged()
    {
       if(isset($_SESSION['id']) and isset($_SESSION['parola']))
       {
           $id = $_SESSION['id'];
           $parola = $_SESSION['parola'];
           $query = $this->db->prepare("select * from calisan where id =? and parola = ? ");
           $query->execute(array($id,$parola));


           if($query->rowcount()!=0)
           {
               return true;
           }
           else
           {
               return false;
           }
       }
       else
       {
           false;
       }
    }

    public function getUserInfo()
    {
        if($this->isLogged())
        {
            $id = $_SESSION['id'];
            $parola = $_SESSION['parola'];
            $query = $this->db->prepare("select * from calisan where id =? and parola = ? ");
            $query->execute(array($id,$parola));
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }




}