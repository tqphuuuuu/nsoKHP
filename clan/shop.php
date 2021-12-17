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

if($_POST['loai'] == 1){
$luong = '500000';
$loai = '2';
$mil = round(microtime(true) * 1000)+86400000;
}

if($_POST['loai'] == 2){
$luong = '2000000';
$loai = '2';
$mil = round(microtime(true) * 1000)+432000000;
}


if($_POST['loai'] == 3){
$luong = '1000000';
$loai = '4';
$mil = round(microtime(true) * 1000)+86400000;
}

if($_POST['loai'] == 4){
$luong = '4500000';
$loai = '4';
$mil = round(microtime(true) * 1000)+432000000;
}


if($clan['luong'] < $luong){
echo'<div class="bg-content"><font color="red"><b>Lỗi clan của bạn không đủ tiền</font></b></div>';
} else if($clan['timeexp'] > round(microtime(true) * 1000)){
echo'<div class="bg-content"><font color="red"><b>Lỗi clan của bạn vẫn còn hạn exp nên chưa thể mua thêm</font></b></div>';
} else {

@mysql_query("UPDATE `clan` SET `luong` = `luong` - '".$luong."' WHERE `id` = '".$ninja['clan']."' ");
@mysql_query("UPDATE `ninja` SET `xexp` = '".$loai."', `timeexp`='".$mil."' WHERE `clan` = '".$ninja['clan']."' ");
@mysql_query("UPDATE `clan` SET `xexp` = '".$loai."', `timeexp`='".$mil."' WHERE `id` = '".$ninja['clan']."' ");
echo'<div class="bg-content"><font color="blue"><b>Mua thành công clan bạn bị trừ '.$luong.' lượng!</font></b></div>';
}
}





echo'<div class="bg-content"><form method="POST" action=""><b>Mua x2,x4 kinh nghiệm cho đội: <br><select class="form-control" name="loai">
                                                <option value="1">Mua 1 ngày X2 </option>
                                                <option value="2">Mua 5 ngày X2 </option>
<option value="3">Mua 1 ngày X4 </option>
<option value="4">Mua 5 ngày X4</option>
                                         </select><button type="submit" name="submit">Mua</button></form> </div>';


echo'<div class="bg-content"><table border="1px" cellspacing="0" cellpadding="1" style="background-color: #FFFFCC; border: 1px outset #FFFFFF; color: #440000;  font-size: 13px; font-weight: bold; padding: 0.5px 0.5px; width: 100%; text-align: center;">
<table border="1px" cellspacing="0" cellpadding="1" style="background-color: #FFFFCC; border: 1px outset #FFFFFF; color: #440000;  font-size: 13px; font-weight: bold; padding: 0.5px 0.5px; width: 100%; text-align: center;">
<tr>
<td>Loại mua</td>
<td>Giá mua</td>
</tr>



<tr>
<td><font color="blue">1 ngày x2</td></font>
<td><font color="blue">500.000 lượng clan</td>
</tr>
<tr>
<td><font color="blue">5 ngày x2</td></font>
<td><font color="blue">2.000.000 lượng clan</td></tr>
<tr>
<td><font color="blue">1 ngày x4</td></font>
<td><font color="blue">1.000.000 lượng clan</td>
</tr>

<tr>

<td><font color="blue">5 ngày x4</td></font>
<td><font color="blue">4.500.000 lượng clan</td>
</tr>

</table>

</div>';
echo'<div class="bg-content"><b><font color="red">Chú ý: Sau khi mua xong bạn hãy nhắc toàn bộ thành viên trong clan thoát game xong vào lại mới được áp dụng X kinh nghiệm nhé!</b></font></div>';


echo'<div class="box_topss" style="float: left;width: 100%;color: #FFFFFF;background-color: #561d00;font-size: 17px;"><span>Cửa hàng gia tộc</span></div></div>';
        $page     = mysql_real_escape_string(isset($_GET['page']) ? $_GET['page'] : 1);
        $limit    = mysql_real_escape_string(isset($_GET['limit']) ? $_GET['limit'] : 20);
        $order    = mysql_real_escape_string(isset($_GET[order]) ? $_GET[order] : 'id');
        $type     = mysql_real_escape_string(isset($_GET[type]) ? $_GET[type] : 'DESC');
        $start    = ($page - 1) * $limit;
        $numbshop = mysql_result(mysql_query("SELECT COUNT(*) FROM `clan_shop`"), 0);



echo'<div class="table-responsive">
<div class="bg-content">
<table border="1px" cellspacing="0" cellpadding="1" style="background-color: #FFFFCC; border: 1px outset #FFFFFF; color: #440000;  font-size: 13px; font-weight: bold; padding: 0.5px 0.5px; width: 100%; text-align: center;">
<tr>
<td>Hình Ảnh</td>
<td>Mô Tả</td>
<td>Giá Bán</td> 
<td>Thao Tác</td>
</tr>';
$req = mysql_query("SELECT * FROM `clan_shop` ORDER BY `$order` $type LIMIT $start, $limit");
            while ($shop = mysql_fetch_assoc($req)) {
echo'<tr><td><font color="blue"><img src="/clan/icon/'.$shop['icon'].'.png"/></font></td>';

echo'<td><font color="blue">'.$shop['mota'].'</font></td>';

echo'<td><font color="#009999">'.number_format($shop['luong']).' lượng clan + '.number_format($shop['conghien']).' cống hiến</font></td>';

echo'<td><a href="/clan/buyy.php?id='.$shop['id'].'"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 55px; text-align: center;">Mua Ngay</button></a>
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