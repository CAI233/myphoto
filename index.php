<?php
	session_start();
	error_reporting(E_ALL||~E_NOTICE);


	if (!$_SESSION['username']){
		//die('Request error!');
		echo '<script language="javascript">';
		echo 'location="login.php"';
		echo '</script>';		
	} else {
		//echo $_SESSION['md_user_toke'];
	}
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
			<a href="" style="display: block;"><img src="images/logo.gif" alt="logo"></a>
		</div>
		<div class="login">
			您好，<?php echo $_SESSION['username'] ?><a href="upload.php">上传照片</a> <a href="exit.php">退出</a>
		</div>
	</div>

	<div id="nav">
		<div class="nav-bar"></div>
	</div>


	<!--内容主体-->
	<div id="content">
		<div class="show">
			<div id="search">
				<form action="" method="get" >
					<input type="search" name="search" />
					<input type="submit" name="" value="搜索" id="submit" />
				</form>
			</div>
			<ul class="imgul">
				<?php
					 //数据库连接
					require_once('common.php');
					
					//设置数据库连接编码
					@mysqli_query($conn,"SET NAMES 'utf8'");


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

							//分页
							//页码
							$page = $_GET['page'] ? $_GET['page'] : 1;

							//获取搜索值
							$search = $_GET['search'] ? $_GET['search'] :"";
							
							$page2 = $page-1;

							//每页显示的条数
							$nums = 4;

							//从哪条记录开始
							$start = $page2*$nums; 

							//总记录数
							// $query = "SELECT count(*) as total FROM imagesinfo WHERE uid=$uid" ;
							$query = "SELECT * FROM imagesinfo WHERE uid=$uid and imgtitle like '%".$search."%'" ;
							$result = mysqli_query($conn,$query);
							$res = mysqli_fetch_array($result);
							// $totalrecords = $res['total'];
							$rows = mysqli_num_rows($result);

							//总页数=总记录数/每页显示的条数
							//$totalpages = ceil($totalrecords/$nums);
							$totalpages = ceil($rows/$nums);

							//页码
							for($p=0;$p<$totalpages;$p++){
								$pagex .= '<a href="index.php?page='.($p+1).'">'.($p+1).'</a>';
							}

							//上一页
							$prepage = $page-1;
							if ($prepage == 0) {$prepage = 1; }
							$prepage_html = '<a href="index.php?page='.$prepage.'&search='.$search.'">上一页</a>';

							//下一页
							$nextpage = $page+1;
							if ($nextpage>$totalpages) {$nextpage = $totalpages;}
							$nextpage_html = '<a href="index.php?page='.$nextpage.'&search='.$search.'">下一页</a>';
							
							//读取相册数据
							$query = "SELECT imgtitle,imgpath FROM imagesinfo WHERE uid=$uid AND imgtitle LIKE '%".$search."%' limit $start,$nums";
							$source = mysqli_query($conn,$query);
							while($res = mysqli_fetch_array($source)){

								echo '<li><a href=""><img src="'.$res['imgpath'].'" width="200" height="150"><h6>'.$res['imgtitle'].'</h6></a></li>';
							}
					}


				?>
			</ul>

			<div class="clear"></div>

			<div class="page">
				<div class="pageIn">
					<?php echo $prepage_html.$pagex.$nextpage_html;?>
				</div>
				
			</div>

		</div>
	</div>

	
	<!--底部区域-->
	<div id="foot">版权所有© Copyt Right 2016-2017</div>

</div>

</body>
</html>