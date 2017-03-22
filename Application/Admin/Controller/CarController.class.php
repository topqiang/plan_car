<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * Class ArticleController
 * @package Admin\Controller
 */
class CarController extends AdminBasicController{

    public $article = '';
    public function _initialize(){
        $this -> car = D('Car');
        $this -> carsch = D('Carsch');
        if (!empty($_SESSION['s_id'])) {
            $where['sid'] = $_SESSION['s_id'];
        }
        $where['status'] = array('neq',9);
        $schoollist = D('School') -> field('id,name') -> where($where) -> select();
        $this -> assign('schoollist',$schoollist);
        header("Content-type: text/html; charset=utf-8");
    }
    /**
     * 菜单列表
     */
    public function carList(){
        $where['status'] = array('neq',9);
        $sid = $_POST['sid'];
        $carcode = $_POST['carcode'];
        if ($sid) {
            $where['status'] = $sid;
        }
        if ($carcode) {
            $where['carcode'] = $carcode;
        }
        if (!empty($_SESSION['s_id'])) {
            $where['sid'] = $_SESSION['s_id'];
        }
        $count = $this -> carsch ->where($where)->count();
        $page = new \Think\Page($count,15);
        $list = $this -> carsch -> limit($page->firstRow,$page->listRows) -> where($where) -> select();

        $this->assign('page',$page->show());
        $this->assign('list',$list);
        $this->display();
    }

    /**
     * 添加文章
     */
    public function addCar(){
        if(empty($_POST['name']) || empty($_POST['carcode'])){
            $this->error('车辆名称或车牌不能为空！');
        }
        $data['name'] = $_POST['name'];
        $data['carcode'] = $_POST['carcode'];
        $data['sid'] = $_POST['sid'];
        $data['status'] = 0;
        $data['ctime'] = time();
        $data['utime'] = time();
        $upload_res=$this->upload();
        if($upload_res['flag']=='success')$data['pic']="Uploads/shoplogo/".$upload_res['result'];
        $result = $this->car->add($data);

        if($result){
            $this->success('添加成功',U('Car/carList'));
        }else{
            $this->error('添加失败');
        }
    }

    /**
     * 编辑菜单
     */
    public function carEdit(){
        if(empty($_POST)){
            $art_info = $this -> car -> where(array('id'=>$_GET['id'])) -> select();
            $this->assign('info',$art_info[0]);
            $this->display();
        }else{
            if(empty($_POST['name']) || empty($_POST['carcode'])){
                $this->error('车辆名称或车牌不能为空！');
            }
            $data['id'] = $_GET['id'];
            $data['name'] = $_POST['name'];
            $data['carcode'] = $_POST['carcode'];
            $data['sid'] = $_POST['sid'];
            $data['utime'] = time();
            $upload_res=$this->upload();
            if($upload_res['flag']=='success')$data['pic']="Uploads/shoplogo/".$upload_res['result'];

            $result = $this -> car -> save($data);
            if($result){
                $this->success('修改成功',U('Car/carList'));
            }else{
                $this->error('修改失败');
            }
        }
    }

    /**
     * 删除菜单
     */
    public function carDel(){
        $where['id'] = $_GET['id'];
        $where['status'] = 9;
        $result = $this-> car ->save($where);
        if($result){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }


    /**
     * 处理商品图片上传
     */
    public function upload(){
        if(empty($_FILES['pic']['name'])){
            $is_upload=false;
        }else{
            $is_upload=true;
        }
        /*foreach($_FILES['pic']['name'] as $k=>$v){
            if(!empty($v))$is_upload=true;
        }*/
        if($is_upload){
            //load("@.function.php");
            $upload_res=$this->uploadThemeImg('shoplogo');
            if(empty($upload_res['error'])){
                return array('flag'=>'success','result'=>$upload_res[0]);
            }else{
                return array('flag'=>'error','result'=>$upload_res['error']);//$this->error($upload_res['error']);
            }
        }else{
            return array('flag'=>'no');
        }
    }

    /**
     * 上传图片公共函数
     */
    function uploadThemeImg($file){

        //load("@.uploadfile");
        //include_once 'uploadfile.php';
        $save_path = "./Uploads/".$file."/".date('Ym')."/";
        //$save_path = "./Uploads/".$file."/201404/";
        $upload_info = $this->getUpLoadFiles('',$save_path,'','','200','200','');
        if(count($upload_info[0])<=1){
            return array('error'=>$upload_info);
        }else{
            foreach($upload_info as $k=>$v){
                $url_arr[]=date('Ym')."/".$v['savename'];
            }
        }
        return $url_arr;
    }



    /*
 * by king 2013年5月10日15:08:49
 * 自定义 简单上传类
 * 参数：$name-定义文件上传命名规则
 *      $url-原图保存地址
 *      $maxsize-文件最大 大小
 *      $type-上传文件类型
 *      $width-缩略图宽
 *      $height-缩略图高
 *      $thumb_pre-缩略图前坠名
 * 成功返回 上传后的信息
 * 失败返回异常名称
 * */
    function getUpLoadFiles($name,$url,$maxsize,$type,$width,$height,$thumb_pre,$is_thumb=false){
        $upload = new \Think\UploadFile();
        $upload->maxSize        = !empty($maxsize)?$maxsize:20480000;
        $upload->allowExts      = is_array($type)?$type:array('jpg','png','jpeg','bmp','gif');
        $upload->savePath       = isset($url)?$url:'./Uploads'.date("Ym").'/';
        $upload->saveRule       = !empty($name)?$name:'uniqid';       //保存文件命名规则 如果不是规则的关键字 默认设为上传的文件名称

        if($is_thumb)
        {
            //生成缩略图
            $upload->thumb          = true;
            $upload->thumbPath      = isset($url)?$url:'./Uploads'.date("Ym").'/';
            $upload->thumbPrefix    = !empty($thumb_pre)?$thumb_pre:'thumb_';
            $upload->thumbMaxWidth  = $width;
            $upload->thumbMaxHeight = $height;
            $upload->uploadReplace = true;
        }
        if($upload->Upload())
        {
            $info = $upload->getUploadFileInfo();
            return $info;
        }
        else
        {
            return $upload->getErrorMsg();
        }
    }
}