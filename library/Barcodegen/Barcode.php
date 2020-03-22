<?php
namespace Barcodegen;

require_once "class/BCGcode128.barcode.php";
require_once "class/BCGDrawing.php";
require_once "class/BCGColor.php";

class Barcode
{

    protected $file_dir = '';

    protected $content = '';

    public function __construct()
    {

    }

    /**
     * 设置保存路径
     * @param $dir
     */
    public function setFileDir($dir)
    {
        $this->file_dir = $dir;
    }

    /**
     * 设置条形码内容
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * 生成订单条形码
     * @param $file_name
     * @return string
     * @throws \BCGArgumentException
     * @throws \BCGDrawException
     */
    public function createBarcode($file_name)
    {

        $color_white = new \BCGColor(255, 255, 255); //定义颜色

        $drawing = new \BCGDrawing('', $color_white); //赋值颜色

        $code = new \BCGcode128();

        //$font = new \BCGFontFile('Public/font/Arial.ttf', -1000); //字体大小

        //$code->setFont($font); //文字大小

        $code->setThickness(30); //条码厚度

        $code->parse($this->content); //条形码内容

        $drawing->setBarcode($code);

        $imgUrl = $this->file_dir . $file_name; //图片路径

        $drawing->setFilename($imgUrl); //存放路径

        $drawing->draw(); //渲染图片

        $drawing->finish($drawing::IMG_FORMAT_PNG);  //生成图片

        return $imgUrl;
    }

}