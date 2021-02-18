<?php
class musterilerModel extends model
{
    public function listview()
    {
        $query = $this->db->prepare("select * from musteri");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($adi,$soyadi,$telefon,$dogum_tarihi,$adres)
    {
        $query = $this->db->prepare("CALL musteri_ekle(?,?,?,?,?)");
        //$dogum_tarihi = date("d-m-Y");
        $insert = $query->execute(array($adi,$soyadi,$telefon,$dogum_tarihi,$adres));
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
        $query = $this->db->prepare("select * from musteri where id = ?");
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateData($id,$adi,$soyadi,$telefon,$dogum_tarihi,$adres)
    {
        $query = $this->db->prepare("update musteri set adi = ? , soyadi = ? , telefon_no = ? ,dogum_tarihi = ? ,adres = ? where id = ?");
        $update = $query->execute(array($adi,$soyadi,$telefon,$dogum_tarihi,$adres,$id));
        if($update)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function delete($id)
    {
        $query = $this->db->prepare("delete from musteri where id = ?");
        $query->execute(array($id));
    }
}