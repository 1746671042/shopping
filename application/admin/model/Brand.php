<?php
namespace app\admin\model;
use think\Model;
class Brand extends Model{
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //输出数据转换
    protected  $resultSetType = 'collection';
    //相互关联
//    public function role(){
//        return $this->belongsTo("role","role_id","id");
//    }
    protected $field = true;
}