<?php
namespace app\admin\validate;
use think\Validate;
class Role extends Validate{
    protected $rule = [
        //
       'name|职业名称'  =>  'require|max:100',
       'description|描述' =>  'require|max:100',
       'is_super|是否超级管理员' =>  'require|number',
    ];
     protected $message  =   [
        'name.require' => '职业名称不能为空',
        'name.lenght'     => '职业名不符合规范',
        'description.length'  => '职业介绍长度不符合规范',
        'password1.require'  => '重复密码不能为空',
        'is_super.require'        => '是否超级管理员不能为空', 
        'is_super.number'        => '是否超级管理员只能为数字', 
    ];

}
