<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * Class ArticleController
 * @package Admin\Controller
 */
class DateController extends AdminBasicController{

    public $article = '';
    public function _initialize(){
        $this-> date = D('Date');
        header("Content-type: text/html; charset=utf-8");
    }
    /**
     * 菜单列表
     */
    public function dateList(){
        $where['status'] = array('neq',9);

        $art_result = $this -> date -> where($where) -> select();
        $this->assign('datelist',$art_result);
        $this->display();
    }

    /**
     * 添加文章
     */
    public function addDate(){
        if(empty($_POST['time'])){
            $this->error('时间段不能为空！');
        }
        $data['time'] = $_POST['time'];
        $data['istrue'] = $_POST['istrue'];
        $data['status'] = 0;
        $data['ctime'] = time();
        $result = $this -> date -> add($data);
        if($result){
            ajaxReturn("success","添加成功",$result);
        }else{
            ajaxReturn("","添加失败！");
        }
    }
    /**
     * 编辑菜单
     */
    public function editDate(){
        $data['id'] = $_POST['id'];
        $data['istrue'] = $_POST['istrue'] == 1 ? 0 : 1;
        $result = $this -> date -> save( $data );
        if ( $result ) {
            ajaxReturn("success","修改成功！");
        }else{
            ajaxReturn("","修改失败！");
        }
    }
    /**
     * 删除菜单
     */
    public function delDate(){
        $where['id'] = $_POST['id'];
        $where['status'] = 9;

        $result = $this -> date -> save( $where );

        if($result){
            ajaxReturn("success","删除成功");
        }else{
            ajaxReturn("","删除失败！");
        }
    }
}