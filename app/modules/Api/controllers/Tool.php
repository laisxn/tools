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
        $this->success();
    }

    public function loginAction()
    {
        $this->success();
    }

    /**
     * 创建条形码
     * @throws BCGArgumentException
     * @throws BCGDrawException
     */
    public function barcodeAction()
    {
        $barcode = new Barcodegen\Barcode();
        $file_name = 12314115 . '.png';

        $barcode->setFileDir(Yaf\Registry::get('config')->project->resource_dir . 'barcode/');
        $barcode->setContent(12314115);
        $file_path = $barcode->createBarcode($file_name);

        $this->success($file_path);
    }

    /**
     * 生成pdf
     * @throws Exception
     */
    public function pdfAction()
    {
        $pdf = new Dompdf\Pdf();

        $pdf_name = 1234 . '.pdf';

        $pdf_dir = Yaf\Registry::get('config')->project->resource_dir . 'pdf/';

        $pdf_path = $pdf_dir . $pdf_name;

        $pdf->setFileDir($pdf_dir);
        $pdf->setPdfData([1]);
        $pdf->setHtmlFunc('deliveryHtml');
        $pdf->createPdf(formatFileName($pdf_name));

        $this->success($pdf_path);
    }

    public function tcppdfAction()
    {
        $pdf = new \TCPDF();
        // 设置文档信息
        $pdf->SetCreator('懒人开发网');
        $pdf->SetAuthor('懒人开发网');
        $pdf->SetTitle('TCPDF示例');
        $pdf->SetSubject('TCPDF示例');
        $pdf->SetKeywords('TCPDF, PDF, PHP');

        // 设置页眉和页脚信息
        $pdf->SetHeaderData('tcpdf_logo.jpg', 30, 'LanRenKaiFA.com', '学会偷懒，并懒出效率！', [0, 64, 255], [0, 64, 128]);
        $pdf->setFooterData([0, 64, 0], [0, 64, 128]);

        // 设置页眉和页脚字体
        $pdf->setHeaderFont(['stsongstdlight', '', '10']);
        $pdf->setFooterFont(['helvetica', '', '8']);

        // 设置默认等宽字体
        $pdf->SetDefaultMonospacedFont('courier');

        // 设置间距
        $pdf->SetMargins(15, 15, 15);//页面间隔
        $pdf->SetHeaderMargin(5);//页眉top间隔
        $pdf->SetFooterMargin(10);//页脚bottom间隔

        // 设置分页
        $pdf->SetAutoPageBreak(true, 25);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        //设置字体 stsongstdlight支持中文
        $pdf->SetFont('stsongstdlight', '', 14);

        //第一页
        $pdf->AddPage();
        $pdf->writeHTML('<div style="text-align: center"><h1>第一页内容</h1></div>');
        $pdf->writeHTML('<p>我是第一行内容</p>');
        $pdf->writeHTML('<p style="color: red">我是第二行内容</p>');
        $pdf->writeHTML('<p>我是第三行内容</p>');
        $pdf->Ln(5);//换行符
        $pdf->writeHTML('<p><a href="http://www.lanrenkaifa.com/" title="">懒人开发网</a></p>');

        //第二页
        $pdf->AddPage();
        $pdf->writeHTML('<h1>第二页内容</h1>');

        //输出PDF
        $pdf->Output('t.pdf', 'I');//I输出、D下载

    }

    public function qrcode()
    {
        $qrCode = new Endroid\QrCode\QrCode('https://www.baidu.com');

        header('Content-Type: '.$qrCode->getContentType());
        echo $qrCode->writeString();
    }

}
