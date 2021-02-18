<?php
class excel extends controller
{
    public function export()
    {
        require_once 'Classes/PHPExcel.php';
        $Excel = new PHPExcel();
        $tumUrunler = $this->model('urunlerModel')->listView();
        $Excel->getActiveSheet()->setTitle('Sayfa1');
        $Excel->getActiveSheet()->setCellValue('A1','Urun Modeli');
        $Excel->getActiveSheet()->setCellValue('B1','Urun Markası');
        $Excel->getActiveSheet()->setCellValue('C1','Urun Kategori');

        $a = 2;
        foreach ($tumUrunler as $key => $value)
        {
            $kategoriData = $this->model('categoryModel')->getData($value['kategoriId']);
            $Excel->getActiveSheet()->setCellValue('A'.$a,$value['modeli']);
            $Excel->getActiveSheet()->setCellValue('B'.$a,$value['markasi']);
            $Excel->getActiveSheet()->setCellValue('C'.$a,$kategoriData['ad']);
            $a++;
        }


        $Kaydet = PHPExcel_IOFactory::createWriter($Excel,'Excel2007');
        $filename = rand(1,9000).".xlsx";
        $Kaydet->save($filename);
    }


    public function importForm()
    {
        $this->render('site/header');
        $this->render('site/sidebar');
        $this->render('urunler/import');
        $this->render('site/footer');
    }

    public function import()
    {

        $tmp_name = $_FILES['file']['tmp_name'];
        require_once 'Classes/PHPExcel.php';
        $Excel = new PHPExcel();
        $objPHPExcel = PHPExcel_IOFactory::load($tmp_name);
        foreach ($objPHPExcel->getWorksheetIterator() AS $worksheet)
        {
            $worksheetTitle = $worksheet->getTitle();
            $highestRow = $worksheet->getHighestRow(); // 10 , 11
            $highestColumn = $worksheet->getHighestColumn(); //  A ,B, C
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

            for ($row =2;$row <=$highestRow;++$row)
            {
                $cell = $worksheet->getCellByColumnAndRow(0,$row);
                $urunlerModeli =  $cell->getValue();
                $cell = $worksheet->getCellByColumnAndRow(1,$row);
                $urunlerMarkasi =  $cell->getValue();
                $cell2 = $worksheet->getCellByColumnAndRow(2,$row);
                $kategori = $cell2->getValue();
                $kategoriId = $this->model('categoryModel')->getExcelId($kategori);

                $this->model('urunlerModel')->createExcel($urunlerModeli,$urunlerMarkasi,$kategoriId);

            }

        }

        helper::flashData("statu","Ürün Başarı ile Aktarıldı");
        helper::redirect(SITE_URL."/excel/importForm");
    }


}