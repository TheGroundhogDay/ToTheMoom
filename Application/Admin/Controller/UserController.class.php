<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends BaseController {
    public function index(){
        $listArr=M('User')->select();
        $this->assign('list',$listArr);
        $this->display();
    }
    public function deluser(){
        $info['id']=I('id');
        $rt=M('User')->where($info)->delete();
        if($rt){
                echo "<script>alert('删除成功');location.href='".U('Admin/User/index')."';</script>";
        }else{
            echo "<script>alert('删除失败');location.href='".U('Admin/User/index')."';</script>";
        }
    }
}