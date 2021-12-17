<?php
include 'in/config.php';

if(isset($_SESSION['usermem'])){

echo'<div class="bg-content">
<div style="font-size:12px" align="right"><font color="blue">
Xin chào <b>'.$users['username'].' </b> - Số dư <b>'.number_format($users['vnd']).'</b> VND</font>
<a href="/naptien"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 55px; text-align: center;">Nạp Tiền</button></a>





<a href="/logout.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 55px; text-align: center;">Đăng Xuất</button></a>

</div>
</div>';
if(empty($users['timepass'])){
?>
<script>
        Swal({
            title: 'Bảo mật tài khoản',
            text: 'Bạn vui lòng thay đổi mật khẩu mới để đảm bảo an toàn cho tài khoản của bạn!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<?php

}
$password = mysql_real_escape_string($_POST['password']);
$repassword = mysql_real_escape_string($_POST['repassword']);
$user = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `username`='" . $_SESSION['usermem'] . "' LIMIT 1")); 

if (isset($_POST['ok'])) {
if (!$password || !$repassword) {?>
<div class="bg-content"><font color="red">Vui lòng nhập đầy đủ thông tin</font></div>
<?} else if(!preg_match('/^[a-zA-Z0-9]+$/',$password) || !preg_match('/^[a-zA-Z0-9]+$/',$repassword)){?>
<div class="bg-content"><font color="red">Mật khẩu có chứa ký tự đặc biệt</font></div>
<?} else if ($password != $user[password]){?>
<div class="bg-content"><font color="red">Mật khẩu cũ không đúng</font></div>
<?} else {
@mysql_query("UPDATE `users` SET `password` =  '{$repassword}', `timepass`='".time()."' WHERE `username` = '{$user['username']}' ");
@mysql_query("UPDATE `player` SET `password` =  '{$repassword}' WHERE `username` = '{$user['username']}' ");

$_SESSION['password'] = $repassword;
?>
<div class="bg-content"><font color="blue">Đã thay đổi mật khẩu</font></div>
<?}
}

echo'<div class="bg-content"><form action="" method="POST" name="passs">Nhập mật khẩu cũ:<br><input name="password"/><br>
Nhập mật khẩu mới:<br><input name="repassword"/><br><button type="submit" name="ok">Đổi MKhẩu</button> 
</div>';
}
include 'in/foot.php';