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
echo'<div class="box_topss" style="float: left;width: 100%;color: #FFFFFF;background-color: #561d00;font-size: 17px;"><span>Kho đồ gia tộc</span></div></div>';
        $page     = mysql_real_escape_string(isset($_GET['page']) ? $_GET['page'] : 1);
        $limit    = mysql_real_escape_string(isset($_GET['limit']) ? $_GET['limit'] : 20);
        $order    = mysql_real_escape_string(isset($_GET[order]) ? $_GET[order] : 'id');
        $type     = mysql_real_escape_string(isset($_GET[type]) ? $_GET[type] : 'DESC');
        $start    = ($page - 1) * $limit;
        $numbshop = mysql_result(mysql_query("SELECT COUNT(*) FROM `clan_item` WHERE `id_clan`='".$clan['id']."'"), 0);



echo'<div class="table-responsive">
<div class="bg-content">
<table border="1px" cellspacing="0" cellpadding="1" style="background-color: #FFFFCC; border: 1px outset #FFFFFF; color: #440000;  font-size: 13px; font-weight: bold; padding: 0.5px 0.5px; width: 100%; text-align: center;">
<tr>
<td>Hình Ảnh</td>
<td>Mô Tả</td>
<td>Phí Phát</td> 
<td>Hạn Phát</td> 
<td>Thao Tác</td>
</tr>';
$req = mysql_query("SELECT * FROM `clan_item` WHERE `id_clan`='".$clan['id']."' AND time >= '".time()."' ORDER BY `$order` $type LIMIT $start, $limit");
            while ($shop = mysql_fetch_assoc($req)) {
$s = mysql_fetch_array(mysql_query("SELECT * FROM `clan_shop` WHERE `id`='".$shop['id_shop']."' LIMIT 1")); 
$seconds = $shop[time];
$exp = date("H:ip, d/m/Y", $seconds);
echo'<tr><td><font color="blue"><img src="/clan/icon/'.$s['icon'].'.png"/></font></td>';

echo'<td><font color="blue">'.$s['mota'].'</font></td>';
$conghien = $s['conghien']/10;
echo'<td><font color="#009999"> '.number_format($conghien).' cống hiến</font></td>';

echo'<td><font color="#009999"> '.$exp.'</font></td>';
echo'<td><a href="/clan/laydo.php?id='.$shop['id'].'"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 55px; text-align: center;">Phát  Ngay</button></a>
</td></tr>';
}

echo'</table>';
if ($numbshop > 10) {
echo'<center>';
                if ($page > 1) {
                               ?><a href="?page=<?= $page - 1; ?>"><button style="background-color: #00B2BF; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 80px; text-align: center;">« Trang Trước</button></a>
<?
                
                }

 if ($page * 20 < $numbshop) {
                       ?><a href="?page=<?= $page + 1; ?>"><button style="background-color: #00B2BF; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 75px; text-align: center;">Trang Tiếp »</button> </b></a>
<?
                
                }

echo'</center></div></div></div>';

                      
                
            
            }

           echo'</div> </div><br><br>';
}
}

}

include '../in/foot.php';