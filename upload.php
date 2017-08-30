<?php
	session_start();
	error_reporting(E_ALL || ~E_NOTICE);

	if (!$_SESSION['username']){
		die('Request error!');
	}

	/****************************************************************************** 
	 
	参数说明: 
	$max_file_size  : 上传文件大小限制, 单位BYTE 
	$destination_folder : 上传文件路径 
	$watermark   : 是否附加水印(1为加水印,其他为不加水印); 
	 
	使用说明: 
	1. 将PHP.INI文件里面的"extension=php_gd2.dll"一行前面的;号去掉,因为我们要用到GD库; 
	2. 将extension_dir =改为你的php_gd2.dll所在目录; 
	******************************************************************************/  
	  
	//上传文件类型列表  
	$uptypes=array(  
	    'image/jpg',  
	    'image/jpeg',  
	    'image/png',  
	    'image/pjpeg',  
	    'image/gif',  
	    'image/bmp',  
	    'image/x-png'  
	);  
	  
	$max_file_size=2000000;     //上传文件大小限制, 单位BYTE  
	$destination_folder="uploadimg/"; //上传文件路径  
	$watermark=1;      //是否附加水印(1为加水印,其他为不加水印);  
	$watertype=1;      //水印类型(1为文字,2为图片)  
	$waterposition=1;     //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);  
	$waterstring="http://www.kgc.cn/";  //水印字符串  
	$waterimg="xplore.gif";    //水印图片  
	$imgpreview=1;      //是否生成预览图(1为生成,其他为不生成);  
	$imgpreviewsize=1/2;    //缩略图比例  

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>注册会员账号</title>
	<meta name="keywords" content="注册，空间，个人页面" />
	<meta name="description" content="这是个人注册页面" />
	<link rel="stylesheet" type="text/css" href="css/common.css">
	
</head>
<body>

