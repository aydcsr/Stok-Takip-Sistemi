<?php
class stokModel extends model
{
    public function listview()
    {
        $query = $this->db->prepare('select * from stok');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($urun_id,$musteri_id,$islem_tipi,$adet,$fiyat,$kasa_id)
    {
        $query = $this->db->prepare("insert into stok(urun_id,musteri_id,islem_tipi,adet,fiyat,date,kasa_id)values(?,?,?,?,?,?,?)");
        $date = date("Y-m-d");
        $insert = $query->execute(array($urun_id,$musteri_id,$islem_tipi,$adet,$fiyat,$date,$kasa_id));
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
        $query = $this->db->prepare("select * from stok where id = ?");
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateData($id,$urun_id,$musteri_id,$islem_tipi,$adet,$fiyat,$kasa_id)
    {
        $query = $this->db->prepare("update stok set urun_id = ? ,musteri_id = ? ,islem_tipi = ? ,adet = ? ,fiyat = ?,kasa_id = ? where id = ?");
        $update = $query->execute(array($urun_id,$musteri_id,$islem_tipi,$adet,$fiyat,$kasa_id,$id));
        if($update)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function stoktaVarmi($urunid)
    {
        $query = $this->db->prepare("select stokadet(?)");
        $query->execute(array($urunid));
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getDelete($id)
    {
        $query = $this->db->prepare("delete from stok where id = ?");
        $query->execute(array($id));
    }
    public function En_cok_satılan_urun()
    {
        $query = $this->db->prepare("CALL En_cok_satılan_urun()");
        $query->execute(array());
        $value = $query->fetch(PDO::FETCH_ASSOC);
        return $value;
    }


}