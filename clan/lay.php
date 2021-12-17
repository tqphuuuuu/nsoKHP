<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
include '../in/config.php';

if(isset($_SESSION['usermem'])){
$ids = $_GET['id'];

$a = mysql_fetch_array(mysql_query("SELECT * FROM `player` WHERE `username`='".$users['username']."' LIMIT 1")); 
$a = json_decode($a['ninja'], true);
$ninja = $a[0];
$ninja = mysql_fetch_array(mysql_query("SELECT * FROM `ninja` WHERE `name`='".$ninja."' LIMIT 1")); 
$kho    = mysql_fetch_array(mysql_query("SELECT * FROM `clan_item` WHERE `id`='" . $ids . "' LIMIT 1"));
$shop    = mysql_fetch_array(mysql_query("SELECT * FROM `clan_shop` WHERE `id`='" . $kho['id_shop'] . "' LIMIT 1"));
$clan    = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . $ninja[clan] . "' LIMIT 1"));

if(empty($ninja[clan]) || $kho['id_clan'] != $clan['id']){
Header('location : /clan');
exit;
}

$ht = $ninja['maxluggage']-1;                 
$add = $shop['add'];

if($ids == 2){
$settime = time() + 1209600000;

$add = '{"isLock":true,"expires":'.$settime.',"sale":5,"quantity":1,"upgrade":0,"index":0,"id":569,"sys":0,"isExpires":true,"option":[{"param":250,"id":92},{"param":250,"id":79},{"param":300000,"id":87},{"param":200,"id":94},{"param":5000,"id":99}]}';

}


$tmp = json_decode($add, true);

$tmp2 = json_decode($n['ItemBag'], true);
$tmp2[] = $tmp;
$hanhtrang = json_decode($ninja['ItemBag'], true);

foreach($hanhtrang as $key => $value){
}


echo'<div class="bg-content">
<div style="font-size:12px" align="right"><font color="blue">
Xin chào <b>'.$users['username'].' </b> - Số dư <b>'.number_format($users['vnd']).'</b> VND</font>
<a href="/naptien"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 55px; text-align: center;">Nạp Tiền</button></a>

<a href="/mualuong.php"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Mua Lượng</button></a>


<a href="/password.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 60px; text-align: center;">Đổi MKhẩu</button></a>
<a href="/logout.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Đăng Xuất</button></a>

</div>
</div>';
$conghien = $shop['congjien']/100;
if(mysql_num_rows(mysql_query("SELECT id FROM clan_shop WHERE id='".$kho['id_shop']."'")) <= 0){
Header('location: /index.php');
} else if($ninja['conghien'] < $conghien){

?>
<div class="bg-content"><center><font color="red">Bạn không đủ điểm cống hiến!</center></div>

<?php
} else if($kho['time'] < time()){

?>
<div class="bg-content"><center><font color="red">Item đã hết hạn</center></div>

<?php

} else {
if (isset($_POST['ok'])) {
if($ninja['conghien'] < $conghien){
echo'
<div class="bg-content"><center><font color="red">Bạn không đủ điểm cống hiến!</center></div>';
} else if($key >= $ht){
?>
<div class="bg-content"><center><font color="red">Hành trang không đủ chỗ trống vui lòng xóa bớt và thử lại</center></div>

<script>
        Swal({
            title: 'Lỗi mua',
            text: 'Hành trang không đủ  ô trống vui lòng xóa bớt và thử lại!',
            type: 'error',
            confirmButtonText: 'Ok'
        })
    
</script>
<?php
} else {


foreach($tmp2 as $key => $value){
$tmp2[$key]['index'] = $key;
}

echo'
<div class="bg-content"><center><font color="red">Lấy thành công!</center></div>';
@mysql_query("UPDATE `ninja` SET `ItemBag` = '".addslashes(json_encode($tmp2))."' WHERE `name` = '$ninja' ");
@mysql_query("UPDATE `player` SET `conghien` = `conghien` - '".$conghien."' WHERE `name` = '".$ninja['name']."' ");
?>
<script>
        Swal({
            title: ',Thành công!',
            text: 'Chúc mừng bạn đã lấy vật phẩm thành công!',
            type: 'success',
            confirmButtonText: 'Xong'
        })
    
</script>  
<?php
}
}

echo'
<div class="bg-content"><center><font color="#003366"><b>Bạn có muốn lấy item này với  '.number_format($conghien).' điểm cống hiến không? Chú ý: bạn phải thoát game hệ thống mới send đồ được cho bạn nhé! Nếu không bạn sẽ bị mất điểm oan. Mình sẽ không giải quyết vấn đề này!</font></b><br><br> <img src="/images/icon/'.$shop['icon'].'.png"><br><font color="blue">'.$shop['mota'].'</font><br><br><form action="" method="POST">
<button type="submit" name="ok">Ok chơi luôn</button> </form>
</center></div>';



}
}
                    	
		                          											
include '../in/foot.php';
?>