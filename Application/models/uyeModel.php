<?php
class uyeModel extends  model
{
    public function control($id, $parola)
    {
        $query = $this->db->prepare("select * from calisan where id =? and parola = ? ");
        $query->execute(array($id,$parola));
        return $query->rowcount();
    }

    public function permission($id,$dept)
    {
        $data = $this->getData($id);
        if($data['unvan']=="" || $data['unvan'] == "mudur")
        {
            return true;
        }
        else if($data['unvan'] == "kasa_calisani"){
            if($dept == "category" || $dept == "urun" || $dept == "calisan")
            {
                return false;
            }
            else{return true;}

        }
        else if($data['unvan'] == 'kasa_calisani') {
            if ($dept == "rapor" || $dept == "calisan") {
                return false;
            } else {
                return true;
            }
        }
        else {
            return true;
        }
    }

    public function listview()
    {
        $query = $this->db->prepare('select * from calisan');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($adi,$soyadi,$unvan,$parola)
    {
        $query = $this->db->prepare("insert into calisan(adi,soyadi,parola,unvan)VALUES (?,?,?,?)");
        $insert = $query->execute(array($adi,$soyadi,$unvan,$parola));
        if($insert)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getData($id)
    {
        $query = $this->db->prepare("select * from calisan where id = ?");
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function updateData($id,$adi,$soyadi,$parola,$unvan)
    {
        $query = $this->db->prepare("update calisan set adi = ? ,soyadi = ? ,unvan = ? , parola = ?  where id = ?");
        $update = $query->execute(array($adi,$soyadi,$unvan,$parola,$id));
        if($update)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getDelete($id)
    {
        $query = $this->db->prepare("delete from calisan where id = ?");
        $query->execute(array($id));
    }
}