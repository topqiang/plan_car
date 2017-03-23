<?php
namespace Home\Controller;
use Think\Controller;

/**
 * Class IndexController
 * @package Home\Controller
 */
class IndexController extends BaseController {
    public function _initialize(){
    	parent::_initialize();
    	//完善购物车数量查询
        $this -> school = D('School');
        $where['status'] = array('neq',9);
        
        
        $res = $this -> school -> where($where)->select();
        $this -> assign('schlist',$res);
    }

    /**
     * 系统首页
     */
    public function school(){
        
        $this -> assign('ip', get_client_ip());
        $this -> display();
    }

    public function list(){
        $this -> display();
    }


    public function _empty(){
        $this -> redirect("school");
    }
}
