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

    public function city(){
        $where['status'] = array('neq',9);

        $citylist = $this -> school -> distinct(true) -> field('city') -> where( $where ) ->select();
        dump($citylist);
        $this -> assign('ip', get_client_ip());
        $this -> assign('citylist',$citylist);
        $this -> display();
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

    public function introduce(){
        $this -> display();
    }


    public function _empty(){
        $this -> redirect("school");
    }
}
