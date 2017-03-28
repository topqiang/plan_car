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
        if ($_REQUEST['city']) {
            $where['city'] = $_REQUEST['city'];
        }
        
        $res = $this -> school -> where($where)->select();
        $this -> assign('schlist',$res);
    }

    public function city(){
        $where['status'] = array('neq',9);

        $citylist = $this -> school -> distinct(true) -> field('city') -> where( $where ) ->select();
        $this -> assign('ip', get_client_ip());
        $this -> assign('citylist',$citylist);
        $this -> display();
    }

    public function addmsg(){
        $tel = $_POST['tel'];
        $name = $_POST['name'];
        $text = $_POST['text'];
        $uid = session("userid");
        $data = array(
            'tel' => $tel,
            'name' => $name,
            'text' => $text,
            'uid' => $uid,
            'ctime' => time(),
            'status' =>0
            );
        $res = D("Msg")-> add($data);
        if ($res) {
            ajaxReturn("success","保存成功，等待反馈吧！");
        }else{
            ajaxReturn("error","保存失败！");
        }
    }
    /**
     * 系统首页
     */
    public function school(){
        
        $this -> assign('ip', get_client_ip());
        $this -> display();
    }
    public function introduce(){
        $this -> display();
    }


    public function _empty(){
        $this -> redirect("school");
    }
}
