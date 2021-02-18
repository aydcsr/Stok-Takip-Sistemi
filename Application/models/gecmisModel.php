<?php
class gecmisModel extends model
{
    public function listview()
    {
        $query = $this->db->prepare('select * from gecmis where islem_yeri = "urun"');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}