<?php
namespace app\admin\model;
use think\Model;
class Type extends Model{
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //输出数据转换
    protected  $resultSetType = 'collection';
    //密码自动加密
    public function setPasswordAttr($value){
        return md5($value);
    }
    
}