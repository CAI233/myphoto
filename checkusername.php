<?php


error_reporting(E_ALL || ~E_NOTICE);

require_once("common.php");


$username = $_POST['username'];

// echo $username;

$query = "SELECT id FROM user where username='".$username."'";

$result = mysqli_query($conn,$query);

$res = mysqli_fetch_array($result);

if(!$res['id']){
	echo '可以注册';
}else{
	echo '不能注册，该用户名不能注册';
}

?>