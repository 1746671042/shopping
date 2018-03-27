<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends Validate{
    protected $rule = [
        //
       'username|用户名'  =>  'require|length:6,25|alphaNum',
       'password|密码' =>  'require|length:6,25|confirm:password1',
       'password1|重复密码' =>  'require|length:6,25|confirm:password',
        //不为空
       'role_id' =>  'require|number',
    ];
     protected $message  =   [
        'username.require' => '用户名不能为空',
        'username.lenght'     => '用户名位6-25位',
        'password.length'  => '密码长度为6-25位',
        'password1.require'  => '重复密码不能为空',
        'password1.comfirm'   => '两次密码不同',
        'password.comfirm'   => '两次密码不同',
        'password.require'  => '密码不能为空',
        'role_id.require'        => '角色不能为空', 
        'role_id.number'        => '角色只能为数字', 
    ];

}
