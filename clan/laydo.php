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
if($clan['pc'] != $ninja['name']){
Header('location : /clan');
exit;
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
$conghien = $shop['conghien']/10;

if(mysql_num_rows(mysql_query("SELECT id FROM clan_shop WHERE id='".$kho['id_shop']."'")) <= 0){
Header('location: /index.php');
Exit;
} else if($kho['time'] < time()){

?>
<div class="bg-content"><center><font color="red">Item đã hết hạn</center></div>

<?php

} else {
if (isset($_POST['nick'])) {
$nick = mysql_real_escape_string($_POST['nick']);
$check       = mysql_result(mysql_query("SELECT COUNT(*) FROM `ninja` WHERE (`clan` = '" . $clan['id'] . "' AND `name` =  '" . $nick . "') "), 0);
$ninja = mysql_fetch_array(mysql_query("SELECT * FROM `ninja` WHERE `name`='".$nick."' LIMIT 1")); 
$ht = $ninja['maxluggage']-1;                 
$add = $shop['add'];
$settime = round(microtime(true) * 1000)+604800000;

$checktime = round(microtime(true) * 1000);

if($shop['id'] == 1){
$add = '{"isLock":false,"expires":'.$settime.',"sale":0,"quantity":1,"upgrade":0,"index":23,"id":423,"sys":0,"isExpires":true,"option":[{"param":30,"id":92},{"param":100000,"id":87},{"param":120,"id":94}]}';
}
if($shop['id'] == 2){
$add = '{"isLock":false,"expires":'.$settime.',"sale":0,"quantity":1,"upgrade":0,"index":24,"id":424,"sys":0,"isExpires":true,"option":[{"param":40,"id":92},{"param":150000,"id":87},{"param":140,"id":94}]}';
}
if($shop['id'] == 3){
$add = '{"isLock":false,"expires":'.$settime.',"sale":0,"quantity":1,"upgrade":0,"index":25,"id":425,"sys":0,"isExpires":true,"option":[{"param":50,"id":92},{"param":200000,"id":87},{"param":160,"id":94}]}';
}
if($shop['id'] == 4){
$add = '{"isLock":false,"expires":'.$settime.',"sale":0,"quantity":1,"upgrade":0,"index":26,"id":426,"sys":0,"isExpires":true,"option":[{"param":70,"id":92},{"param":250000,"id":87},{"param":180,"id":94}]}';
}

if($shop['id'] == 5){
$add = '{"isLock":false,"expires":'.$settime.',"sale":0,"quantity":1,"upgrade":0,"index":27,"id":427,"sys":0,"isExpires":true,"option":[{"param":100,"id":92},{"param":300000,"id":87},{"param":200,"id":94}]}';
}
if($shop['id'] == 6){
$add = '{"isLock":false,"expires":'.$settime.',"sale":5,"quantity":1,"upgrade":0,"index":1,"id":569,"sys":0,"isExpires":true,"option":[{"param":50,"id":92},{"param":50,"id":79},{"param":200000,"id":87},{"param":50,"id":94},{"param":2000,"id":99}]}';
}

$tmp = json_decode($add, true);

$tmp2 = json_decode($ninja['ItemBag'], true);
$tmp2[] = $tmp;
$hanhtrang = json_decode($ninja['ItemBag'], true);

foreach($hanhtrang as $key => $value){
}


if($check == 0){
echo'
<div class="bg-content"><center><font color="red">Tên nhân vật bạn vừa nhập không đúng hoặc không ở trong clan của bạn</center></div>';
} else if($ninja['conghien'] < $conghien){
echo'
<div class="bg-content"><center><font color="red">Nick này không đủ điểm cống hiến không thể phát!</center></div>';
} else if($key >= $ht){
?>
<div class="bg-content"><center><font color="red">Hành trang nick này không đủ chỗ trống vui lòng xóa bớt và thử lại</center></div>

<?php
} else {


foreach($tmp2 as $key => $value){
$tmp2[$key]['index'] = $key;
}
$timelaydo = round(microtime(true) * 1000)+86400000;
echo'
<div class="bg-content"><center><font color="blue">Phát thành công cho '.$nick.'!</center></div>';
@mysql_query("UPDATE `ninja` SET `ItemBag` = '".addslashes(json_encode($tmp2))."' WHERE `name` = '".$nick."' ");
@mysql_query("UPDATE `ninja` SET `conghien` = `conghien` - '".$conghien."' WHERE `name` = '".$nick."' ");

}
}

echo'
<div class="bg-content"><center><font color="#003366"><b>Phí phát item này là  '.number_format($conghien).' điểm cống hiến? Điểm sẽ bị trừ vào nick người nhận!</font></b><br><br> <img src="/clan/icon/'.$shop['icon'].'.png"><br><font color="blue">'.$shop['mota'].'</font><br><br><form action="" method="POST" name="save">
               <center>
                    Nhập tên nhân vật người nhận:<br>
                    
                        <input name="nick" placeholder="Nhập tên nhân vật game" maxlength="20"  />
                    
                    <br>
<button type="submit" name="send" value="ok">Phát Item</button>
                        
                
                    
            </form>
</center></div>';



}
}
                    	
		                          											
include '../in/foot.php';
?><script>
        Swal({
            title: 'Lưu ý khi phát item',
            text: 'Bạn phải nhắc thành viên thoát game thì mới nhận được item nhé',
            type: 'error',
            confirmButtonText: 'Ok'
        })
    
</script>