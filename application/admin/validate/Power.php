<?php
namespace app\admin\validate;
use think\Validate;
class Power extends Validate{
    protected $rule = [
        //
       'name|名称'  =>  'require',
       'controller|控制器' =>  'require|alpha',
       'action|方法' =>  'require|alpha',
    ];
     protected $message  =   [
        'name.require' => '用户名不能为空',
        
    ];

}
