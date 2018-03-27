<?php
namespace app\admin\model;
use think\Model;
class Power extends Model{
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //输出数据转换
    protected  $resultSetType = 'collection';
    //密码自动加密
    public function setPasswordAttr($value){
        return md5($value);
    }
    
    //控制器名转换为小写
    public function setControllerAttr($value){
        return strtolower($value);
    }
    //方法名转换为小写
    public function setActionAttr($value){
         return strtolower($value);
    }
    //转换是否显示
    public function getIsShowAttr($value){
        $status=[1=>'是',2=>'否'];
        return $status[$value];
    }

}