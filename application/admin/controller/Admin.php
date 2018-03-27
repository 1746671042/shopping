<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Role;
use app\admin\model\Admin as adminModel;
use think\Loader;
class Admin extends Controller{
    //管理员列表
    public function index(){
        $list = new adminModel;
        //分页用额外参数
        $query = array();
        //搜索
        $search_username = input("get.search_username","");
        $search_role = input("get.search_role",0);
        if($search_username!=""){
            $list = $list->where("username","like","%{$search_username}%");
            $query["search_username"]=$search_username;
        }
        if($search_role !=0){
            $list->where("role_id",$search_role);
            $query["search_role"]=$search_role;
        }
        //接受排序值
        $order_field = input("get.order_field","username");
        $order = input("get.order","asc");
      
        $orderArr = array();
        if($order_field !="" && $order !=""){
            $list->order($order_field,$order);
            $orderArr[$order_field]=$order;
            $query["order_field"]=$order_field;
            $query["order"]=$order;
        }
        
        //分页
        $list = $list->paginate(2,false,[
            "query"=>$query,
        ]);
//       //手动拼接参数
        $url = "";
        foreach($query as $k=>$v){
            $url =$url."$k=$v&";
        }
        $url = trim($url,"&");
        
        //获取角色表所有
        $role = Role::all();
        $this->assign("role",$role);
        $this->assign("order",$orderArr);
        $this->assign("url",$url);
        $this->assign("query",$query);
        $this->assign("search_role",$search_role);
        $this->assign("search_name",$search_username);
        $this->assign("list",$list);
        return $this->fetch();
    }
    public function add(){
        //调取角色
        $list = Role::all();
        $this->assign("list",$list);
        return $this->fetch();
    }
    
    //增加管理员
    public function insert(){
        //获取form 表单提交的所有数据
        $data = input("post.");
        //加载验证规则
        $validate = Loader::validate('Admin');
        if(!$validate->check($data)){
           $this->error($validate->getError());
        }else{
            $adminModel = new adminModel;
            //添加数据并排除password1;
            if($adminModel->except("password1")->save($data)){
                $this->success("添加成功！","admin/admin/index");
            }else{
                $this->error("添加失败！");
            }
        }

    }
    
    //删除
    public function delete($id){
        $adminModel = new adminModel;
        $ret = $adminModel->where("id",$id)->delete();
        if($ret){
            $this->success("删除成功！","admin/admin/index");
        }else{
            $this->error("删除失败！请重试。");
        }
    }
    
    //修改
    public function update($id){
        $list =adminModel::get($id);
//        var_dump($list->toArray());
        $role = new Role();
        $role_id = $list->where("id",$id)->field("role_id")->find();
        
        
//        var_dump($role_id->toArray());
        $data = $role->field("name,id")->select();
//        var_dump($data->toArray());
        $this->assign("data",$data);
        $this->assign("list",$list);
        $this->assign("role_id",$role_id);
//        var_dump($list);
        return $this->fetch();
    }
    
    //保存修改的信息 
    public function saveUp(){
        $data = input("post.");
        $validate = Loader::validate('Admin');
        if(!$validate->check($data)){
           $this->error($validate->getError());
        }else{
            $adminModel = new adminModel;
            //添加数据并排除password1;
            if($adminModel->except("password1")->save($data,["id"=>$data["id"]])){
                $this->success("修改成功！","admin/admin/index");
            }else{
                $this->error("修改失败！");
            }
        }
    }
}
