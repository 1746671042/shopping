<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Role as adminRole;
use app\admin\model\Admin;
use app\admin\model\Power;
use think\Loader;
use think\Db;
class Role extends Controller{
    //管理员列表
    public function index(){
        $list = new adminRole();
        $list = $list->paginate(2);
        $this->assign("list",$list);
        return $this->fetch();
    }
    //打开新增页面
    public function add(){
        return $this->fetch();
    }
    
    //插入数据
    public function insert(){
        $data= input("post.");
        //加载验证规则
        $validate = Loader::validate('Role');
        if(!$validate->check($data)){
           $this->error($validate->getError());
        }else{
            $adminRole = new adminRole;
            //添加数据并排除password1;
            if($adminRole->save($data)){
                $this->success("添加成功！","admin/role/index");
            }else{
                $this->error("添加失败！");
            }
        }
    }
    //删除
    public function delete($id){
        $adminRole = new adminRole;
        $ret = $adminRole->where("id",$id)->delete();
        if($ret){
            $this->success("删除成功！","admin/Role/index");
        }else{
            $this->error("删除失败！请重试。");
        }
    }
    
    //修改
    public function update($id){
        $data = adminRole::get($id);
        $this->assign("list",$data);
//        var_dump($data);
        return $this->fetch("role/update");
    }
    
    //保存修改的信息 
    public function saveUp(){
        $data = input("post.");
        $validate = Loader::validate('Role');
        if(!$validate->check($data)){
           $this->error($validate->getError());
        }else{
            $adminRole = new adminRole;
            //添加数据并排除password1;
            if($adminRole->save($data,["id"=>$data["id"]])){
                $this->success("修改成功！","admin/Role/index");
            }else{
                $this->error("修改失败！");
            }
        }
    }
    
    
    
    //权限与角色对应管理
    public function power($id){
        //调用所有权限
        $all = Power::all()->toArray();
        $one = Power::all(["parent_id"=>0])->toArray();
        
        $list = array();
         foreach($one as $k=>$v){
            $list[] = $this->menutree($v,$all);
        }
        //调取当前角色选中的权限
        $checkList =  Db::name("role_power")->where("role_id",$id)->select();
//        $checkList = array_column($checkList, "power_id");
        foreach($checkList as $k=>$v){
            $check[$v["power_id"]]=$v;
        }
        
        $this->assign("checkList",$check);
        $this->assign("id",$id);
        $this->assign("list",$list);
        $this->assign("one",$one);
        return $this->fetch();
    }
    
     protected  function menutree($info,$all){
        foreach($all as $k=>$v){
            if($v["parent_id"]==$info["id"]){
                $v = $this->menutree($v, $all);
                $info["child"][]=$v;
            }
        }
        return $info;
    }
    
    
    public function poweradd(){
        $data = input("post.");
        $role = $data["role_id"];
        $power = $data["power"];
       
        if(Db::name("role_power")->where("role_id",$role)->delete()){
           $insert = array();
            foreach($power as $k=>$v){
                $insert[]=["role_id"=>$role,"power_id"=>$v];          
            }   
             Db::name("role_power")->insertAll($insert);
            $this->success("设置成功","admin/role/index");
        }else{
            $this->error("操作失败");
        }
        
        
    }

}