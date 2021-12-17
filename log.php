<?php
session_start();
include('in/conn.php');
$pass = mysql_real_escape_string($_POST['pass']);
$user = mysql_real_escape_string($_POST['user']);

if (!$user || !$pass) {?>
<script>
        Swal({
            title: 'Lỗi đăng nhập',
            text: 'Thông tin đăng nhập không chính xác, vui lòng kiểm tra lại!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<?} else if(!preg_match('/^[a-zA-Z0-9]+$/',$user)){?>
<script>
        Swal({
            title: 'Lỗi đăng nhập',
            text: 'Tên nick bạn nhập có ký tự đặc biệt hoặc viết hoa',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<?} else {
$req = mysql_query("SELECT * FROM `users` WHERE `username`='" . trim(mb_strtolower($user)) . "' LIMIT 1");
if (mysql_num_rows($req)) {
$user = mysql_fetch_assoc($req);
if ($user['lock'] == 0){
if ($pass == $user['password']) {
$_SESSION['usermem'] = $user['username'];
$_SESSION['password'] = $user['password'];

?>
 <meta http-equiv="refresh" content="0;url=/">
        <script type="text/javascript">
            window.location.href = "/"
        </script>
<?}else {?>
<script>
        Swal({
            title: 'Lỗi đăng nhập',
            text: 'Mật khẩu bạn nhập không chính xác!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<?}
}else {?>
<script>
        Swal({
            title: 'Lỗi đăng nhập',
            text: 'Tài khoản đã bị khoá vui lòng liên hệ admin để biết thêm thông tin!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  

<?}
}else {?>
<script>
        Swal({
            title: 'Lỗi đăng nhập',
            text: 'Tài khoản bạn vừa nhập không tồn tại!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  

<?}
}
?>