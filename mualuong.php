<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
include 'in/config.php';

if(isset($_SESSION['usermem'])){
echo'<div class="bg-content">
<div style="font-size:12px" align="right"><font color="blue">
Xin chào <b>'.$users['username'].' </b> - Số dư <b>'.number_format($users['vnd']).'</b> VND</font>
<a href="/naptien"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 55px; text-align: center;">Nạp Tiền</button></a>





<a href="/logout.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Đăng Xuất</button></a>

</div>
</div>';
if (isset($_POST['submit'])) {

if($_POST['vnd'] == 10000){
$luong = '250000';
}

if($_POST['vnd'] == 20000){
$luong = '550000';
}


if($_POST['vnd'] == 30000){
$luong = '800000';

}

if($_POST['vnd'] == 50000){
$luong = '1600000';

}
if($_POST['vnd'] == 100000){
$luong = '3500000';
} 

if($_POST['vnd'] == 200000){
$luong = '8000000';
} 
if($_POST['vnd'] == 500000){
$luong = '25000000';
} 

if($users['vnd'] < $_POST['vnd']){
echo'<div class="bg-content"><font color="red"><b>Lỗi bạn không đủ tiền</font></b></div>';
} else {
$time = date("H:i:s d-m-Y");
@mysql_query("INSERT INTO history(`username`,`id_damua`, `vnd`, `loaimua`, `time`) VALUES ('".$users['username']."','0','".$_POST['vnd']."','Mua lượng','".$time."');");

@mysql_query("UPDATE `users` SET `vnd` = `vnd` - '".$_POST['vnd']."' WHERE `username` = '".$users['username']."' ");
@mysql_query("UPDATE `player` SET `luong` = `luong` + '".$luong."' WHERE `username` = '".$users['username']."' ");
echo'<div class="bg-content"><font color="blue"><b>Mua thành công '.$luong.' lượng!</font></b></div>';
}
}


echo'<div class="bg-content"><form method="POST" action=""><b>Bạn muốn mua bao nhiêu lượng? <br><select class="form-control" name="vnd">
                                                <option value="10000">10,000 VND</option>
                                                <option value="20000">20,000 VND</option>
<option value="30000">30,000 VND</option>                                                <option value="50000">50,000 VND</option>
                                                <option value="100000">100,000 VND</option>
                                                <option value="200000">200,000 VND</option>
<option value="500000">500,000 VND</option>                                            </select><button type="submit" name="submit">Mua</button></form> </div>';

echo'<div class="bg-content"><table border="1px" cellspacing="0" cellpadding="1" style="background-color: #FFFFCC; border: 1px outset #FFFFFF; color: #440000;  font-size: 13px; font-weight: bold; padding: 0.5px 0.5px; width: 100%; text-align: center;">
<table border="1px" cellspacing="0" cellpadding="1" style="background-color: #FFFFCC; border: 1px outset #FFFFFF; color: #440000;  font-size: 13px; font-weight: bold; padding: 0.5px 0.5px; width: 100%; text-align: center;">
<tr>
<td>Giá VND</td>
<td>Lượng nhận được</td>
</tr>



<tr>
<td><font color="blue">10,000VND</td></font>
<td><font color="blue">250.000 lượng</td>
</tr>
<tr>
<td><font color="blue">20,000VND</td></font>
<td><font color="blue">550.000 lượng</td></tr>
<tr>
<td><font color="blue">30,000VND</td></font>
<td><font color="blue">800.000 lượng</td>
</tr>

<tr>

<td><font color="blue">50,000VND</td></font>
<td><font color="blue">1.600.000 lượng</td>
</tr>
<tr>
<td><font color="blue">100,000VND</td></font>
<td><font color="blue">3.500.000 lượng</td>
</tr>
<tr>
<td><font color="blue">200,000VND</td></font>
<td><font color="blue">8.000.000 lượng</td>
</tr>
<tr>
<td><font color="blue">500,000VND</td></font>
<td><font color="blue">25.000.000 lượng</td>
</tr>
</table>

</div>';

}
                    	
		                          											
include 'in/foot.php';
?>