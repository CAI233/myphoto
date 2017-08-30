<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>web前端开发_注册会员账号</title>
	<meta name="keywords" content="注册，空间，个人页面" />
	<meta name="description" content="这是个人注册页面" />
	<link rel="stylesheet" type="text/css" href="css/common.css">

	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>

	<script type="text/javascript">


	$(function(){

		$("#username").blur(function(){

			var username = $("#username").val();
			
			$.ajax({

				//url
				url:'checkusername.php',

				//data
				data:{"username":username},

				//method
				type:'post',

				//back dataType
				dataType:'text',

				//success
				success:function(data){
					$("#username").next().html(data);
				}
			});


		});



		$("input[type='submit']").click(function(){

			var username = $("#username").val();
			var usertel = $("#userphone").val();
			var userpwd1 = $("#userpwd").val();
			var userpwd2 = $("#userpwd2").val();

			if (!username ||!usertel){

				alert("请填写用户名与手机号");
				return false;

			} else if (userpwd1 != userpwd2) {

				alert("两次密码不一致");
				return false;

			} else {

				$("#myform").submit();
			}

		});

	});

		// function checkform(){
		// 	var myform = document.getElementById("myform");

		// 	myform.submit();
		// }

	</script>
</head>
<body>

<div class="wrapper">
	
	<!--头部区域-->
	<div id="head">
		<div class="top-head">
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
			<div class="show-left">
				<form id="myform" method="post" action="active_register.php">
					<p>用户昵称：<input type="text" name="username" id="username" class="show-input"><span></span></p>
					<p>手机号码：<input type="text" name="userphone" id="userphone" class="show-input"><span></span></p>
					<p>登陆密码：<input type="password" name="userpwd" id="userpwd" class="show-input"><span></span></p>
					<p>确认密码：<input type="password" name="userpwd2" id="userpwd2" class="show-input"><span></span></p>
					<p class="input-submit"><input type="submit" name="" value="注册"></p>
				</form>
			</div>
			<div class="show-right"></div>
			<div class="clear"></div>
		</div>
	</div>


	<!--底部区域-->
	<div id="foot">版权所有© Copyt Right 2016-2017</div>

</div>

</body>
</html>