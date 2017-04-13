<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 门店管理
*/
class SchoolController extends AdminBasicController{
	public function _initialize(){
		$this -> school = D("School");
		$regionwhere['region_type'] = 1;
		$this -> region = M('Region');
		$city0 = $this -> region -> where($regionwhere) -> select();
		$this -> assign('region',$city0);
	}

	public function schoollist(){
		$name = $_POST['name'];
		$city = $_POST['city'];
		if ( isset($name) ) {
			$where['name'] = array('like',"%$name%");
		}
		if ( isset($city) ) {
			$where['city'] = array('like',"%$city%");
		}
		if (!empty($_SESSION['s_id'])) {
			$where['id'] = $_SESSION['s_id'];
		}

		$where['status'] = array('neq',9);
		$count = $this -> school ->where($where)->count();
        $page = new \Think\Page($count,15);
		$list = $this -> school->limit($page->firstRow,$page->listRows) -> where($where) -> select();
		$this->assign('page',$page->show());
		$this->assign("list",$list);
		$this->display();
	}

	public function getRegion(){
		$parentid = $_POST['p_id'];
		if ($parentid) {
			$where['parent_id'] = $parentid;
			$city0 = $this -> region -> where($where) -> select();
			echo json_encode(array('flag' => 'success','message' => '请求成功！','data' => $city0));
			exit();
		}else{
			echo json_encode(array('flag' => 'error','message' => '选择有误！'));
		}
	} 

	public function schooldel(){
		$id = $_GET['id'];
		$res = $this -> school ->save(array('id'=>$id,'status'=>'9'));
		if ($res) {
			$this->success( "删除成功！" , U("School/schoollist") );
		}else{
			$this->error( "删除失败！" );
		}
	}

	public function schooledit(){
		
		$id = $_GET['id'];
		
		if (isset($id)) {

			$where['id'] = array('eq' , $id);

			$list = $this -> school ->where( $where )->select();

			$this->assign("info",$list[0]);
			
			$this-> display();
		
		}else{
			$upload_res=$this->upload();
			$data = array(
				'id' => $_POST['id'],
				'name' => $_POST['name'],
				'city' => $_POST['city'],
				'username' => $_POST['username'],
				'tel' => $_POST['tel'],
				'address' => $_POST['address'],
				'utime' => time(),
			);
			if (!empty($_POST['password'])) {
				$data['password'] = md5($_POST['password']);
			}
			if($upload_res['flag']=='success')$data['logo']="Uploads/shoplogo/".$upload_res['result'];
			$result = $this -> school ->save($data);
			if (!empty($result)) {
				$this->success("学校修改成功！",U("School/schoollist"));
			}else{
				//dump($data);
				$this->error("学校修改失败！");
			}
		}
	}

	public function addschool(){
		if (empty($_POST['name'])) {
			$this-> display();
		}else{
			$upload_res=$this->upload();
			$data = array(
				'name' => $_POST['name'],
				'city' => $_POST['city'],
				'password' => md5('123456'),
				'username' => $_POST['username'],
				'tel' => $_POST['tel'],
				'address' => $_POST['address'],
				'ctime' => time(),
				'utime' => time(),
				'status' => 0
				);
			if($upload_res['flag']=='success')$data['logo']="Uploads/shoplogo/".$upload_res['result'];
			$result = $this -> school ->add($data);
			if (!empty($result)) {
				$this->success("学校添加成功！",U("School/schoollist"));
			}else{
				$this->error("学校添加失败！");
			}
		}
	}


	//64位上传图片
	public function uploadshop(){
		$pic = $_POST['pic'];
		$picname = $_POST['picname'];
		$id = $_POST['id'];
		$base64 = substr(strstr($pic, ","), 1);
		$data = base64_decode($base64);
		$picsrc = "Uploads/toppic/".$picname;
		$res = file_put_contents( $picsrc , $data);
		if(isset($res)){
			$da['picsrc'] = $picsrc;
			if(!empty($id)){
				$da['id'] = $id;
				D("Toppic")->save($da);
				$this->ajaxReturn($id);	
			}else{
				$id = D("Toppic")->add($da);
				$this->ajaxReturn($id);	
			}
		}else{
			$this->ajaxReturn("error");	
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
    function getUpLoadFiles($name,$url,$maxsize,$type,$width,$height,$thumb_pre,$is_thumb=false)
    {
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