<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
    	header("Content-type:text/html;charset=utf-8");
    	if(IS_POST){
            $info['account']=I('account');
            $ini['account']=I('account');
            $ini['password']=md5(md5(I('password')));
            $oneArr=M('User')->where($info)->find();
            if(empty($oneArr)){
                $rt=M('User')->add($ini);
                if($rt){
                    echo "<script>alert('注册成功！');location.href='".U('Home/Login/login')."';</script>";
                }else{
                    echo "<script>alert('注册失败！');</script>";
                }
            }else{
                echo "<script>alert('账号已存在！');</script>";
            }
        }
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
        $this->assign('bgurl',$bgurl);
        $this->display();
    }
    public function login(){
        if(IS_POST){
            $info['account']=I('account');
            $oneArr=M('User')->where($info)->find();
            if(empty($oneArr)){
                echo "<script>alert('账号不存在！');</script>";
            }else{
                if($oneArr['password']==md5(md5(I('password')))){
                    session('uid',$oneArr['id']);
                    echo "<script>alert('登录成功！');location.href='".U('Home/User/index')."';</script>";
                }else{
                    echo "<script>alert('密码错误！');</script>";
                }
            }
        }
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
        $this->assign('bgurl',$bgurl);
        $this->display();
    }
    public function logout(){
        session('uid',null);
        echo "<script>location.href='".U('Home/Login/login')."';</script>";
    }
    
}