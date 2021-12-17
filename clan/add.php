<?php
include '../in/config.php';

if(isset($_SESSION['usermem'])){
echo'<div class="bg-content">
<div style="font-size:12px" align="right"><font color="blue">
Xin chào <b>'.$users['username'].' </b> - Số dư <b>'.number_format($users['vnd']).'</b> VND</font>
<a href="/naptien"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 55px; text-align: center;">Nạp Tiền</button></a>





<a href="/logout.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Đăng Xuất</button></a>

</div>
</div>';


if($users['admin'] == 'admin'){


if (isset($_POST['submit'])) {
$icon = $_POST['icon'];
$luong = $_POST['luong'];
$conghien = $_POST['conghien'];
$mota = $_POST['mota'];
$add = $_POST['add'];



if(empty($icon) || empty($luong) || empty($conghien) || empty($mota) || empty($add)){


echo'<div class="bg-content">Chưa nhập đủ thông tin</div>';

} else {
@mysql_query("INSERT INTO clan_shop(`icon`,`luong`, `conghien`, `mota`, `add`) VALUES ('".$icon."','".$luong."','".$conghien."','".$mota."','".$add."');");
echo'<div class="bg-content">Thêm thành công</div>';


}



}



echo'<div class="bg-content"><form method="POST" action=""><b>Add đồ shop clan <br><br>
Lượng:<br><input type="number" name="luong"/><br><br>
Cống hiến:<br><input type="number" name="conghien"/><br><br>
ID icon:<br><input type="number" name="icon"/><br><br>
Mô tả:<br><input name="mota"/><br><br>Add:<br><input name="add"/><br><button type="submit" name="submit">Thêm</button></form> </div>';


}}
                		                          											
include '../in/foot.php';
?>