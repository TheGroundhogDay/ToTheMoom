<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
    	$this->assign('f','0');
    	$name=I('username','');
    	$pwd=I('password','');
    	// $a=md5(md5($pwd));
    	// $this->assign('a',$a);
    	
    	if($name!='')
    	{
            $m=M('Admin');
    		$info['account']=$name;
    		$oneArr=$m->where($info)->find();
    		if(empty($oneArr))
    		{
    			$this->assign('f',1);
    		}
    		else
    		{
    			if($oneArr['password']!=md5(md5($pwd)))
    			{
    				$this->assign('f',2);
    			}
    			else
    			{
    				$this->assign('f',3);
    				session('ID',$oneArr['id']);
    			}
    		}
    	}
    	$this->display('default/index');
    }
    public function logout()
    {
        session('ID',NULL);
    	echo "<script>
    	location.href='".U('Admin/Login/index')."'
    	</script>";
    }
}