<?php
namespace app\admin\model;
use think\Model;

//库存单位

class Invertory extends Model{
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //输出数据转换
    protected  $resultSetType = 'collection';
    //密码自动加密
    public function setPasswordAttr($value){
        return md5($value);
    }
    
    //相互关联
    public function Product(){
        return $this->hasMany("Product","sku_id","id");
    }
}