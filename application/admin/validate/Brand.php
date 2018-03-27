<?php
namespace app\admin\validate;
use think\Validate;
class Brand extends Validate{
    protected $rule = [
        //
       'title|商品名称'  =>  'require|max:100',
       'logo|图标' =>  'require|max:100',
       'site|官网' =>  'require|max:100',
    ];
     protected $message  =   [
        'title.require' => '商品不能为空',
        'title.max'     => '商品名称超出范围',
        'logo.require'  => '图标不能为空',
        'logo.max'  => '图标路径超出范围',
        'site.require'   => '官网不能为空',
    ];

}