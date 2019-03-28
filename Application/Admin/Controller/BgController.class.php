<?php
namespace Admin\Controller;
use Think\Controller;
class BgController extends BaseController {
    public function index(){
        $listArr=M('BgC')->select();
        $this->assign('list',$listArr);
        $this->display();
    }//添加分类
    public function addc(){
        if(IS_POST){
            $ini['name']=I('name');
            $rt=M('BgC')->add($ini);
            if($rt){
                echo "<script>alert('新增成功');location.href='".U('Admin/Bg/index')."';</script>";
            }else{
                echo "<script>alert('新增失败');location.href='".U('Admin/Bg/index')."';</script>";
            }
            // echo "<pre>";
            // print_r($_POST);
            // exit();
        }
        $this->display();
    }//修改分类
    public function editc(){
        $info['id']=I('id');
        if(IS_POST)
        {
            $ini['name']=I('name');
            $rt=M('BgC')->where($info)->save($ini);
            if($rt){
                echo "<script>alert('修改成功');location.href='".U('Admin/Bg/index')."';</script>";
            }else{
                echo "<script>alert('修改失败');location.href='".U('Admin/Bg/index')."';</script>";
            }
        }
        $oneArr=M('BgC')->where($info)->find();
        $this->assign('one',$oneArr);
        $this->display();
    }//删除分类
    public function delc(){
        $info['id']=I('id');
        $rt=M('BgC')->where($info)->delete();
        if($rt){
                echo "<script>alert('删除成功');location.href='".U('Admin/Bg/index')."';</script>";
        }else{
            echo "<script>alert('删除失败');location.href='".U('Admin/Bg/index')."';</script>";
        }
    }//图片管理
    public function bglist(){
        $cid=I('cid');
        $info['cid']=$cid;
        $listArr=M('Bg')->where($info)->select();
        $this->assign('list',$listArr);
        $this->assign('cid',$cid);
        $this->display();
    }//添加图片
    public function addbg(){
        $cid=I('cid');
        session('cid',$cid);
        $this->assign('cid',$cid);
        $this->display();
    }//批量上传
    public function images(){
        //图片上传=============================================================
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");


        // Support CORS
        // header("Access-Control-Allow-Origin: *");
        // other CORS headers if any...
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit; // finish preflight CORS requests here
        }


        if ( !empty($_REQUEST[ 'debug' ]) ) {
            $random = rand(0, intval($_REQUEST[ 'debug' ]) );
            if ( $random === 0 ) {
                header("HTTP/1.0 500 Internal Server Error");
                exit;
            }
        }

        // header("HTTP/1.0 500 Internal Server Error");
        // exit;


        // 5 minutes execution time
        @set_time_limit(5 * 60);

        // Uncomment this one to fake upload time
        usleep(5000);

        // Settings
        // $targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
        $targetDir = 'upload_tmp';
        $uploadDir = 'upload';

        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds


        // Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

        // Create target dir
        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir);
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
            $fileNamemin=time().rand(1000,9999);
            $houzhui=substr($fileName,strpos($fileName, '.'));
            $fileName=$fileNamemin.$houzhui;
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
            $fileNamemin=time().rand(1000,9999);
            $houzhui=substr($fileName,strpos($fileName, '.'));
            $fileName=$fileNamemin.$houzhui;
        } else {
            $fileName = uniqid("file_");
            $fileNamemin=time().rand(1000,9999);
            $houzhui=substr($fileName,strpos($fileName, '.'));
            $fileName=$fileNamemin.$houzhui;
        }
        
        $md5File = @file('md5list.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $md5File = $md5File ? $md5File : array();

        if (isset($_REQUEST["md5"]) && array_search($_REQUEST["md5"], $md5File ) !== FALSE ) {
            die('{"jsonrpc" : "2.0", "result" : null, "id" : "id", "exist": 1}');
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;

        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;


        // Remove old temp files
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }


        // Open temp file
        if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");

        $index = 0;
        $done = true;
        for( $index = 0; $index < $chunks; $index++ ) {
            if ( !file_exists("{$filePath}_{$index}.part") ) {
                $done = false;
                break;
            }
        }
        if ( $done ) {
            if (!$out = @fopen($uploadPath, "wb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }

            if ( flock($out, LOCK_EX) ) {
                for( $index = 0; $index < $chunks; $index++ ) {
                    if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
                        break;
                    }

                    while ($buff = fread($in, 4096)) {
                        fwrite($out, $buff);
                    }

                    @fclose($in);
                    @unlink("{$filePath}_{$index}.part");
                }

                flock($out, LOCK_UN);
            }
            @fclose($out);
        }

        // Return Success JSON-RPC response
        // die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
        $Tuku=M('Bg');
        $cid= session('cid');
        $info['image']='/upload/'.$fileName;
        $upurl='upload/'.$fileNamemin.'_min'.$houzhui;
        $info['cid']=$cid;
        $info['thumb']='/'.$upurl;
        if(IS_POST)
        {
            
            $Tuku->add($info);
            //压缩图片
            $image = new \Think\Image(); 
            $image->open($uploadPath);
            $width = 342; // 返回图片的宽度
            $height = 214; // 返回图片的高度
            // 生成一个缩略图并保存为
            $image->thumb($width,$height,\Think\Image::IMAGE_THUMB_FILLED)->save($upurl);
        }
        //图片上传===========================================================
    }//删除背景图片
    public function delbg(){
        $id=I('id');
        $info['id']=$id;
        $urlArr=M('Bg')->where($info)->find();
        $url=$_SERVER['DOCUMENT_ROOT'].$urlArr['image'];
        $url2=$_SERVER['DOCUMENT_ROOT'].$urlArr['thumb'];
        // exit();
        unlink($url);
        unlink($url2);
        $rt=M('Bg')->where($info)->delete();
        if($rt){
            echo "<script>alert('删除成功');location.href='".U('Admin/Bg/bglist',array('cid'=>$urlArr['cid']))."';</script>";
        }else{
            echo "<script>alert('删除失败');location.href='".U('Admin/Bg/bglist',array('cid'=>$urlArr['cid']))."';</script>";
        }
    }
    public function tests()
    {
        
    }
    //==================================================================
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
    //修改图片名称
    public function editname(){
        $id=I('id');
        $info['id']=$id;
        $oneArr=M('Bg')->where($info)->find();
        if(IS_POST){
            $ini['name']=I('name');
            $rt=M('Bg')->where($info)->save($ini);
            if($rt){
            echo "<script>alert('修改成功');location.href='".U('Admin/Bg/bglist',array('cid'=>$oneArr['cid']))."';</script>";
            }else{
                echo "<script>alert('修改失败');location.href='".U('Admin/Bg/bglist',array('cid'=>$oneArr['cid']))."';</script>";
            }
        }
        
        $this->assign('one',$oneArr);
        $this->assign('id',$id);
        $this->display();
    }
}