<?php
return array(
    'not_delete'=>['title','thumb','keywords','description','content'],
    'file_type'=>[
        'text'=>'文本框',
        'img'=>'单图片',
        'images'=>'多图片',
        'number'=>'整数',
        'float'=>'浮点数(默认两个小数点)',
        'textarea'=>'多文本',
        'layedit'=>'富文本',
        'files'=>'文件上传',
    ],
    'filed_type'=>[
        'text'=>'char|80|0',
        'img'=>'char|100|0',
        'images'=>'tinyint|1',
        'number'=>'int|10|0',
        'float'=>'decimal|0|2',
        'textarea'=>'text|255',
        'layedit'=>'longtext',
        'files'=>'char|100|0'
    ],
    'number_init'=>[ //默认值是否是整数的字段类型
        'number',
    ],
    'number_float'=>[ //默认值是否是浮点数的字段类型
        'float'
    ],
    'not_default'=>[ //禁止默认值的字段
        'images','files'
    ]
)
?>