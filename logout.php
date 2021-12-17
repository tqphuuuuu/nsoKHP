<?php
session_start();
if (isset($_SESSION['usermem'])){
unset($_SESSION['usermem']);
unset($_SESSION['autologin']);
unset($_SESSION['password']);
}
header('Location: /');
exit;
?>