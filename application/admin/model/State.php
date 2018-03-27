<?php
namespace app\admin\model;
use think\Model;

//库存单位

class State extends Model{
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //输出数据转换
    protected  $resultSetType = 'collection';
    //相互关联
    public function Product(){
        return $this->hasMany("Product","is_subtract","id");
    }
}