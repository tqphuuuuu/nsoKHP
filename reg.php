<?php
session_start();
include('in/conn.php');
$user = mysql_real_escape_string($_POST['user']);
$pass = mysql_real_escape_string($_POST['pass']);

if(!isset($_SESSION['usermem'])){

if (!$user && !$pass){
?>

<script>
        Swal({
            title: 'Lỗi đăng ký',
            text: 'Bạn vui lòng nhập đủ thông tin tài khoản và mật khẩu muốn đăng ký.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  

<?php


} else if(!preg_match('/^[a-z0-9]+$/',$user)){
?>
<script>
        Swal({
            title: 'Lỗi đăng ký',
            text: 'Tên tài khoản có ký tự đặc biệt hoặc viết hoa.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  

<?php
} else if(mysql_num_rows(mysql_query("SELECT username FROM users WHERE username='".$user."'")) > 0){?>
<script>
        Swal({
            title: 'Lỗi đăng ký',
            text: 'Tên tài khoản này đã có người sử dụng vui lòng nhập tên khác.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  

<?} else if(mb_strlen($user, 'UTF-8') < 5 || mb_strlen($user, 'UTF-8') > 15 ){?>
<script>
        Swal({
            title: 'Lỗi đăng ký',
            text: 'Tên tài khoản phải có độ dài từ 5 - 15 ký tự.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<?} else if(mb_strlen($pass, 'UTF-8') < 5 ){?>
<script>
        Swal({
            title: 'Lỗi đăng ký',
            text: 'Mật khẩu phải có độ dài từ 5 ký tự.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<?} else {
@mysql_query("INSERT INTO users(`username`, `password`, `timepass`) VALUES ('".$user."','".$pass."','".time()."');");

$_SESSION['usermem'] = $user;
$_SESSION['password'] = $pass;
?>
<meta http-equiv="refresh" content="0;url=/index.php">
<script>
        Swal({
            title: 'Đăng ký thành công!',
            text: 'Bây giờ bạn hãy đăng nhập vào website và kích hoạt tài khoản mới có thể chơi được game',
            type: 'success',
            confirmButtonText: 'Xong'
        })
    
</script>  


<?


}
}
?>