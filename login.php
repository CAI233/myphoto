<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>登陆会员账号</title>
	<meta name="keywords" content="注册，空间，个人页面" />
	<meta name="description" content="这是个人注册页面" />
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<script type="text/javascript">
	//判断客户端比对
		function checkform(){
			var myform = document.getElementById("myform");
			var username = document.getElementById("username");
			var usertel = document.getElementById("usertel");
			var userpwd = document.getElementById("userpwd");
			var userpwd2 = document.getElementById("userpwd2");
			myform.submit();
		}

	</script>
</head>
<body>

<div class="wrapper">
	
	<!--头部区域-->
	<div id="head">
		<div class="top-head top-login">
			<a href="" style="display: block;"><img src="images/logo.gif" alt="logo"></a>
		</div>
		<div class="login">
			<a href="register.php" class="loginpage">没有账号，点击注册</a>
		</div>
	</div>

	<div id="nav">
		<div class="nav-bar"></div>
	</div>


	<!--内容主体-->
	<div id="content">
		<div class="show">
			<div class="show-left padding">
				<form id="myform" method="post" action="login_action.php" onsubmit="return false;">
					<p>用户昵称：<input type="text" name="username" id="username" class="show-input"><span></span></p>
					
					<p>登陆密码：<input type="password" name="userpwd" id="userpwd" class="show-input"><span></span></p>
					<p class="codeparent">验证码号：<input type="text" name="usercode" id="userpwd2" class="show-input login_input"> <img src="code.php" onclick="this.src='code.php?'+Math.random()" class="codeimg" /></p>

					<p class="input-submit"><input type="submit" name="" value="登陆" onclick ="checkform()"></p>
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