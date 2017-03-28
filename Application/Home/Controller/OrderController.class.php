<?php
namespace Home\Controller;
use Think\Controller;
/**
 * Class OrderController
 * @package Home\Controller
 */
class OrderController extends BaseController{
	public function _initialize(){
		parent::_initialize();
		$this -> order = D('Order');
		$this -> orderusc = D('Orderusc');

		$this -> user = D('User');

	}
	public function addOrder(){
		$cid = $_POST['cid'];
		$sid = $_POST['sid'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$uid = session("userid");

		$user = $this -> user -> field('istrue,jschool') -> where(array('id'=>$uid)) -> select();
		$usid = $user[0]['jschool'];

		$where['status'] = array('neq',9);
		$where['status'] = array('neq',8);
		$where['uid'] = $uid;
		$where['date'] = $date;

		$count = $this -> order -> where($where) -> count();

		if (empty($usid)) {
			ajaxReturn("error","无绑定该驾校！");
		}else if ($usid != $sid ) {
			ajaxReturn("error","绑定驾校和预约驾校不一致！");
		}else if(empty($user) || empty($user[0]['istrue'])){
			ajaxReturn("error","您还未通过审核！");
		}else if ($count) {
			ajaxReturn("error","同一天只能预约一个时间段练车！");
		}
		$data = array(
			'cid' => $cid,
			'sid' => $sid,
			'date' => $date,
			'time' => $time,
			'uid' => $uid,
			'status' => 0,
			'c_time' => time(),
			'u_time' => time()
			);
		//$res = $this -> order -> add($data);
		if ($data) {
			$accesstoken = $this -> getAccess();

			$openid = session("openid");
			$clickurl = $this -> baseurl;
			$postdata['username' ] = array(
				'value' => session("username"),
				'color' => '#173177' 
				);
			$postdata['ordernum' ] = array(
				'value' => date('Y-m-d h:m:i',$time),
				'color' => '#173177' 
				);
			$postdata['price' ] = array(
				'value' => date('Y-m-d h:m:i'),
				'color' => '#173177' 
				);
			$json = array(
				'touser' => $openid,
				'url' => $this -> baseurl.U('User/userinfo'),
				'template_id' => 'IMTokfYtmz0UNn3xHPa4O19Jy8Ld-5zTmTKLq_X6QqQ',
				'topcolor' => '#FF0000',
				'data' => $postdata
				);

			$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$accesstoken";

			$mesreturn = $this -> curl(json_encode($postdata),$url);

			ajaxReturn("success","添加成功！",$mesreturn);
		}else{
			ajaxReturn("error","添加失败！");
		}
	}

 	public function addremark(){
 		$data['id'] = $_POST['id'];
 		$data['remark'] = $_POST['remark'];

 		$res = $this -> order -> save($data);

 		if ($res) {
 			ajaxReturn("success","保存成功！");
 		}else{
 			ajaxReturn("error","保存失败！");
 		}

 	}

	public function orderinfo(){
		$id = $_GET['id'];

		$res = $this -> orderusc -> where( array('id' => $id )) -> select();

		$this -> assign('order',$res[0]);
		$this -> display();
	}


	
}
