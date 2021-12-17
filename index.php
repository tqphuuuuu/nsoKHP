<?php
include 'in/config.php';

if(!isset($_SESSION['usermem'])){
?>


<div class="bg-content"><img class="mySlides" src="/images/banner/1.jpg" alt="HKH" style="width:100%">
            <img class="mySlides" src="/images/banner/2.jpg" alt="HKH" style="width:100%">
            <img class="mySlides" src="/images/banner/3.jpg" alt="HKH" style="width:100%">
<img class="mySlides" src="/images/banner/6.jpg" alt="HKH" style="width:100%">

        </div>
        <script>
            var myIndex = 0;
            carousel();

            function carousel() {
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                myIndex++;
                if (myIndex > x.length) {
                    myIndex = 1
                }
                x[myIndex - 1].style.display = "block";
                setTimeout(carousel, 1500);
            }
        </script>	
																	
<div class="box_topss" style="float: left;width: 100%;color: #FFFFFF;background-color: #561d00;font-size: 17px;"><span>Welcome to NSO HKH Family!</span></div>

<div class="bg-content" style="text-align:center">
 <div id="result"></div><br>

<br>    <form action="reg.php" method="POST">
        <span style="margin-left:-115px; font-family: AVO, Arial !important;"><b>Tài khoản:</b></span><br>
        <input id="user" style="margin-top:3px; margin-bottom:5px"><br>
        <span  style="margin-left:-113px;font-family: AVO, Arial !important;"><b> Mật khẩu: </b></span><br>
        <input id="pass" style="margin-top:3px; margin-bottom:5px"><br>

                                            
                <button type="button" onclick="reg();" id="regg">Đăng Ký</button> <button type="button" onclick="log();" id="logg">Đăng Nhập</button><br><br>Chú ý: tên tài khoản phải viết thường hết không được viết hoa!<br>Mật khẩu phải từ 5 kí tự trở lên!
      <form>
    																	</div>
<?php
} else {
echo'<div class="bg-content">
<div style="font-size:12px" align="right"><font color="blue">
Xin chào <b>'.$users['username'].' </b> - Số dư <b>'.number_format($users['vnd']).'</b> VND</font>
<a href="/naptien"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 55px; text-align: center;">Nạp Tiền</button></a>

<a href="/mualuong.php"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Mua Lượng</button></a>

<a href="/clan"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 45px; text-align: center;">Clan</button></a>

<a href="/password.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Đổi MKhẩu</button></a>

<a href="/logout.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Đăng Xuất</button></a>

</div>
</div>';

if(empty($users['timepass'])){
Header('location: /password.php');
exit;
}

if(empty($users['kichhoat'])){
echo'<div class="bg-content"><center><font color="red"><b>CHÚ Ý: Tài khoản của bạn chưa kích hoạt nên không thể vào game hãy kích hoạt tài khoản để chơi game nhé! Phí kích hoạt tài khoản là: <b>20.000VND</b></b></font><br>


<a href="/kichhoat.php"><button style="background-color: #FF6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 85px; text-align: center;">Kích Hoạt Ngay</button></a>

</div>';

?>
<script>
        Swal({
            title: 'Tài khoản chưa kích hoạt',
            text: 'Tài khoản của bạn hiện tại chưa được kích hoạt nên sẽ không thể vào được game vui lòng kích hoạt tài khoản để vào game!',
            type: 'error',
            confirmButtonText: 'Đã hiểu'
        })
    
</script>
<?php
}




echo'<div id="okfree"></div>';



if($users['kichhoat'] == 1){
if (time()>$users['free']+3600*24) {
echo'<div class="bg-content"><center><font color="#FF3300"><b>Hôm nay bạn chưa nhận quà báo danh từ hệ thống. Chú ý trước khi nhận quà phải thoát game mới nhận được nhé!</b><br><button type="button" onclick="free();" value="ok" id="ok">Nhận Quà Ngay</button></center></div> ';
}


if (isset($_POST['fix'])) {
$a = mysql_fetch_array(mysql_query("SELECT * FROM `player` WHERE `username`='".$users['username']."' LIMIT 1")); 
$a = json_decode($a['ninja'], true);
$ninja = $a[0];
@mysql_query("UPDATE `ninja` SET `site` = '[22,1659,264]' WHERE `name` = '".$ninja."' ");
?>
<script>
        Swal({
            title: 'Thành công!',
            text: 'Ok giờ thím vô game xem vô được chưa nếu ko được thử làm lại xem nếu vẫn không được thì inbox admin nhé!',
            type: 'success',
            confirmButtonText: 'Xong'
        })
    
</script>  
<?php


}




echo'<div class="bg-content"><center><form method="POST" action=""><button type="submit" name="fix">Fix lỗi map xoay game</button></form> </center></div>';




}


echo'<div class="bg-content">
		                            
		                            	<div class="title"><h4>Bảng Xếp Hạng Sự Kiện</h4></div>
		                            	<div class="content">';
$req = mysql_query("SELECT * FROM `player`  WHERE `topsk` >= '1' ORDER BY `topsk` DESC LIMIT 10");
$i = 1;
while ($top=mysql_fetch_array($req)) {

$a = json_decode($top['ninja'], true);
$ninja = $a[0];


echo'<div class="title">';
if($i == 1){
echo'<font color="red"><b>[TOP '.$i.']</b> ';
} else if($i == 2){
echo'<font color="blue"><b>[TOP '.$i.']</b> ';
} else if($i == 3){
echo'<font color="green"><b>[TOP '.$i.']</b> ';
} else {
echo'<font color="#008080"><b>#'.$i.'</b> ';
}


echo''.$ninja.'</font> - <font color="#009999">'.number_format($top['topsk']).' điểm</font></div>';
++$i;
               }


echo'</div></div>';
if($users['admin'] == 'admin'){

echo' <div class="bg-content">
		                            
		                            	<div class="title"><h4>Bảng Xếp Hạng Nạp Tuần</h4></div>
		                            	<div class="content">';
$req = mysql_query("SELECT * FROM `users`  WHERE `naptuan` >= '1' ORDER BY `naptuan` DESC LIMIT 10");
$i = 1;
while ($top=mysql_fetch_array($req)) {
echo'<div class="title">';
if($i == 1){
echo'<font color="red"><b>[TOP '.$i.']</b> ';
} else if($i == 2){
echo'<font color="blue"><b>[TOP '.$i.']</b> ';
} else if($i == 3){
echo'<font color="green"><b>[TOP '.$i.']</b> ';
} else {
echo'<font color="#008080"><b>#'.$i.'</b> ';
}


echo''.$top['username'].'</font> - <font color="#009999">'.number_format($top['naptuan']).' VND</font></div>';
++$i;
               }


echo'- Những TOP 1,2,3 sẽ được admin tặng quà hàng tuần!</div></div>';
}

echo'<div class="bg-content">
		                            
		                            	<div class="title"><h4>Bảng Xếp Hạng Nạp Tiền</h4></div>
		                            	<div class="content">';
$req = mysql_query("SELECT * FROM `users`  WHERE `tongnap` >= '1' ORDER BY `tongnap` DESC LIMIT 10");
$i = 1;
while ($top=mysql_fetch_array($req)) {
echo'<div class="title">';
if($i == 1){
echo'<font color="red"><b>[TOP '.$i.']</b> ';
} else if($i == 2){
echo'<font color="blue"><b>[TOP '.$i.']</b> ';
} else if($i == 3){
echo'<font color="green"><b>[TOP '.$i.']</b> ';
} else {
echo'<font color="#008080"><b>#'.$i.'</b> ';
}


echo''.$top['username'].'</font> - <font color="#009999">'.number_format($top['tongnap']).' VND</font></div>';
++$i;
               }


echo'- Những TOP 1,2,3 sẽ được admin tặng quà hàng tháng!</div></div>';



}
?>



<div class="bg-content">
		                            <div>
		                            	<div class="title"><h4>HƯỚNG DẪN VÀO GAME LẦN ĐẦU</h4></div>
		                            	<div class="content"><iframe width="100%" height="315" src="https://www.youtube.com/embed/EClxfAb53OM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 


</div>
		                            	 </div></div>
		                            	
		                            
<div class="bg-content">
		                            <div>
		                            	<div class="title"><h4>HƯỚNG DẪN FIX LỖI ĐƠ GAME 100% CHO PHIÊN BẢN JAVA</h4></div>
		                            	<div class="content">
<p>- <a href="/downloads/data_HKH.zip">Nhấn Vào Đây Để Tải Data Fix Đơ Game</a></p>
<p>- <a href="https://play.google.com/store/apps/details?id=ru.zdevs.zarchiver">Nhấn Vào Đây Để Tải Ứng Dụng Zarchiver</a></p>
<iframe width="100%" height="415" src="https://www.youtube.com/embed/fd2XMzzw-_Q" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
		</div></div>                            	
		                          											
<?php
include 'in/foot.php';
?>