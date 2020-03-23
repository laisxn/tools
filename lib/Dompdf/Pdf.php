<?php

namespace Dompdf;

class Pdf
{

    protected $base_path = '';

    protected $file_dir = '';

    protected $html_func_name = '';

    public $pdf_data = [];


    public function __construct() {

        require_once 'Autoload.php';
    }

    /**
     * 设置模板引用文件基础目录
     * @param $path
     */
    public function setBasePath($path) {
        $this->base_path = $path;
    }

    /**
     * 设置文件保存目录
     * @param $path
     */
    public function setFileDir($dir) {
        $this->file_dir = $dir;
    }

    /**
     * 设置pdf内置数据
     * @param $data
     */
    public function setPdfData($data) {
        $this->pdf_data = $data;
    }

    /**
     * 设置模板
     * @param $function_name
     * @throws \Exception
     */
    public function setHtmlFunc($function_name) {
        if (!method_exists($this, $function_name)) {
            throw  new \Exception('html模板方法不存在');
        }

        $this->html_func_name = $function_name;
    }

    /**
     * 设置模板数据
     * @return mixed
     */
    protected function setHtml() {
        return call_user_func_array([$this, $this->html_func_name], []);
    }

    /**
     * 创建pdf
     * @param $file_name
     * @param null $callback
     * @return string
     */
    public function createPdf($file_name, $callback = null) {
        if ($callback instanceof \Closure) {
            $callback();
        }
        return $this->createPdfByDompdf($file_name);
    }

    /**
     * 创建dompdf
     * @param $file_name
     * @return string
     */
    public function createPdfByDompdf($file_name) {

        $html = $this->setHtml();

        $dompdf = new \Dompdf\Dompdf();

        $dompdf->loadHtml($html);

        $dompdf->setPaper('a4', 'landscape');

        $dompdf->setBasePath($this->base_path);

        $options = new \Dompdf\Options();

        $options->set('isHtml5ParserEnabled', true);

        $options->set('isRemoteEnabled', true);

        $dompdf->render();

        $pdf = $this->file_dir . $file_name;

        file_put_contents($pdf, $dompdf->output());

        return $pdf;
    }

    /**
     * pdf模板
     * @return string
     * @throws \Exception
     */
    protected function deliveryHtml() {
        if (!$this->pdf_data) {
            throw new \Exception('没有设置pdf填充数据');
        }

        $str = '';
        foreach ($this->pdf_data['list'] as $value) {
            $str .= "	<tr>
                            <td>{$value['number']}</td>
                            <td>{$value['name']}</td>
                            <td>{$value['sku']}</td>
                            <td>{$value['num']}</td>
                            <td></td>
                            <td></td>
                        </tr>";

        }
        return <<<EOT

<!DOCTYPE html>
<html>
<head>
	<title>售后单</title>
	<meta charset="utf-8">
	<style>
		.wrap{
			width: 1000px;
			margin: auto;
			text-align: center;
		}
		tr{
			height: 40px;
		}
		* {
			font-family: "simsun"
		}
		table{
			table-layout: fixed;
		}
		td{
			word-break: break-all;
			word-wrap:break-word;
		}
	</style>
</head>
<body>
<div style="position: relative" class="wrap">
	<h2 style="text-align: center">售后单</h2>
	<h4 style="text-align: center">单子</h4>
	<img src="" alt="" style="position: absolute;right: 250px;top: 30px">
</div>
<table class="wrap" border="1" cellspacing="0">
	<tr>
		<th>日期</th>
		<td>{$this->pdf_data['delivery_date']}</td>
		<th>信息</th>
		<td colspan="3">收件人：{$this->pdf_data['tech_name']}<br>手机：{$this->pdf_data['tech_mobile']}</td>
	</tr>
	<tr>
		<th>地址</th>
		<td colspan="5">地址：{$this->pdf_data['tech_addr']}</td>
	</tr>
	<tr>
		<th>订单号</th>
		<th>名称</th>
		<th>编号</th>
		<th>数量</th>
		<th>备注</th>
		<th>是否特殊</th>
	</tr>
	{$str}
	<tr>
		<td>{$this->pdf_data['list'][0]['number']}</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>{$this->pdf_data['list'][0]['number']}</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<th colspan="6">注：详见文档说明</th>
	</tr>
	<tr>
		<th colspan="6"> 联系电话：1234567800</th>
	</tr>
	<tr>
		<th colspan="6">谢谢</th>
	</tr>
</table>
</body>
</html>

EOT;

    }

}