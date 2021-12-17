<?php

session_start();
$userDB           = "root";
$passDB           = "conlonnay";
$server           = "localhost";
$DBase            = "nso";
$conn['host']     = $server;
$conn['dbname']   = $DBase;
$conn['username'] = $userDB;
$conn['password'] = $passDB;
@mysql_connect("{$conn['host']}", "{$conn['username']}", "{$conn['password']}") or die("Ko thể kết nối data ...");
@mysql_select_db("{$conn['dbname']}") or die("Bảo trì quay lại sau");
$connect = new mysqli($server, $userDB, $passDB, $DBase);
$connect->set_charset("utf8");
if ($connect->connect_error) {
    die("Bảo trì quay lại sau " . $connect->connect_error);
    exit();
}


if(isset($_SESSION['usermem'])){
$users = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `username`='" . $_SESSION['usermem']	 . "' LIMIT 1")); 
}
?>