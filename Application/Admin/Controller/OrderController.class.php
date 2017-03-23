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
	}

    public function orderlist(){
        $where['status'] = array('neq',9);
        $count = $this -> ordusc -> where($where)->count();
        $page = new \Think\Page($count,15);
        $res = $this -> ordusc -> where($where)->limit($page->firstRow,$page->listRows) -> select();
        $this -> assign("orders" , $res);
        $this -> assign("page",$page->show());
        $this -> display();
    }

}
