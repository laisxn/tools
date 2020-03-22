<?php

use App\models\User;
use App\traits\AdminLog;
use Yaf\Application;
use Yaf\Controller_Abstract as Controller;
use Log\log;

class IndexController extends Controller
{
    use AdminLog;
    public function init()
    {
        echo  12;
        dd(1);
    }

    public function indexAction()
    {

        $pdf = new Dompdf\Pdf();

        $pdf_name = 1234 . '.pdf';

        $pdf_dir = Yaf\Registry::get('config')->project->resource_dir . 'pdf/';

        $pdf_path = $pdf_dir . $pdf_name;


        $pdf->setFileDir($pdf_dir);
        $pdf->setPdfData([1]);
        $pdf->setHtmlFunc('deliveryHtml');

        $pdf->createPdf(formatFileName($pdf_name));

        echo phpinfo();
    }


    public function barcode() {
        $barcode = new Barcodegen\Barcode();
        $file_name = 12314115 . '.png';

        $barcode->setFileDir(Yaf\Registry::get('config')->project->resource_dir . 'barcode/');
        $barcode->setContent(12314115);
        $file_path = $barcode->createBarcode($file_name);
    }

    public function testDbAction()
    {
        $userModel = new User();
        $userModel->name = 'test';
        $userModel->mobile = '12345678910';
        $a = $userModel->get()->toArray();
        dd($a);
    }
}
