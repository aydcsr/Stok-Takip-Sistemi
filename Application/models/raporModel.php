<?php
class raporModel extends model
{
    public function girenUrunToplam($id)
    {
        $query = $this->db->prepare("CALL girenUrunToplam(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['toplam']);
    }
    public function cikanUrunToplam($id)
    {
        $query = $this->db->prepare("CALL cikanUrunToplam(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['toplam']);
    }

    public function girenUrunAdet($id)
    {
        $query = $this->db->prepare("CALL girenUrunAdet(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['SUM(adet)']);
    }

    public function cikanUrunAdet($id)
    {
        $query = $this->db->prepare("CALL cikanUrunAdet(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['SUM(adet)']);
    }

    public function toplamAlinanUrun($id) // musteri _id
    {
        $query = $this->db->prepare("CALL toplamAlinanUrun(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['SUM(adet)']);
    }

    public function toplamSatilanUrun($id) // musteri _id
    {
        $query = $this->db->prepare("CALL toplamSatilanUrun(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['SUM(adet)']);
    }

    public function toplamKazanilanPara($id) // musteri_id
    {
        $query = $this->db->prepare("CALL toplamKazanilanPara(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['toplam']);

    }

    public function toplamKaybedilenPara($id) // musteri_id
    {
        $query = $this->db->prepare("CALL toplamKaybedilenPara(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['toplam']);

    }

    public function toplamGelir()
    {
        $query = $this->db->prepare("CALL toplamGelir()");
        $query->execute();
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['toplam']);
    }

    public function toplamGider()
    {
        $query = $this->db->prepare("CALL toplamGider()");
        $query->execute();
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['toplam']);
    }

    public function filtrele($firstDate,$secondDate)
    {
        $query = $this->db->prepare("select * from stok where date BETWEEN ? and ? group by urun_id");
        $query->execute(array($firstDate,$secondDate));
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }



    public function girenUrunToplamKasa($id)
    {
        $query = $this->db->prepare("CALL girenUrunToplamKasa(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['toplam']);

    }
    public function cikanUrunToplamKasa($id)
    {
        $query = $this->db->prepare("CALL cikanUrunToplamKasa(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['toplam']);
    }

    public function girenUrunAdetKasa($id)
    {
        $query = $this->db->prepare("CALL girenUrunAdetKasa(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['SUM(adet)']);
    }

    public function cikanUrunAdetKasa($id)
    {
        $query = $this->db->prepare("CALL cikanUrunAdetKasa(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['SUM(adet)']);
    }


    public function faturaGelir($id) // musteriid
    {
        $query = $this->db->prepare("CALL faturaGelir(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['SUM(tutar)']);
    }

    public function faturaGider($id) // musteriid
    {
        $query = $this->db->prepare("CALL faturaGider(?)");
        $query->execute(array($id));
        $sonuc = $query->fetch(PDO::FETCH_ASSOC);
        return doubleval($sonuc['SUM(tutar)']);
    }

    public  function mail_info($musteri_id)
    {
        $query = $this->db->prepare("CALL mail_info(?)");
        $query->execute(array($musteri_id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }


}