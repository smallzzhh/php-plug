<?php
/**
 * Created by PhpStorm.
 * User: smallzz
 * Date: 2019/3/29
 * Time: 9:57
 */
require_once './Timer/Times.php';
require_once './Excelr/ExcelIndex.php';
$times = new \Timer\Times();

$excel = new \Excelr\ExcelIndex();

var_dump($excel::Export());