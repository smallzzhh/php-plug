<?php
/**
 * Created by PhpStorm.
 * User: smallzz
 * Date: 2019/3/29
 * Time: 9:40
 */

namespace Excelr;


class ExcelIndex
{
    private $excel = null;
    private $cellArr = [];

    function __construct()
    {
        require __DIR__ . "./Classes/PHPExcel.php";
        $this->excel = new \PHPExcel();
        $this->cellArr = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ'];

    }

    /**
     * @param $data         （必须）数据（二维数组）【只能存在要导出的数据】
     * @param $title        （必须）列标中文 ['标题1', '标题1', '标题1', '标题1', '标题1', '标题1']
     * @param $filename     （必须）文件名称
     * @param $cellNames    （必须）列标英文 ['A', 'B', 'C', 'D', 'E', 'F']
     * @param $arr_hb       （可选）是否合并单元格 参数：['A' => 'order_sn', 'B' => 'order_sn']
     * @throws \PHPExcel_Exception
     */
    public function Export($data, $title, $filename, $cellNames, $arr_hb)
    {
        $cellName = [];
        foreach ($cellNames as $key => $val) {
            foreach ($this->cellArr as $k => $v) {
                $cellName[] = $val . $v;
            }
        }
        $cellName = array_merge($this->cellArr, $cellName);
        /* 设置宽度 */
        //$objPHPExcel->getActiveSheet()->getColumnDimension()->setAutoSize(true);
        $this->excel->getActiveSheet(0)->mergeCells('A1:AC1');              //合并单元格
        $this->excel->getactivesheet()->setCellValue('A1', $filename); //设置标题
        //设置SHEET
        $this->excel->setactivesheetindex(0);
        $this->excel->getActiveSheet()->setTitle('sheet1');
        $_row = 2;   //设置纵向单元格标识
        foreach ($title as $k => $v) {
            $this->excel->getactivesheet()->setCellValue($cellName[$k] . $_row, $v);
        }
        $i = 1;
        foreach ($data AS $_v) {
            $j = 0;
            foreach ($_v AS $_cell) {
                if ($cellName[$j] == 'A' || $cellName[$j] == 'F' || $cellName[$j] == 'L') { //科学转换
                    $this->excel->getActiveSheet()->setCellValue($cellName[$j] . ($i + $_row), "\t" . $_cell . "\t");
                } else {
                    $this->excel->getActiveSheet()->setCellValue($cellName[$j] . ($i + $_row), $_cell);
                }
                $j++;
            }
            $i++;
        }
        //是否合并单元格
        if (!empty($arr_hb) && !empty($arr)) {
            foreach ($arr_hb as $k1 => $v1) {
                $lert = $this->_remerge($arr, $k1, $v1);
                foreach ($lert as $aa) {
                    $this->excel->getActiveSheet()->mergeCells($aa);
                }
            }
        }
        //输出到浏览器
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header('Content-Disposition:attachment;filename="' . $filename . '.xlsx"');
        header("Content-Transfer-Encoding:binary");
        $objWriter = \PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    /**
     * 导入
     */
    public function Import()
    {

    }

    private function _remerge($arr, $let, $field)
    {
        $letr = [];$year = $arr[0][$field];$s = 3;$e = 2;
        foreach ($arr as $k => $v) {
            if ($v[$field] != $year) {$letr[] = "$let" . $s . ":$let" . $e . "";$e++;
                $year = $v[$field];$s = $e;
            } else {$e++;if (count($arr) == ($k + 1)) {$letr[] = "$let" . $s . ":$let" . $e . "";}}
        }
        return $letr;
    }
}