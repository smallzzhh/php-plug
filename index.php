<?php
/**
 * 示例
 * Created by PhpStorm.
 * User: smallzz
 * Date: 2019/3/29
 * Time: 9:57
 */
require_once './Timer/Times.php';
require_once './Excelr/ExcelIndex.php';
$times = new \Timer\Times();
$times::thisWeek();

$excel = new \Excelr\ExcelIndex();
$data = [
    0=>[
        'a'=>'1',
        'b'=>'11',
        'c'=>'111',
        'd'=>'1111',
        'e'=>'11111',
    ],
    1=>[
        'a'=>'2',
        'b'=>'22',
        'c'=>'222',
        'd'=>'2222',
        'e'=>'22222',
    ],
     1=>[
        'a'=>'3',
        'b'=>'33',
        'c'=>'333',
        'd'=>'3333',
        'e'=>'33333',
    ]
];
//var_dump($excel->Export($data,['一','二','三','四','五'],'测试',['A', 'B', 'C', 'D', 'E']));
//$res = $excel->Import('test1.xls');
//var_dump($res);