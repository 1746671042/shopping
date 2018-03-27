<?php
namespace app\admin\model;
use think\Model;
class Product extends Model{
    //自动写入时间戳
    protected $autoWriteTimestamp = true;
    //输出数据转换
    protected  $resultSetType = 'collection';
    protected $field = true;
    protected $autoCheckFields =false;  
    
    //关联库存单位
    public function Invertory(){
        return $this->belongsTo("Invertory","id","shu_id");
    }
    
    //关联库存状态
    public function State(){
        return $this->belongsTo("State","id","is_subtract");
    }
    
     //关联库存状态
    public function Dimensional(){
        return $this->belongsTo("Dimensional","id","lenght_unit_id");
    }
     //关联重量单位
    public function Weight(){
        return $this->belongsTo("Weight","id","weight_unit_id");
    }
}