<?php
namespace Home\Controller;
use Think\Controller;
class CarController extends BaseController{
	public function _initialize(){
		parent::_initialize();
		$this -> car = D('Carsch');
		$this -> date = D('Date');
		$this -> order = D('Order');

	}

	public function carList(){
		$sid = $_GET['sid'];
		$where['sid'] = $sid;
		
		$res = $this -> car -> where($where) -> select();

		$count = $this -> date -> count() * 3 * 3; //时段数量 提前预约天数 每辆车人数
		$datenum = array(date('Y/m/d'),date('Y/m/d',time()*24*60*60),date('Y/m/d',time()*24*60*60*2));
		foreach ($res as $index => $obj) {
			$where['cid'] = $obj['id'];
			$where['date'] = array('in',$datenum);
			$where['status'] = array('neq',9);
			$where['status'] = array('neq',8);

			$curcount = $this -> order -> where($where) -> count();
			$res[$index]['istrue'] = $count > $curcount;
		}
		$this -> assign('carlist',$res);
		$this -> display();
	}

	public function paycar(){
		$id = $_GET['id'];

		$res = $this -> car -> where( array('id' => $id)) -> select();

		$time = time();
		for ($i=0; $i < 3; $i++) { 
			$date[$i] = array(
			'y' => date('Y',$time),
			'm' => date('m',$time),
			'd' => date('d',$time),
			'w' => chose(date('D',$time))
			);
			$time += 24*60*60;
		}
		$timelist = $this -> date -> where(array('status'=>array('neq',9))) -> select();
		$curdate = date('Y/m/d');
		foreach ($timelist as $index => $obj) {
			$where['cid'] = $id;
			$where['date'] = $curdate;
			$where['time'] = $obj['time'];
			$where['status'] = array('neq',9);
			$where['status'] = array('neq',8);
			$count = $this -> order -> where($where) -> count();
			$timelist[$index]['istrue'] = 3 > $count;
		}
		$this -> assign("timelist",$timelist);
		$this -> assign("car",$res[0]);		
		$this -> assign("datelist",$date);
		$this -> display();
	}


	public function getTime(){
		$cid = $_POST['cid'];
		$curdate = $_POST['date'];
		if (empty($cid)) {
			ajaxReturn("error","汽车id有误！",$timelist);
		}
		if (empty($curdate)) {
			ajaxReturn("error","选择时段有误！",$timelist);
		}
		$timelist = $this -> date -> where(array('status'=>array('neq',9))) -> select();
		foreach ($timelist as $index => $obj) {
			$where['cid'] = $res[0]['id'];
			$where['date'] = $curdate;
			$where['time'] = $obj['time'];
			$count = $this -> car -> where($where) -> count();
			$timelist[$index]['istrue'] = 3 > $count;
		}
		ajaxReturn("success","查询成功！",$timelist);
	}
	
}