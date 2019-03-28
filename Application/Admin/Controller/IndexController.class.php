<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index()
    {
        
        $this->display();
    }
    public function add()
    {
        if(!(session('ID')))
        {
            echo "<script>
            parent.location.href='".U('Admin/Login/index')."'
            </script>";
            exit(); 
        }
        $tarr=M('Type')->select();
        $this->assign('tarr',$tarr);
    	header("Content-type:text/html;charset=utf-8");
    	if(IS_POST)
    	{
            $ini['content']=I('content');
    		$ini['type']=I('type');
    		$rt=M('Content')->add($ini);
    		if($rt)
    		{
    			echo "<script>alert('新增成功');location.href='".U('Admin/Index/clist')."';</script>";
    		}
    		else
    		{
    			echo "<script>alert('新增失败');</script>";
    		}
    	}
    	$this->display();
    }
    public function clist()
    {
        if(!(session('ID')))
        {
            echo "<script>
            parent.location.href='".U('Admin/Login/index')."'
            </script>";
            exit(); 
        }
    	$listArr=M('Content')->field('c.*,t.name')->alias('c')->join('sj_type as t on t.id=c.type')->select();
    	$this->assign('list',$listArr);
    	$this->display();
    }
    public function del()
    {
        if(!(session('ID')))
        {
            echo "<script>
            parent.location.href='".U('Admin/Login/index')."'
            </script>";
            exit(); 
        }
        $id=I('id');
        $info['id']=array('IN',$id);
        $rt=M('Content')->where($info)->delete();
        if($rt)
        {
            echo 1;
        }
        else
        {
            echo 2;
        }
        exit();
    }
    public function edit()
    {
        if(!(session('ID')))
        {
            echo "<script>
            parent.location.href='".U('Admin/Login/index')."'
            </script>";
            exit(); 
        }
        header("Content-type:text/html;charset=utf-8");
        $info['id']=I('id');
        $tarr=M('Type')->select();
        $this->assign('tarr',$tarr);
        if(IS_POST)
        {
            $ini['content']=I('content');
            $ini['type']=I('type');
            $rt=M('Content')->where($info)->save($ini);
            if($rt)
            {
                echo "<script>alert('保存成功');location.href='".U('Admin/Index/clist')."';</script>";
            }
            else
            {
                echo "<script>alert('保存失败');</script>";
            }
        }
        $oneArr=M('Content')->where($info)->find();
        $this->assign('one',$oneArr);
        $this->display();
    }
    public function typelist()
    {
        if(!(session('ID')))
        {
            echo "<script>
            parent.location.href='".U('Admin/Login/index')."'
            </script>";
            exit(); 
        }
        $listArr=M('Type')->select();
        $this->assign('list',$listArr);
        $this->display();
    }
    public function typeadd()
    {
        if(!(session('ID')))
        {
            echo "<script>
            parent.location.href='".U('Admin/Login/index')."'
            </script>";
            exit(); 
        }
        header("Content-type:text/html;charset=utf-8");
        if(IS_POST)
        {
            $ini['name']=I('content');
            $rt=M('Type')->add($ini);
            if($rt)
            {
                echo "<script>alert('新增成功');location.href='".U('Admin/Index/typelist')."';</script>";
            }
            else
            {
                echo "<script>alert('新增失败');</script>";
            }
        }
        $this->display();
    }
    public function typedel()
    {
        if(!(session('ID')))
        {
            echo "<script>
            parent.location.href='".U('Admin/Login/index')."'
            </script>";
            exit(); 
        }
        $id=I('id');
        $info['id']=array('IN',$id);
        $rt=M('Type')->where($info)->delete();
        if($rt)
        {
            echo 1;
        }
        else
        {
            echo 2;
        }
        exit();
    }
    public function typeedit()
    {
        if(!(session('ID')))
        {
            echo "<script>
            parent.location.href='".U('Admin/Login/index')."'
            </script>";
            exit(); 
        }
        header("Content-type:text/html;charset=utf-8");
        $info['id']=I('id');
        if(IS_POST)
        {
            $ini['name']=I('content');
            $rt=M('Type')->where($info)->save($ini);
            if($rt)
            {
                echo "<script>alert('保存成功');location.href='".U('Admin/Index/Typelist')."';</script>";
            }
            else
            {
                echo "<script>alert('保存失败');</script>";
            }
        }
        $oneArr=M('Type')->where($info)->find();
        $this->assign('one',$oneArr);
        $this->display();
    }
    public function wechat()
    {
        header("Content-type:text/html;charset=utf-8");
        $oneArr=M('Wechat')->where('id=1')->find();
        if(IS_POST)
        {
            $ini['url']=I('url');
            $rt=M('Wechat')->where('id=1')->save($ini);
            if($rt)
            {
                echo "<script>alert('设置成功！');location.href='".U('Admin/Index/wechat')."';</script>";
            }
            else
            {
                echo "<script>alert('设置失败！');location.href='".U('Admin/Index/wechat')."';</script>";
            }
        }
        $this->assign('one',$oneArr);
        $this->display();
    }
}