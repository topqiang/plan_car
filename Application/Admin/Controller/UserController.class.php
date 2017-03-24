<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller{
	public function _initialize(){
		$this -> usersc = D('Usersc');
		$this -> user = D('User');

		$this -> msg = D('msg');

	}
	public function userlist(){
		$name = $_POST['name'];
		$istrue = $_POST['istrue'];

		if ($name) {
			$where['name'] = array("like","%$name%");
		}
		if ($istrue) {
			$where['istrue'] = $istrue;
		}
		$count = $this -> usersc -> where($where)->count();
		$page = new \Think\Page($count,15);
		$userlist = $this -> usersc -> where($where) -> limit($page->firstRow,$page->listRows) -> select();
		$this -> assign('userlist',$userlist);
		$this -> assign('page',$page->show());
		$this -> display();
	}

	public function msg(){

		$res = $this -> msg -> order('ctime desc') -> where(array('status' => array('neq',9))) -> select();

		$this -> assign('msglist',$res);

		$this -> display();
	}

	public function delMsg(){

		$id = $_GET['id'];
		
		$res = $this -> msg -> save(array('id'=>$id,'status'=>'9'));
		
		if ($res) {
			$this->success( "删除成功！" , U("User/msg") );
		}else{
			$this->error( "删除失败！" );
		}

	}

	public function updMsg(){

		$id = $_GET['id'];
		
		$res = $this -> msg -> save(array('id'=>$id,'status'=>'1'));
		
		if ($res) {
			$this->success( "处理成功！" , U("User/msg") );
		}else{
			$this->error( "处理失败！" );
		}

	}

	public function updUser(){

		$id = $_GET['id'];
		$istrue = $_GET['istrue'];

		if ($istrue == 1) {
			$istrue =0;
		}else{
			$istrue =1;
		}
		$res = $this -> user -> save(array('id'=>$id,'istrue'=>$istrue));
		
		if ($res) {
			$this->success( "处理成功！" , U("User/userlist") );
		}else{
			$this->error( "处理失败！" );
		}

	}
}