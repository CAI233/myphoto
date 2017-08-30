<?php
session_start();
//清除SESION

$_SESSION['username'] = '';

//设置页面跳转
echo '<script language="javascript">';
echo 'location="login.php";'; 
echo '</script>';

?>