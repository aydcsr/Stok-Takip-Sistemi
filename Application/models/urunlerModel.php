<?php
class urunlerModel extends model
{

    public function listview()
    {
        $query = $this->db->prepare('select * from urun');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($kategoriId,$modeli,$markasi)
    {

        $query = $this->db->prepare("insert into urun(kategoriId,modeli,markasi)values(?,?,?)");
        $insert = $query->execute(array($kategoriId,$modeli,$markasi));
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
        $query = $this->db->prepare("select * from urun where id = ?");
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function updateData($id,$kategoriId,$modeli,$markasi)
    {
        $query = $this->db->prepare("update urun set kategoriId = ?, modeli = ? ,markasi = ? where id = ? ");
        $update  = $query->execute(array($kategoriId,$modeli,$markasi,$id));
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
        $query = $this->db->prepare("delete from urun where id = ?");
        $query->execute(array($id));
    }

    public function ara($name)
    {
        $query = $this->db->prepare("select * from urun where modeli like ? ");
        $query->execute(array("%".$name."%"));
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function createExcel($urunlerModeli,$urunlerMarkasi,$kategoriId)
    {

        $query = $this->db->prepare("select * from urun where modeli = ?");
        $query->execute(array($urunlerModeli));
        if($query->rowcount()==0) {

            $query = $this->db->prepare("insert into urun(kategoriId,modeli,markasi)values(?,?,?)");
            $insert = $query->execute(array($kategoriId,$urunlerModeli,$urunlerMarkasi));
            if ($insert) {
                return true;
            } else {
                return false;
            }
        }
    }
}