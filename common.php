<?php
//数据库连接;
// error_reporting(E_ALL || ~E_NOTICE);

$host = 'localhost';
$dbuser = 'root';
$dbpwd = '';
$dbname = 'myform';

$conn = mysqli_connect($host,$dbuser,$dbpwd,$dbname);

mysqli_query($conn,'set names utf8');



?>