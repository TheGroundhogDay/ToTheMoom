<?php
namespace Admin\Controller;
use Think\Controller;
class WangController extends BaseController {
    public function nei(){
        $info['wang']=1;//内网导航
        $listArr=M("WangDh")->where($info)->order('id asc')->select();
        $this->assign('list',$listArr);
        $this->display();
    }//外网
    public function wai(){
        $info['wang']=2;//内网导航
        $listArr=M("WangDh")->where($info)->order('id asc')->select();
        $this->assign('list',$listArr);
        $this->display();
    }//外网导航分类
    public function addwd(){
        if(IS_POST){
            $ini['name']=I('name');
            $ini['wang']=2;
            $rt=M('WangDh')->add($ini);
            if($rt){
                echo "<script>alert('新增成功');location.href='".U('Admin/Wang/wai')."';</script>";
            }else{
                echo "<script>alert('新增失败');location.href='".U('Admin/Wang/wai')."';</script>";
            }
        }
        $this->display('Wang/addd');
    }
    //添加内网导航分类
    public function addd(){
        if(IS_POST){
            $ini['name']=I('name');
            $ini['wang']=1;
            $rt=M('WangDh')->add($ini);
            if($rt){
                echo "<script>alert('新增成功');location.href='".U('Admin/Wang/nei')."';</script>";
            }else{
                echo "<script>alert('新增失败');location.href='".U('Admin/Wang/nei')."';</script>";
            }
        }
        $this->display();
    }//修改内网导航分类
    public function editd(){
        $info['id']=I('id');
        if(IS_POST)
        {
            $ini['name']=I('name');
            $rt=M('WangDh')->where($info)->save($ini);
            if($rt){
                echo "<script>alert('修改成功');location.href='".U('Admin/Wang/nei')."';</script>";
            }else{
                echo "<script>alert('修改失败');location.href='".U('Admin/Wang/nei')."';</script>";
            }
        }
        $oneArr=M('WangDh')->where($info)->find();
        $this->assign('one',$oneArr);
        $this->display();
    }//删除内网导航分类
    public function deld(){
        $info['id']=I('id');
        $rt=M('WangDh')->where($info)->delete();
        if($rt){
                echo "<script>alert('删除成功');location.href='".U('Admin/Wang/nei')."';</script>";
        }else{
            echo "<script>alert('删除失败');location.href='".U('Admin/Wang/nei')."';</script>";
        }
    }//修改内网导航分类
    public function editwd(){
        $info['id']=I('id');
        if(IS_POST)
        {
            $ini['name']=I('name');
            $rt=M('WangDh')->where($info)->save($ini);
            if($rt){
                echo "<script>alert('修改成功');location.href='".U('Admin/Wang/wai')."';</script>";
            }else{
                echo "<script>alert('修改失败');location.href='".U('Admin/Wang/wai')."';</script>";
            }
        }
        $oneArr=M('WangDh')->where($info)->find();
        $this->assign('one',$oneArr);
        $this->display('Wang/editd');
    }//删除内网导航分类
    public function delwd(){
        $info['id']=I('id');
        $rt=M('WangDh')->where($info)->delete();
        if($rt){
                echo "<script>alert('删除成功');location.href='".U('Admin/Wang/wai')."';</script>";
        }else{
            echo "<script>alert('删除失败');location.href='".U('Admin/Wang/wai')."';</script>";
        }
    }//内网子分类管理
    public function zilei(){
        $info['did']=I('did');
        $listArr=M('WangZl')->where($info)->select();
        $this->assign('list',$listArr);
        $this->assign('did',$info['did']);
        $this->display();
    }//添加子分类
    public function addzl(){
        $did=I('did');
        if(IS_POST){
            $ini['did']=$did;
            $ini['name']=I('name');
            $rt=M('WangZl')->add($ini);
            if($rt){
                echo "<script>alert('新增成功');location.href='".U('Admin/Wang/zilei',array('did'=>$did))."';</script>";
            }else{
                echo "<script>alert('新增失败');location.href='".U('Admin/Wang/zilei',array('did'=>$did))."';</script>";
            }
        }
        $this->assign('did',$did);
        $this->display();
    }//修改子分类
    public function editzl(){
        $info['id']=I('id');
        $oneArr=M('WangZl')->where($info)->find();
        if(IS_POST)
        {
            $ini['name']=I('name');
            $rt=M('WangZl')->where($info)->save($ini);
            if($rt){
                echo "<script>alert('修改成功');location.href='".U('Admin/Wang/zilei',array('did'=>$oneArr['did']))."';</script>";
            }else{
                echo "<script>alert('修改失败');location.href='".U('Admin/Wang/zilei',array('did'=>$oneArr['did']))."';</script>";
            }
        }
        $this->assign('one',$oneArr);
        $this->display();
    }//删除子分类
    public function delzl(){
        $info['id']=I('id');
        $oneArr=M('WangZl')->field('did')->where($info)->find();
        $rt=M('WangZl')->where($info)->delete();
        if($rt){
                echo "<script>alert('删除成功');location.href='".U('Admin/Wang/zilei',array('did'=>$oneArr['did']))."';</script>";
        }else{
            echo "<script>alert('删除失败');location.href='".U('Admin/Wang/zilei',array('did'=>$oneArr['did']))."';</script>";
        }
    }//网址管理
    public function wangzhi(){
        $info['cid']=I('cid');
        $listArr=M('Wang')->where($info)->select();
        $this->assign('list',$listArr);
        $this->assign('cid',$info['cid']);
        $this->display();
    }//新增网址
    public function addwz(){
        $cid=I('cid');
        $Wang=M('Wang');
        if(IS_POST)
        {
            $ini=$Wang->create();
            $upload = new \Think\Upload();// 实例化上传类    
            $upload->maxSize=2097152;// 设置附件上传大小    
            $upload->exts=array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath='./';//设置根目录
            $upload->savePath='Public/upload/'; // 设置附件上传目录    // 上传文件 
            $upload->autoSub = true;//开启子目录
            $upload->subName = array('date','Ymd');//子目录命名
            $info=$upload->upload(); //文件上传
            if(!$info)
            {
                $this->error($upload->getError());
            }
            else
            {
                $ini['image']="/".$info['photo']['savepath'].$info['photo']['savename'];//获得文件路径
                $rt=$Wang->add($ini);
                if($rt){
                echo "<script>alert('新增成功');location.href='".U('Admin/Wang/wangzhi',array('cid'=>$cid))."';</script>";
                }else{
                    echo "<script>alert('新增失败');location.href='".U('Admin/Wang/wangzhi',array('cid'=>$cid))."';</script>";
                }
            }
        }
        $this->assign('cid',$cid);
        $this->display();
    }//修改网址
    public function editwz(){
        $Wang=M('Wang');
        $id=I('id');
        $this->assign('id',$id);
        $oneArr=$Wang->where('id='.$id)->find();
        if(IS_POST)
        {
            $ini=$Wang->create();
            $finfo['id']=$id;
            unset($ini['id']);
            $upload = new \Think\Upload();// 实例化上传类    
            $upload->maxSize=30145728;// 设置附件上传大小    
            $upload->exts=array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath='./';//设置根目录
            $upload->savePath='Public/upload/'; // 设置附件上传目录    // 上传文件 
            $upload->autoSub = true;//开启子目录
            $upload->subName = array('date','Ymd');//子目录命名
            $info=$upload->upload(); //文件上传
            if($info)
            {
                $ini['image']="/".$info['photo']['savepath'].$info['photo']['savename'];//获得文件路径
            }

            $rt=$Wang->where($finfo)->save($ini);
            if($rt){
                echo "<script>alert('修改成功');location.href='".U('Admin/Wang/wangzhi',array('cid'=>$oneArr['cid']))."';</script>";
                }else{
                    echo "<script>alert('修改失败');location.href='".U('Admin/Wang/wangzhi',array('cid'=>$oneArr['cid']))."';</script>";
                }
            
        }
        
        $this->assign('one',$oneArr);
        $this->display();
    }//删除网址
    public function delwz(){
        $info['id']=I('id');
        $oneArr=M('Wang')->field('cid')->where($info)->find();
        $rt=M('Wang')->where($info)->delete();
        if($rt){
                echo "<script>alert('删除成功');location.href='".U('Admin/Wang/wangzhi',array('cid'=>$oneArr['cid']))."';</script>";
        }else{
            echo "<script>alert('删除失败');location.href='".U('Admin/Wang/wangzhi',array('cid'=>$oneArr['cid']))."';</script>";
        }
    }
    //=================================end===============================================
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