<?php
use Api\ApiCommonController;

class ToolController extends ApiCommonController
{
    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        echo 'welcome';
    }

    public function loginAction()
    {
        echo 'ok';
    }

    /**
     * 创建条形码
     * @throws BCGArgumentException
     * @throws BCGDrawException
     */
    public function barcode()
    {
        $barcode = new Barcodegen\Barcode();
        $file_name = 12314115 . '.png';

        $barcode->setFileDir(Yaf\Registry::get('config')->project->resource_dir . 'barcode/');
        $barcode->setContent(12314115);
        $file_path = $barcode->createBarcode($file_name);

        echo $file_path;
    }

    /**
     * 生成pdf
     * @throws Exception
     */
    public function pdf()
    {
        $pdf = new Dompdf\Pdf();

        $pdf_name = 1234 . '.pdf';

        $pdf_dir = Yaf\Registry::get('config')->project->resource_dir . 'pdf/';

        $pdf_path = $pdf_dir . $pdf_name;

        $pdf->setFileDir($pdf_dir);
        $pdf->setPdfData([1]);
        $pdf->setHtmlFunc('deliveryHtml');
        $pdf->createPdf(formatFileName($pdf_name));

        echo $pdf_path;
    }

}
