<?php
namespace Home\Controller;
use Think\Controller;
class CarController extends BaseController{
	public function _initialize(){
		parent::_initialize();
		$this -> car = D('Carsch');
		$this -> date = D('Date');
	}

	public function carlist(){
		$sid = $_GET['sid'];
		$where['sid'] = $sid;
		
		$res = $this -> car -> where($where) -> select();
		
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
		$this -> assign("timelist",$timelist);
		$this -> assign("car",$res[0]);		
		$this -> assign("datelist",$date);
		$this -> display();
	}

	
}