<?php
include 'in/config.php';

if(isset($_SESSION['usermem'])){
echo'<div class="bg-content">
<div style="font-size:12px" align="right"><font color="blue">
Xin chào <b>'.$users['username'].' </b> - Số dư <b>'.number_format($users['vnd']).'</b> VND</font>
<a href="/naptien"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 55px; text-align: center;">Nạp Tiền</button></a>


<a href="/mualuong.php"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Mua Lượng</button></a>


<a href="/logout.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Đăng Xuất</button></a>

</div>
</div>';


if($users['vnd'] < 20000){

?>
<div class="bg-content"><center><font color="red">Bạn không đủ 20.000VND vui lòng nạp thêm tiền vào tài khoản để kích hoạt nhé!</center></div>

<script>
        Swal({
            title: 'Số dư không đủ',
            text: 'Bạn không đủ 20.000VND vui lòng nạp thêm tiền vào tài khoản để kích hoạt nhé!',
            type: 'error',
            confirmButtonText: 'Ok'
        })
    
</script>
<?php
} else if($users['kichhoat'] == 1){
?>
<div class="bg-content"><center><font color="red">Bạn đã kích hoạt!</center></div>
<script>
        Swal({
            title: 'Lỗi',
            text: 'Bạn đã kích hoạt!',
            type: 'error',
            confirmButtonText: 'Ok'
        })
    
</script>
<?php
} else {

@mysql_query("INSERT INTO player(`username`, `password`) VALUES ('".$users['username']."','".$users['password']."');");

@mysql_query("UPDATE `users` SET `vnd` = `vnd` - '20000',`kichhoat`='1' WHERE `username` = '".$users['username']."' ");
?>
<div class="bg-content"><center><font color="blue">Kích hoạt thành công!<br>Bây giờ bạn có thể đăng nhập vào game chiến thôi nào!</center></div>
<script>
        Swal({
            title: 'Kích hoạt thành công!',
            text: 'Bây giờ bạn có thể đăng nhập vào game chiến thôi nào!',
            type: 'success',
            confirmButtonText: 'Xong'
        })
    
</script>  

<?php
}
}
                    	
		                          											
include 'in/foot.php';
?>