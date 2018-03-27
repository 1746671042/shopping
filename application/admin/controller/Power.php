<?php
namespace app\admin\controller;
use think\Controller;
use  app\admin\model\Power as PowerModel;
use think\Loader;
use think\Request;
class Power extends Controller{
    //权限列表
    public function index(){
        //第一种查找下一级（复杂)
        $powerModel = new PowerModel();
//        $one = $powerModel->where("parent_id",0)->select();
//        foreach($one as $k=>$v){
//            $one[$k]["child"]=$powerModel->where("parent_id",$v->id)->select();
//        }
        
        //第二种
//        $list = $powerModel->select();
//        if(!empty($list)){
//                $data = array();
//                foreach($list as $k=>$v){
//                    $data[$v["parent_id"]][]=$v;
//                }
//        //        获取一级的 
//                $list=array();
//                foreach($data[0] as $v){
//                    if(isset($data[$v["id"]])){
//                    $v["child"] = $data[$v["id"]];
//                    }else{
//                    $v["child"]=array();
//                    } 
//                    $list[]=$v;
//                }
//        
//        }
        
        
        //第三种  递归（函数中嵌套函数）
        //第一级数据（第一种）
        //        $one = $powerModel->where("parent_id",0)->select();
        //        $list=array();
        //        foreach($one as $k=>$v){
        //            $list[] = $this->menutree($v);
        //        }
        
        
        
        
        //（第二种）
        //查询第一级
         $one = $powerModel->where("parent_id",0)->select()->toArray();
         //查询所有
         $all = $powerModel->select()->toArray();
         $list = array();
         foreach($one as $k=>$v){
            $list[] = $this->menutree($v,$all);
        }
         
         
         
//        var_dump($list);
//        exit();
//      $list = PowerModel::all();
      $this->assign("list",$list);
      return $this->fetch();
    }
    
    
    
//    递归第一种（1）
    //查询树状结构
//    protected  function menutree($info){
//        
//        $powerModel = new PowerModel();
//        $two = $powerModel->where("parent_id",$info["id"])->select();
//        if($two !=null){
//            foreach($two as $k=>$v){
//                $two[$k] = $this->menutree($v);
//            }
//        }
//        //一级
//        $info["child"]=$two;
//        return $info;
//    }

    
    
    
//    第二种（递归)
    protected  function menutree($info,$all){
        foreach($all as $k=>$v){
            if($v["parent_id"]==$info["id"]){
                $v = $this->menutree($v, $all);
                $info["child"][]=$v;
            }
        }
        return $info;
    }


    public function add(){
        return $this->fetch();
    }
    
     
    //增加权限
    public function insert(){
        //获取form 表单提交的所有数据
        $data = input("post.");
        //加载验证规则
        $validate = Loader::validate('Power');
        if(!$validate->check($data)){
           $this->error($validate->getError());
        }else{
            $power = new PowerModel;
            //添加数据并排除password1;
            if($power->save($data)){
//                var_dump($data);
                $this->success("添加成功！","admin/power/index");
            }else{
                $this->error("添加失败！");
            }
        }

    }
    
    public function addChild($parent_id){
        $this->assign("info",PowerModel::get($parent_id));
        return $this->fetch();
    }
    
    //删除
    public function delete($parent_id){
        $powerModel = new PowerModel();
        $ret = $powerModel->where("id",$parent_id)->delete();
        if($ret){
            $this->success("删除成功！","admin/power/index");
        }else{
            $this->error("删除失败！请重试。");
        }
    }
    
    //修改
    public function update($parent_id){
        $powerModel = new PowerModel();
        
       //提交数据时保存数据
        //1判断是否提交form
        $type = $powerModel->where("id",$parent_id)->find();
        
        if(Request::instance()->isPost())
        {
            
            //为true  表单提交数据入库
            $data = Request::instance()->Post();
//            var_dump($data);
            die();
            $del = $powerModel->where("id",$parent_id)->delete();
            $data = $powerModel->save($data);
            if($data){
                $this->success("修改成功!","admin/power/index");
            }else{
                $this->error("修改失败");
            }
        }else{
            //添加页面  
            $list = $powerModel->select();
//            var_dump($type);
//            exit();
            $list = $this->tree($list);
            $this->assign("type",$type);
            $this->assign("list",$list);
            return $this->fetch();
        }
    }

    
    
     //递归调用
    public function tree($list,$parent_id=0,$level=1,$biaozhi=""){
        //$biaozhi 为前面的空格
        $data=array();
        foreach($list as $k=>$v){
            if($v["parent_id"]==$parent_id){
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
