<?php

namespace app\admin\model;
use think\Model;
class Role extends Model{
     //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //输出数据转换
    protected  $resultSetType = 'collection';
    public function admin(){
        return $this->hasMany("Admin","role_id","id");
    }
}