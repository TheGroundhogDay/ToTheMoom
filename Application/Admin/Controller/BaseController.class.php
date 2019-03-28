<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
	public function  __construct()
    {
        header("Content-type:text/html;charset=utf-8");
        parent::__construct();
        if(!isset($_SESSION['ID']) && $_SESSION['ID']=='')
        {
            echo "<script>
            alert('请先登录！！');
            parent.location.href='".U('Admin/Login/index')."'
            </script>";
            exit();
            $this->error('请先登录！！',U('Admin/Login/index'));
        }
    }
    	
}