<div class="wrapper">
	
	<!--头部区域-->
	<div id="head">
		<div class="top-head top-login">
			<a href="index.php" style="display: block;"><img src="images/logo.gif" alt="logo"></a>
		</div>
		<div class="login">
			您好，<?php echo $_SESSION['username']; ?>  <a href="exit.php">退出</a>
		</div>
	</div>

	<div id="nav">
		<div class="nav-bar"></div>
	</div>


	<!--内容主体-->
	<div id="content">
		<div class="show">
			<div class="show-left padding">

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST')  
	{  
	    if (!is_uploaded_file($_FILES["upfile"][tmp_name]))  
	    //是否存在文件  
	    {  
	         echo "图片不存在!";  
	         exit;  
	    }

	    $imgtitle = trim($_POST['imagetitle']);
	    $imgdescription = trim($_POST['imagedescription']);

	   	if(!$imgtitle || !$imgdescription){
	   		echo '图片标题与描述必须填写！';
	   		exit;
	   	}
	  
	    $file = $_FILES["upfile"]; 
	    

	    if($max_file_size < $file["size"])  
	    //检查文件大小  
	    {  
	        echo "文件太大!";  
	        exit;  
	    }  
	  
	    if(!in_array($file["type"], $uptypes))  
	    //检查文件类型  
	    {  
	        echo "文件类型不符!".$file["type"];  
	        exit;  
	    }  
	  
	    if(!file_exists($destination_folder))  
	    {  
	        mkdir($destination_folder);  
	    }  
	  
	    $filename=$file["tmp_name"];  
	    $image_size = getimagesize($filename);  
	    $pinfo=pathinfo($file["name"]);
	    

	    $ftype=$pinfo['extension'];  
	    $destination = $destination_folder.time().".".$ftype;  

	    if (file_exists($destination) && $overwrite != true)  
	    {  
	        echo "同名文件已经存在了";  
	        exit;  
	    }  
	  
	    if(!move_uploaded_file ($filename, $destination))  
	    {  
	        echo "移动文件出错";  
	        exit;  
	    }  
	  
	    $pinfo=pathinfo($destination);  

	    $fname=$pinfo[basename];  
	    echo " <font color=red>已上传!</font> 文件名:  <font color=blue>".$destination_folder.$fname."</font>";
	    echo " 宽度:".$image_size[0];  
	    echo " 长度:".$image_size[1];  
	  	
	  	//入库

	    //设置错误返回按钮
		$history_back = '<p><a href="javascript:window.history.back(-1);" style="display:block;border: red 1px solid; width: 60px; margin: 0 auto; color: red;">返回</a></p>';

	    //数据库连接
		require_once('common.php');

		if(!$conn){
			echo '数据库连接失败！'.$history_back;
		} else {

				//获取当前用户的ID
				$query = "SELECT id FROM user WHERE username='".$_SESSION['username']."'";
				$source = mysqli_query($conn,$query);
				$res = mysqli_fetch_array($source);
				if (!$res['id']){
					die('用户信息获取失败');
				} else {
					$uid = $res['id'];
				}

				
				//数据输入数据库
				$query = "INSERT INTO imagesinfo(uid,imgtitle,imgpath,imgdescription) values ('".$uid."','".$imgtitle."','".$destination_folder.$fname."','".$imgdescription."')";

				mysqli_query($conn,$query);

		}

	  	//水印
	    if($watermark==1)  
	    {  
	        $iinfo=getimagesize($destination,$iinfo);  
	        $nimage=imagecreatetruecolor($image_size[0],$image_size[1]);  
	        $white=imagecolorallocate($nimage,255,255,255);  
	        $black=imagecolorallocate($nimage,0,0,0);  
	        $red=imagecolorallocate($nimage,255,0,0);  
	        imagefill($nimage,0,0,$white);  
	        switch ($iinfo[2])  
	        {  
	            case 1:  
	            $simage =imagecreatefromgif($destination);  
	            break;  
	            case 2:  
	            $simage =imagecreatefromjpeg($destination);  
	            break;  
	            case 3:  
	            $simage =imagecreatefrompng($destination);  
	            break;  
	            case 6:  
	            $simage =imagecreatefromwbmp($destination);  
	            break;  
	            default:  
	            die("不支持的文件类型");  
	            exit;  
	        }  
	  
	        imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);  
	        imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);  
	  
	        switch($watertype)  
	        {  
	            case 1:   //加水印字符串  
	            imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);  
	            break;  
	            case 2:   //加水印图片  
	            $simage1 =imagecreatefromgif("xplore.gif");  
	            imagecopy($nimage,$simage1,0,0,0,0,85,15);  
	            imagedestroy($simage1);  
	            break;  
	        }  
	  
	        switch ($iinfo[2])  
	        {  
	            case 1:  
	            //imagegif($nimage, $destination);  
	            imagejpeg($nimage, $destination);  
	            break;  
	            case 2:  
	            imagejpeg($nimage, $destination);  
	            break;  
	            case 3:  
	            imagepng($nimage, $destination);  
	            break;  
	            case 6:  
	            imagewbmp($nimage, $destination);  
	            //imagejpeg($nimage, $destination);  
	            break;  
	        }  
	  
	        //覆盖原上传文件  
	        imagedestroy($nimage);  
	        imagedestroy($simage);  
	    }  
	  
	    // if($imgpreview==1)  
	    // {  
	    // echo "<br>图片预览:<br>";  
	    // echo "<img src=\"".$destination."\" width=".($image_size[0]*$imgpreviewsize)." height=".($image_size[1]*$imgpreviewsize);  
	    // echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";  
	    // }  
	}  
?>  


				<form id="myform" enctype="multipart/form-data" method="post" name="upform">
					<p>照片名称：<input type="text" name="imagetitle" id="imagetitle" class="show-input"><span></span></p>
					
					<p>照片上传：<input type="file" name="upfile" id="upfile" class="show-input"><span></span></p>
					
					<p>照片描述:<textarea name="imagedescription"></textarea></p>

					<p class="input-submit"><input type="submit" name="" value="上传"></p>
				</form>
			</div>
			<div class="show-right show-active"></div>
			<div class="clear"></div>
		</div>
	</div>



	<!--底部区域-->
	<div id="foot">版权所有© Copyt Right 2016-2017</div>

</div>

</body>
</html>