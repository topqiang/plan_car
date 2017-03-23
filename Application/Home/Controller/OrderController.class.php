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
	}
	public function addOrder(){
		$cid = $_POST['cid'];
		$sid = $_POST['sid'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$uid = session("userid");
		$usid = session("sid");
		if (empty($usid)) {
			ajaxReturn("error","无绑定该驾校！");
		}else if ($usid != $sid ) {
			ajaxReturn("error","绑定驾校和预约驾校不一致！");
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
		$res = $this -> order -> add($data);
		if ($res) {
			ajaxReturn("success","添加成功！",$res);
		}else{
			ajaxReturn("error","添加失败！");
		}
	}
	/**
	*
	*
	*/
	public function updorder(){
		$id = $_REQUEST['id'];
		$ajax['code'] = 0; 
		if (isset($id)) {
			$type = $_REQUEST['type'];
			$ord = D("Order");
			$order = array(
				'updatetime' => time(),
				'id' => $id,
				'type' => $type,
				);
			$remark = $_GET['remark'];
			if (isset($remark)) {
				$order['remark'] = $remark;
			}
			$res = $ord -> save( $order );
			if ( isset( $res ) && $type == 1) {
				$this ->  redirect("Index/result");
			}else if(isset( $res )){
				$ajax['code'] = 1;
				$ajax['msg'] = "修改成功！";
				$this -> ajaxReturn(json_encode($ajax));
			}else{
				$this -> ajaxReturn(json_encode($ajax));
			}
		}
	}

	public function gopay(){
		$oid = $_GET['oid'];
		if (isset($oid)) {
			$ord = D("Order");
			$res = $ord -> field('id,name,price,delivertype,paymoney,delidate') -> where( array('id' => $oid)) -> limit(1) -> select();
			if (empty($res[0]['delidate'])) {
				// $this -> redirect("index.php/Order/orderinfo/id/$oid");
				$_GET['id'] = $oid;
				$this -> orderinfo();
			}
			$order = $res[0];
			$openid = session('wx_id');
			$callbackurl = "http://".$_SERVER['SERVER_NAME']."/index.php/Home/Order/comord/id/".$order['id']."/delivertype/".$order['delivertype'];
			$url = "http://www.happydaze.cn/pay/example/jsapi.php?ordname=".$order['name']."&price=".$order['paymoney']."&openid=$openid&callbackurl=$callbackurl";
			Header("Location: $url");
		}
	}

	public function payerror(){
		$ordname = $_GET['ordname'];
		$where['name'] = array('eq',$ordname);
		$order = M('Order') -> field('id,name') -> where($where) -> select();
		if (isset($order)) {
		 	$this -> assign('order' ,$order[0]);
		 	$this -> display();
		 }else{
		 	$this -> display("Index/index");
		 }
	}


	public function orderinfo(){
		$id = $_GET['id'];
		$where['id'] = $id;
		$order = M("Order") -> where($where) -> find();
		$goods = M("Orgood") -> where(array('oid'=>$id)) -> select();
		$this -> assign('order',$order);
		$this -> assign('goods',$goods);
		if (isset($order) && $order['type'] == 0) {
			$this -> display("setorder");
		}else{
			$sid = $order['sid'];
			$stel = M('Shop') ->field('tel') -> where(array('id'=>$sid)) -> find(); 
			$this -> assign('stel',$stel['tel']);
			$this -> display("orderinfo");
		}
	}

	public function orderlist(){
		$where[ 'fromuid' ] = session("userid");
		$ordadd = D("Order");
		$orgood = D("Orgood");
		$ordinfo = $ordadd -> where($where) -> order('updatetime desc,type asc') -> select();
		foreach ($ordinfo as $key => $order) {
			$good[ 'oid' ] = $order[ 'id' ];
			$goods = $orgood -> where( $good ) -> select();
			// $ordinfo[ $key ][ 'gsnum' ] = count($goods); 
			$ordinfo[ $key ][ 'goods' ] = $goods;
		}
		$this -> assign("ordinfo", $ordinfo);
		$this -> display();
	}

}
