<!-- <?php

//连接数据库
	//error_reporting(E_ALL || ~E_NOTICE);
	//$conn = mysqli_connect("localhost","root","","myform");
	//判断是否连接

	//设置连接字符
	//mysqli_query($conn,"set name utf8");
	//入库操作
	

?> -->
<html>
	<head>

		<title>
			个人登陆
		</title>
		<meta charset="utf-8"/>
		<meta name="keywords" content="登陆，主页，个人页面"/>
		<meta name="description" content="个人登陆"/>
		<!-- <meta http-equiv="refresh" content="3; url=index.html"> -->
		
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>

		<header>
			<div>
				<a href="#" >
					<img src="img/logo.jpg" alt="这是logo"/>
				</a>
			</div>
			<div class="login">
			您好，xxx<a href="upload.php">上传照片</a> <a href="exit.php">退出</a>
			</div>

			
		</header>
		<section>
			<table>
				<tr>
					<td>编号</td>
					<td>姓名</td>
					<td>密码</td>
					<td>电话</td>
				</tr>
				
					<!-- // $query = "SELECT id,username,userpwd,usertel FROM user  order by id desc ";
					// $result = mysqli_query($conn,$query);
					// $res = mysqli_num_rows($result); -->
			
			</table>

		</section>
		<p>
		
				<!--  header("refresh:3;url=index.html");
				 echo('<br>登陆成功，三秒后自动跳转到主页~~~'); -->
		
		</p>
		<p></p>
	</body>
	<!-- <script type="text/javascript">
	var result = document.getElementsByTagName("p")[1];
	
	var s = 3;
	result.innerHTML = s;
	var clear =	setInterval(function(){
			s;
			if(s<0){
				clearinterval(clear);
			}
			result.innerHTML = s;
			

		},1000)

	</script> -->
</html>











