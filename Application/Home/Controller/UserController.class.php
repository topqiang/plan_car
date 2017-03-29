<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends BaseController{
	public function _initialize(){
		parent::_initialize();
		$this->user=D('Usersc');
		$this ->users = D('User');
		$where['id'] = session("userid");
		$res = $this -> user -> where( $where ) -> select();
		if ($res) {
			$this -> assign('user',$res[0]);
		}else{
            $res = $this -> users -> where( $where ) -> select();
            $this -> assign('user',$res[0]);
            
        }
	}
	public function userinfo(){

		$this -> display();
	}

	public function user(){
		$order = D('Orderusc');
		$wher['uid'] = session('userid');
		$orderlist = $order -> where( $wher ) -> order('c_time desc') -> select();
        dump($orderlist);
        exit();
		$this -> assign('orderlist',$orderlist);
		$this -> display();
	}

	public function bindsc(){
        $where['jschool'] = $_GET['sid'];
        $where['id'] = session('userid');

        $res = $this -> users -> save($where);
        if ($res) {
            $this -> redirect('User/userinfo');
        }
        $this -> redirect('Index/mlist');
    }

    public function change(){
    	$data[$_POST['clum']] = $_POST['value'];
    	$data['id'] = session('userid');

    	$res = $this -> users -> save($data);
        if ($res) {
            ajaxReturn("success","修改成功！");
        }
        ajaxReturn("error","修改失败！");
    }

    /**
     * 上传图片
     */
    public function uploadPic(){
        $pic       = $_POST['pic'];
        $pic_name      = $_POST['pic_name'];
        $temp = explode('.',$pic_name);
        $ext = uniqid().'.'.end($temp);
        $base64    = substr(strstr($pic, ","), 1);
        $image_res = base64_decode($base64);
        $pic_link  = "Uploads/User/".date('Y-m-d').'/'.$ext;
        $saveRoot = "Uploads/User/".date('Y-m-d').'/';
        //检查目录是否存在  循环创建目录
        if(!is_dir($saveRoot)){
            mkdir($saveRoot, 0777, true);
        }
        $res = file_put_contents($pic_link ,$image_res);
        if($res){
            $data['id'] = session('userid');
            $data['head_pic'] = '/'.$pic_link;
            $id = $this -> users -> save($data);
            if($id){
                ajaxReturn("success","上传成功！",$data);
            }else{
                ajaxReturn("error","保存失败！");
            }
        }else{
            ajaxReturn("error","上传失败！");
        }
    }

	public function curl($data,$url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT,  'Mozilla/5.0 (compatible;MSIE 5.01;Windows NT5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo=curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_errno($ch);
        }
        curl_close($ch);
        return $tmpInfo;
    }

}