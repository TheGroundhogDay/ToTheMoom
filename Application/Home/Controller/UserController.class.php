<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
    	header("Content-type:text/html;charset=utf-8");
    	if(cookie('bg')){
            $mybginfo['id']=cookie('bg');
            $mybg=M("Bg")->field('image')->where($mybginfo)->find();
            $bgurl=$mybg['image'];
        }else{
            $bgurl='/upload/15332775433253.jpg';
        }
        //==============背景库====================
        $bgcArr=M('BgC')->order('id asc')->select();
        $this->assign('bgc',$bgcArr);
        $bgInfo['cid']=$bgcArr[0]['id'];
        $bgArr=M('Bg')->where($bgInfo)->select();
        $this->assign('bg',$bgArr);
        //==============背景库====================
        $oneinfo['id']=session('uid');
        $oneArr=M('User')->where($oneinfo)->find();
        $this->assign('one',$oneArr);
        $this->assign('bgurl',$bgurl);
        $this->display();
    }
    public function edit(){
        header("Content-type:text/html;charset=utf-8");
        if(cookie('bg')){
            $mybginfo['id']=cookie('bg');
            $mybg=M("Bg")->field('image')->where($mybginfo)->find();
            $bgurl=$mybg['image'];
        }else{
            $bgurl='/upload/15332775433253.jpg';
        }
        $this->assign('bgurl',$bgurl);
        //登录判断
        if(session('uid')){
            $uinfo['id']=session('uid');
            $uArr=M('User')->where($uinfo)->find();
            $dl=1;
            $this->assign('uarr',$uArr);
        }else{
            $dl=2;
        }
        $this->assign('dl',$dl);
        //登录判断
        //==============背景库====================
        $bgcArr=M('BgC')->order('id asc')->select();
        $this->assign('bgc',$bgcArr);
        $bgInfo['cid']=$bgcArr[0]['id'];
        $bgArr=M('Bg')->where($bgInfo)->select();
        $this->assign('bg',$bgArr);
        //==============背景库====================
        $info['id']=session('uid');
        if(IS_POST){
            $newinfo['id']=array('neq',session('uid'));
            $account=I('account');
            $newinfo['account']=$account;
            $newArr=M('User')->where($newinfo)->find();
            if(!empty($newArr)){
                echo "<script>alert('昵称已存在！');</script>";
            }else{
                $ini['account']=$account;
                $rt=M('User')->where($info)->save($ini);
                if($rt){
                    echo "<script>alert('修改成功！');location.href='".U('Home/User/index')."';</script>";
                }else{
                    echo "<script>alert('修改失败！');</script>";
                }
            }
        }
        $oneArr=M('User')->field('id,account')->where($info)->find();
        $this->assign('one',$oneArr);
        $this->display();
    }
    public function qiandao(){
        if(!session('uid')){
            exit();
        }
        $info['uid']=session('uid');
        $info['time']=date('Ymd');
        $oneArr=M("Qian")->where($info)->find();
        if(empty($oneArr))
        {
            $rt=M('Qian')->add($info);
            $xinfo['id']=session('uid');
            M('User')->where($xinfo)->setInc('jf',15);
            if($rt)
            {
                echo 1;
            }
            else
            {
                echo 2;
            }
        }
        else
        {
            echo 3;//今天投过了
        }
    }
    
    
}