<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Product as productModel;
use app\admin\model\Type;
//引入库存单位
use app\admin\model\Invertory;
//引入库存状态
use app\admin\model\Dimensional;
//引入尺寸单位
use app\admin\model\Weight;
//引入重量单位
use app\admin\model\State;
use app\admin\model\Brand;
use think\Loader;
use think\Image;
use think\Request;
use think\Cookie;
class Product extends Controller{
    //列表列表
    public function index(){
        $sreachlist = new productModel();
        
        //搜索
        $query = array();
        $searchname = input("get.searchname","");
        $is_sole = input("get.is_sole","2");
        $is_shipping = input("get.is_shipping","2");
        $price = input("get.price","");
        $pricetwo = input("get.pricetwo","");
        $data = "";
        if($searchname !=""){
            $sreachlist = $sreachlist->where("title","like","%{$searchname}%");
        }
        if($is_shipping !=0 && $is_shipping !=""){
            $sreachlist->where("is_shipping",$is_shipping);
        }
        if($is_sole !=0 && $is_sole!=""){
            $data = $sreachlist->where("is_sale",$is_sole)->select();
        }
        
//         $sql = $sreachlist->getLastSql();
//         var_dump($sreachlist);
//        if($price!="" && $price!=""){
//            $sreachlist->array('egt',$price);
//        }
//        if($pricetwo!="" && $pricetwo!=""){
//            $data = $sreachlist->array('elt',$pricetwo)->select();
//        }
        
        
        $this->assign("searchname",$searchname);
        $this->assign("is_sale",$is_sole);
        $this->assign("is_shipping",$is_shipping);
        $this->assign("price",$price);
        $this->assign("pricetwo",$pricetwo);
        if($data!=""){
            $this->assign("list",$data);
        }
        return $this->fetch();
    }
    
    //增加
    public function add(){
         //1判断是否提交form
        $productModel = new productModel();
        if(Request::instance()->isPost())
        {
            //为true  表单提交数据入库
            $data = Request::instance()->Post();
            $admin_id = Cookie::get("admin_id");
            array_push($data,$admin_id);
//            var_dump($data);
//            exit();
            $data =$productModel->save($data);
            if($data){
                $this->success("添加成功!","admin/product/index");
            }else{
                $this->error("添加失败");
            }
        }else{
            //添加页面  
            $typeModel = new Type();
            $brand = new Brand();
            $type = $typeModel->select()->toArray();
            $type = $this->tree($type);
            $brand = $brand->select()->toArray();
            $this->assign("type",$type);
            $this->assign("brand",$brand);
            
            //调取所有的库存单位
            $Inverit=new Invertory();
            $Inver_unit = $Inverit->select()->toArray();
            $this->assign("Inver_unit",$Inver_unit);
            
            //调取所有的库存状态
            $state = new state();
            $state = State::all();
            $this->assign("State",$state);
            
            
            //尺寸
            $dimensional = Dimensional::all();
            $this->assign("dimensional",$dimensional);
            
            //重量单位
            $weight = Weight::all();
            $this->assign("weight",$weight);
            return $this->fetch();
        }
    }
    
   /**
    * 专门上传图片的方法
    */
   public function upload(){
       // 获取表单上传文件,接收文件
        $file = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下->validate(['size'=>15678,'ext'=>'jpg,png,gif'])
        $info = $file->move(ROOT_PATH . 'public' . DS . 'static'.DS."upload");
        if($info){
            //上传成功后的路径
            $file = $info->getSaveName();
//            var_dump($file);
//            die();
            $oldImage = ROOT_PATH . 'public' . DS . 'static'.DS."upload".DS.$file;
            $image = Image::open($oldImage);
           
            //裁剪图片
//            $image->crop(200, 200)->save(ROOT_PATH . 'public' . DS . 'static'.DS."upload".DS."1111.jpg");
            //缩略图
            $thumb = "thumb".DS.time().".".$info->getExtension();
            $dir = ROOT_PATH . 'public' . DS . 'static'.DS."upload".DS.$thumb;
            //将原图，复制到了新的地址和新的名称下
            copy($oldImage, $dir);
            //生成缩略图
            $image->thumb("200", "200", Image::THUMB_CENTER)->save($dir);
            return [
                "status"=>true,
                "data"=>[
                    "file"=>$file,
                    "image_thumb"=>$thumb
                ]
            ];
        }else{
            // 上传失败获取错误信息
            return [
              "status"=>false,
                "data"=>$file->getError(),
            ];
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
    
    //修改
    public function update($id){
        $productModel = new productModel();
        if(Request::instance()->isPost())
        {
            //为true  表单提交数据入库
            $data = Request::instance()->Post();
            $data =$productModel->isUpdate(true)->save($data);
            if($data){
                $this->success("修改成功!","admin/product/index");
            }else{
                $this->error("修改失败");
            }
        }else{
            //添加页面  
            $list = $productModel->where("id",$id)->find();
            //添加页面  
            $typeModel = new Type();
            $brand = new Brand();
            $type = $typeModel->select()->toArray();
            $type = $this->tree($type);
            $brand = $brand->select()->toArray();
            $this->assign("type",$type);
            $this->assign("brand",$brand);
            $this->assign("list",$list);
            
            
            //调取所有的库存单位
            $Inverit=new Invertory();
            $Inver_unit = $Inverit->select()->toArray();
            $this->assign("Inver_unit",$Inver_unit);
            
            //调取所有的库存状态
            $state = new state();
            $state = State::all();
            $this->assign("State",$state);
            
            //尺寸单位
            $dimensional = Dimensional::all();
            $this->assign("dimensional",$dimensional);
            
            //重量单位
            $dimensional = Dimensional::all();
            $this->assign("dimensional",$dimensional);
            
            //重量单位
            $weight = Weight::all();
            $this->assign("weight",$weight);
            return $this->fetch();
        }
        
        
        
    }
    
    //删除
    public function delete($id){
        $del = new productModel();
        $del = $del->where("id",$id)->delete();
        if($del){
            $this->success("删除成功!","admin/product/index");
            
        }else{
            $this->error("删除失败");
        }
    }
  
}
