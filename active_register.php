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
		
		<?php 
			//数据库连接
			require_once('common.php');
			//接收前端提交的数据
			$username = $_POST['username'];
			$userpwd =  $_POST['userpwd'];
			$userpwd1 =  $_POST['userpwd2'];
			$usertel =  $_POST['userphone'];

			// $timestamp = data('Y-m-d H:i:s',time());
			if(!$username || $userpwd!=$userpwd1 || !$usertel){
				echo '表单填写有误';
			}else {
				$query = "SELECT id FROM user where username='".$username."'";

				$result = mysqli_query($conn,$query);

				$res = mysqli_fetch_array($result);

				if(!$res['id']){
					echo '可以注册';

					$query = "INSERT into user (username,userpwd,usertel) values ('".$username."','".$userpwd."','".$usertel."')";
					mysqli_query($conn,$query);

					$insert_id = mysqli_insert_id($conn);
					if($insert_id){
						echo '注册成功';
					}else{
						echo '注册失败';
					}
				}else{
					echo '不能注册，该用户名不能注册';
				}
			}

		?>
	</div>


	<!--底部区域-->
	<div id="foot">版权所有© Copyt Right 2016-2017</div>

</div>

</body>
</html>