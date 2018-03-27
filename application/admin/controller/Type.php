<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use app\admin\model\Type as typeModel;
class Type extends Controller{
    //列表
    public function index(){
         $typeModel = new typeModel();
         $list = $typeModel->select();
         $list = $this->tree($list);
         $this->assign("list",$list);
        return $this->fetch();
    }

   //显示页面+保存数据
    public function add(){
         $typeModel = new typeModel();
        //提交数据时保存数据
        //1判断是否提交form
        if(Request::instance()->isPost())
        {
            //为true  表单提交数据入库
            $data = Request::instance()->Post();
           
            $data = $typeModel->save($data);
            if($data){
                $this->success("添加成功!","admin/type/index");
            }else{
                $this->error("添加失败");
            }
        }else{
            //添加页面  
            $list = $typeModel->select();
            $list = $this->tree($list);
            $this->assign("list",$list);
            return $this->fetch();
        }
        
    }
    
     //修改
    public function update($id){
        $typeModel = new typeModel();
        //提交数据时保存数据
        //1判断是否提交form
        $type = $typeModel->where("id",$id)->find();
        if(Request::instance()->isPost())
        {
            //为true  表单提交数据入库
            $data = Request::instance()->Post();
            
            $typeModel->where("id",$id)->delete();
            $data = $typeModel->save($data);
            if($data){
                $this->success("修改成功!","admin/type/index");
            }else{
                $this->error("修改失败");
            }
        }else{
            //添加页面  
            
            $list = $typeModel->select();
            $list = $this->tree($list);
            $this->assign("type",$type);
            $this->assign("list",$list);
            return $this->fetch();
        }
    }
     
    public function delete($id){
        $typeModel = new typeModel();
        if($id){
            $del = $typeModel->where("id",$id)->delete();
            if($del){
                $this->success("删除成功","admin/type/index");
            }else{
                $this->error("删除失败");
            }
        }
    }
    
    //递归调用
    public function tree($list,$pid=0,$level=1,$biaozhi=""){
        //$biaozhi 为前面的空格
        $data=array();
        foreach($list as $k=>$v){
            if($v["pid"]==$pid){
                $v["level"]=$level;
                $v["name"]=$biaozhi.$v["name"];
                $data[]=$v;
                $child = $this->tree($list,$v["id"],$level+1,$biaozhi."&nbsp;&nbsp;&nbsp;&nbsp;");
                $data = array_merge($data,$child);
            }
        }
        return $data;
    }
  
    
   
}
