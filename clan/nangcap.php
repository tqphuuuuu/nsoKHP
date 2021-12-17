<?php
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
include '../in/config.php';
if (isset($_SESSION['usermem'])) {

$a = mysql_fetch_array(mysql_query("SELECT * FROM `player` WHERE `username`='".$users['username']."' LIMIT 1")); 
$b = json_decode($a['ninja'], true);
$ninja = mysql_fetch_array(mysql_query("SELECT * FROM `ninja` WHERE `name`='".$b[0]."' LIMIT 1")); 
$clan    = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . $ninja[clan] . "' LIMIT 1"));


if(empty($ninja[clan])){
Header('location : /clan');
} else {

if($clan['pc'] == $ninja['name']){
if (isset($_POST['submit'])) {

if($clan['luong'] < 2000000){
echo'<div class="bg-content"><font color="red"><b>Lỗi clan của bạn không đủ tiền</font></b></div>';
} else if($clan['menmax'] >= 60){
echo'<div class="bg-content"><font color="red"><b>Clan đã nâng cấp tới mức tối đa</font></b></div>';
} else {
@mysql_query("UPDATE `clan` SET `luong` = `luong` - '2000000' WHERE `id` = '".$ninja['clan']."' ");
@mysql_query("UPDATE `clan` SET `menmax` = `menmax`+'5' WHERE `id` = '".$ninja['clan']."' ");
echo'<div class="bg-content"><font color="blue"><b>Nâng cấp thành công!  </font></b></div>';

}
}




echo'<div class="bg-content"><form method="POST" action=""><center><b>Phí nâng cấp 1 lần 5 thành viên sẽ là 2.000.000 lượng clan<br> <button type="submit" name="submit">Nâng Cấp</button></form></center> <br>
            <br /><a href="/clan/?clan=info">« Quay lại</a></div>';

}

}

}

include '../in/foot.php';