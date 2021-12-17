<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
include '../in/config.php';

if(isset($_SESSION['usermem'])){
$ids = $_GET['id'];
$s = mysql_fetch_array(mysql_query("SELECT * FROM `clan_shop` WHERE `id`='" . $ids. "' LIMIT 1")); 

$a = mysql_fetch_array(mysql_query("SELECT * FROM `player` WHERE `username`='".$users['username']."' LIMIT 1")); 
$b = json_decode($a['ninja'], true);
$ninja = mysql_fetch_array(mysql_query("SELECT * FROM `ninja` WHERE `name`='".$b[0]."' LIMIT 1")); 

$clan    = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . $ninja[clan] . "' LIMIT 1"));

if($clan['pc'] == $ninja['name']){

echo'<div class="bg-content">
<div style="font-size:12px" align="right"><font color="blue">
Xin chào <b>'.$users['username'].' </b> - Số dư <b>'.number_format($users['vnd']).'</b> VND</font>
<a href="/naptien"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 55px; text-align: center;">Nạp Tiền</button></a>

<a href="/mualuong.php"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Mua Lượng</button></a>


<a href="/password.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 60px; text-align: center;">Đổi MKhẩu</button></a>
<a href="/logout.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Đăng Xuất</button></a>

</div>
</div>';


if(mysql_num_rows(mysql_query("SELECT id FROM clan_shop WHERE id='".$ids."'")) <= 0){
Header('location: /clan/shop.php');

} else if($clan['luong'] < $s['luong'] || $clan['conghien'] < $s['conghien']){

?>
<div class="bg-content"><center><font color="red">Clan bạn không đủ lượng hoặc điểm cống hiến!</center></div>
<?
} else {
if (isset($_POST['ok'])) {
if($clan['luong'] < $s['luong'] || $clan['conghien'] < $s['conghien']){
echo'
<div class="bg-content"><center><font color="red">Clan bạn không đủ lượng hoặc điểm cống hiến!</center></div>';

} else {

echo'
<div class="bg-content"><center><font color="red">Mua thành công!</center></div>';

@mysql_query("UPDATE `clan` SET `luong` = `luong` - '".$s['luong']."' WHERE `id` = '".$ninja['clan']."' ");

@mysql_query("UPDATE `clan` SET `conghien` = `conghien`-'".$s['conghien']."' WHERE `id` = '".$ninja['clan']."' ");

$time = time()+432000;
@mysql_query("INSERT INTO clan_item(`id_shop`,`conghien`, `time`, `id_clan`) VALUES ('".$s['id']."','".$s['conghien']."','".$time."','".$clan['id']."');");

?>
<script>
        Swal({
            title: 'Mua thành công!',
            text: 'Chúc mừng bạn đã mua vật phẩm thành công cho clan!',
            type: 'success',
            confirmButtonText: 'Xong'
        })
    
</script>  
<?php
}
}

echo'
<div class="bg-content"><center><font color="#003366"><b>Bạn có chắc chắn muốn quất item này với giá '.number_format($s['luong']).' lượng + '.number_format($s['conghien']).' cống hiến clan không?</font></b><br><br> <img src="/clan/icon/'.$s['icon'].'.png"><br><font color="blue">'.$s['mota'].'</font><br><br><form action="" method="POST">
<button type="submit" name="ok">Mua Luôn</button> </form>
</center></div>';


}

}
}
                    	
		                          											
include '../in/foot.php';
?>