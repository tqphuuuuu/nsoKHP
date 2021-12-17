<?php
include 'in/conn.php';

if(isset($_SESSION['usermem'])){

if(isset($_POST['ok'])){
$tcheck = $users['free']+3600*24;
$time = time();
if($users['kichhoat'] != 1){
?>
<script>
        Swal({
            title: 'Lỗi nhận quà',
            text: 'Bạn chưa kích hoạt tài khoản!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<?} else if($tcheck > $time){
?>
<script>
        Swal({
            title: 'Lỗi nhận quà',
            text: 'Bạn đã nhận quà rồi nhé, vui lòng đợi 24h nữa mới có thể nhận tiếp!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<?} else {
$xu = rand(100000000,130000000);
$luong = rand(90000,220000);
$a = mysql_fetch_array(mysql_query("SELECT * FROM `player` WHERE `username`='".$users['username']."' LIMIT 1")); 
$b = json_decode($a['ninja'], true);

@mysql_query("UPDATE `player` SET `luong` = `luong` + '$luong' WHERE `username` = '".$users['username']."' ");
@mysql_query("UPDATE `users` SET `free` = '$time' WHERE `username` = '".$users['username']."' ");
@mysql_query("UPDATE `ninja` SET `xu` = `xu` + '$xu' WHERE `name` = '".$b[0]."' ");
?>
<script>
        Swal({
            title: 'Thành công!',
            text: 'Hôm nay bạn nhận được <?=$xu?> xu, và <?=$luong?> lượng!',
            type: 'success',
            confirmButtonText: 'Xong'
        })
    
</script>  
<?
}

}

}


?>