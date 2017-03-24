<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * Class OrderController
 * @package Admin\Controller
 */
class OrderController extends AdminBasicController{
	public function _initialize(){
        $this -> ordusc = D("Orderusc");
        $this -> order = D("Order");

	}

    public function orderlist(){
        $where['status'] = array('neq',9);
        if ($_POST['id']) {
            $where['id'] = $_POST['id'];   
        }
        $uname = $_POST['uname'];
        if ($uname) {
            $where['uname'] = array("like","%$uname%");   
        }
        if ($_POST['phone']) {
            $where['phone'] = $_POST['phone'];   
        }
        $count = $this -> ordusc -> where($where)->count();
        $page = new \Think\Page($count,15);
        $res = $this -> ordusc -> where($where) -> order('c_time desc') ->limit($page->firstRow,$page->listRows) -> select();
        $this -> assign("orders" , $res);
        $this -> assign("page",$page->show());
        $this -> display();
    }

    public function getInfo(){
        $id = $_POST['id'];
        $where['id'] = $id;
        $res = $this -> ordusc -> where($where) -> select();
        if ( $res ) {
            ajaxReturn("success","查询成功！",$res[0]);
        }else{
            ajaxReturn("error","查询失败，不存在！");
        }
    }

    public function updstatus(){
        $where['id'] = $_POST['id'];
        $where['status'] = 8;
        $res = $this -> order -> save($where);
        if ($res) {
            ajaxReturn("success","修改成功！");
        }else{
            ajaxReturn("error","修改失败！");
        }
    }

}
