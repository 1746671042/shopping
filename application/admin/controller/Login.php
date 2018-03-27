<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
use think\Cookie;
use think\Db;
use app\admin\model\Power;
class Login extends controller{
    public function index(){
        return $this->fetch();
    }
//    验证用户信息
    public function check(){
        $username=input("post.username","");
        $pwd = input("post.password","");
        if(empty($username) || empty($pwd)){
            $this->error("用户名或密码不能为空");
        }
        $info = Admin::where(array("username"=>$username,"password"=>$pwd))->find();
        if($info){
            Cookie::set("admin_id",$info->id,['expire'=>3600]);
            Cookie::set("admin_name",$info->username,['expire'=>3600]);
            //当前用户所拥有的权限
            $checkList =  Db::name("role_power")->field("power_id")->where("role_id",$info->role_id)->select();
//            var_dump($checkList);exit();
            if($checkList !=null){
                $powerStr = array();
                foreach($checkList as $k=>$v){
                    $powerStr[]=$v["power_id"];
                }
                 //获取权限对应地 信息
                $power = new Power();
//                var_dump($checkList);
//                var_dump(join(",",$checkList));
                $powerList = $power->where(["id"=>["in",implode(",",$powerStr)]])->select()->toArray();
                session("power",$powerList);
//                var_dump($powerList);exit();
            }else{
                session("power","");
            }
           
            
            
            $this->success("登陆成功","admin/admin/index");
        }else{
            $this->error("登录失败");
        }
    }
    //退出登录
    public function userout(){
        Cookie::delete("admin_id");
        Cookie::delete("admin_name");
        $this->redirect("admin/login/index");
    }
}
