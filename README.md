# php-plug

实例：
index.php


require_once './Timer/Times.php';

require_once './Excelr/ExcelIndex.php';

$times = new \Timer\Times();

$times::thisWeek();

# **~~_导出数据到excel_~~**

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

$excel->Export($data,['一','二','三','四','五'],'测试',['A', 'B', 'C', 'D', 'E']);

# **~~_导入excel数据到数据库_~~**
$res = $excel->Import('test1.xls');

var_dump($res);

$res是一个二维数组

循环也好，一次插入多条也好，反正这里是你的sql语句