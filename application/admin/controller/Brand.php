<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Brand as adminBrand;
use think\Loader;

class Brand extends Controller {

    //管理员列表
    public function index() {
        $list = new adminBrand;
        $list = $list->paginate(2);
        $this->assign("list", $list);
        return $this->fetch();
    }

    public function add() {
        return $this->fetch();
    }

    public function upload($title,$site){
         $adminBrand = new adminBrand();
    // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file('logo');
    if($file){
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
    //        echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            $logo = "http://localhost/shopping/public/uploads/".$info->getSaveName();
            $validate = Loader::validate('brand');
            $data = $adminBrand->data([
                   "title"=>$title,
                   "logo"=>$logo,
                   "site"=>$site,
                   
               ]);
            if(!$validate->check($data)){
               $this->error($validate->getError());
            }else{

                if($adminBrand->save($data)){
                    $this->success("添加成功！","admin/Brand/index");
                }else{
                    $this->error("添加失败！");
                }
            }
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
    // echo $info->getFilename(); 
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }else{
        $this->error("上传失败！");
    }
    
   }
   
   
   //删除
    public function delete($id){
        $adminBrand = new adminBrand;
        $ret = $adminBrand->where("id",$id)->delete();
        if($ret){
            $this->success("删除成功！","admin/brand/index");
        }else{
            $this->error("删除失败！请重试。");
        }
    }
    
    //修改
    public function update($id){
        $list = adminBrand::get($id);
        $this->assign("list",$list); 
//        var_dump($list);
        return $this->fetch();
    }
    
    
    //保存修改的信息 
    public function saveUp($title,$site,$id){
        var_dump($title);
         $adminBrand = new adminBrand();
    // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file('logo');
    
    if($file){
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
    //        echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            $logo = "http://localhost/shopping/public/uploads/".$info->getSaveName();
            $validate = Loader::validate('brand');
            $data = $adminBrand->data([
                   "title"=>$title,
                   "logo"=>$logo,
                   "site"=>$site,
                   
               ]);
            if(!$validate->check($data)){
               $this->error($validate->getError());
            }else{

                if($adminBrand->save($data,["id"=>$id])){
                    $this->success("修改成功！","admin/Brand/index");
                }else{
                    $this->error("修改失败！");
                }
            }
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
    //        echo $info->getFilename(); 
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }else{
        $this->error("上传失败！");
    }
    
   }

}
