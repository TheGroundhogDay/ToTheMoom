<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	header("Content-type:text/html;charset=utf-8");
    	// echo "<script>window.open('http://www.baidu.com'); </script>";
    	// exit();
    	$q=I('q',99);
        if($q!=99){
            echo "<script>location.href='".U('Home/Index/find',array('q'=>$q))."';</script>";
        }
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

        $bgcookie=I('bgcookie','a');
        if($bgcookie!='a'){
            cookie('bg',$bgcookie,7776000);
            // setcookie("bg",$bgcookie);
        }
        if(cookie('bg')){
            $mybginfo['id']=cookie('bg');
            $mybg=M("Bg")->field('image')->where($mybginfo)->find();
            $bgurl=$mybg['image'];
        }else{
            $bgurl='/upload/15332775433253.jpg';
        }
    	if(cookie('c')){
    		$info['wang']=cookie('c');
    	}else{
    		$info['wang']=1;
    	}
    	$firstArr=M('WangDh')->field('id')->order('id asc')->where($info)->find();
    	$zlInfo['did']=$firstArr['id'];
    	$zlArr=M('WangZl')->field('id,name')->order('id asc')->where($zlInfo)->select();
    	foreach($zlArr as $k=>$v)
    	{
    		$wzInfo['cid']=$v['id'];
    		$listArr=M('Wang')->field('name,url,image')->order('id asc')->where($wzInfo)->select();
    		$zlArr[$k]['list']=$listArr;
    	}
    	$neiInfo['wang']=1;
    	$waiInfo['wang']=2;
    	$neiArr=M('WangDh')->where($neiInfo)->order('id asc')->select();
    	$waiArr=M('WangDh')->where($waiInfo)->order('id asc')->select();
    	foreach($neiArr as $m=>$n)
    	{
    		$neiArr[$m]['className']=$n['name'];
    		$neiArr[$m]['description']=$n['name'];
    	}
    	foreach($waiArr as $p=>$q)
    	{
    		$waiArr[$p]['className']=$q['name'];
    		$waiArr[$p]['description']=$q['name'];
    	}
    	$dh['outerClasses']=$waiArr;
    	$dh['innerClasses']=$neiArr;
        //==============背景库====================
        $bgcArr=M('BgC')->order('id asc')->select();
        $this->assign('bgc',$bgcArr);
        $bgInfo['cid']=$bgcArr[0]['id'];
        $bgArr=M('Bg')->where($bgInfo)->select();
        $this->assign('bg',$bgArr);
        //==============背景库====================
    	// echo "<pre>";
    	// print_r($neiArr);
    	// exit();
    	$dh=json_encode($dh);
        $this->assign('dh',$dh);
    	$this->assign('bgurl',$bgurl);
    	$this->assign('neiArr',$neiArr);
    	$this->assign('list',$zlArr);
        $this->display();
    }
    //获取数据
    public function datas(){
    	$c=I('c');
    	cookie('c',$c);
    	$info['wang']=$c;
    	$firstArr=M('WangDh')->field('id')->order('id asc')->where($info)->find();
    	$zlInfo['did']=$firstArr['id'];
    	$zlArr=M('WangZl')->field('id,name')->order('id asc')->where($zlInfo)->select();
    	foreach($zlArr as $k=>$v)
    	{
    		$wzInfo['cid']=$v['id'];
    		$listArr=M('Wang')->field('name,url,image')->order('id asc')->where($wzInfo)->select();
    		$zlArr[$k]['list']=$listArr;
    	}
    	exit(json_encode($zlArr));
    }
    public function datam(){
    	$did=I('did');
    	$zlInfo['did']=$did;
    	$zlArr=M('WangZl')->field('id,name')->order('id asc')->where($zlInfo)->select();
    	foreach($zlArr as $k=>$v)
    	{
    		$wzInfo['cid']=$v['id'];
    		$listArr=M('Wang')->field('name,url,image')->order('id asc')->where($wzInfo)->select();
    		$zlArr[$k]['list']=$listArr;
    	}
    	exit(json_encode($zlArr));
    }//多引擎页面
    public function find(){
        $q=I('q');
        $this->assign('q',$q);
        $this->display();
    }//获取背景数据
    public function datass(){
        $info['cid']=I('cid');
        $bgArr=M('Bg')->where($info)->field('id,thumb,name')->order('id asc')->select();
        exit(json_encode($bgArr));
    }

}