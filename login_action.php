<?php
session_start();
error_reporting(E_ALL || ~E_NOTICE);

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
			<a href="login.php" class="loginpage">已注册，登陆空间</a>
		</div>
	</div>

	<div id="nav">
		<div class="nav-bar"></div>
	</div>


	<!--内容主体-->
	<div id="content">
		<div class="show">
			<?php
				require_once('common.php');

				//接收数据
				$username = $_POST['username'];
				$userpwd = $_POST['userpwd'];
				$usercode = $_POST['usercode'];
				if(!$username || !$usercode || !$userpwd){
					echo '表单填写有误 <a href="javascript:window.history.back(-1)">请点击返回</a>';

				}else{
					//服务器数据库对比
					$query = "SELECT id from user where username='".$username."' AND userpwd='".$userpwd."'";
					$result = mysqli_query($conn,$query);
					$res = mysqli_fetch_array($result);

					if(!$res['id']){
						echo '没有此人账号<a href="javascript:window.history.back(-1)">请点击返回</a>';
					}else{
						//验证成功
						// echo 'ok';
						$_SESSION['username'] = $username;
						echo '<script language="javascript">';
						echo 'location="index.php"';
						echo '</script>';
					}
				}

			?>
		</div>
	</div>

	
	<!--底部区域-->
	<div id="foot">版权所有© Copyt Right 2016-2017</div>

</div>

</body>
</html>