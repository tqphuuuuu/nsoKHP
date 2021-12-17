<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
include '../in/config.php';
?>
        <script language="javascript">
            function nap(){
     $("#nap5").text("Đang kiểm tra Vui lòng đợi...");
                $.ajax({
                    url : "jnap.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         telco : $('#telco').val(), amount : $('#amount').val(),  serial : $('#serial').val(), code : $('#code').val()
                    },
                    success : function (result){
                        $('#resultnap').html(result);
                    }
                });
            

}
       
 </script>

<script>
        Swal({
            title: 'Lưu ý trước khi nạp tiền',
            text: 'Bạn vui lòng thoát khỏi game trước khi nạp tiền, sau khi hệ thống cộng tiền thành công thì bạn hẵng vào game. Nếu không sẽ bị lỗi không nhận được quà',
            type: 'error',
            confirmButtonText: 'Đã hiểu'
        })
    
</script>
<style>
.item-aside {
	float: left;
}
.item-content {
	height: 100%;
	margin: 5px 0 0 45px;
	padding: 0;
}
</style>
<?php

if(!isset($_SESSION['usermem'])){
Header('location: /index.php');
} else {
echo'<div class="bg-content">
<div style="font-size:12px" align="right"><font color="blue">
Xin chào <b>'.$users['username'].' </b> - Số dư <b>'.number_format($users['vnd']).'</b> VND</font>

<a href="/mualuong.php"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Mua Lượng</button></a>

<a href="/password.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 60px; text-align: center;">Đổi MKhẩu</button></a>


<a href="/logout.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Đăng Xuất</button></a>

</div>
</div>';
echo'<div class="bg-content" id="click"><div class="item-aside"><img src="/images/momo.png" width="40"></div>
<div class="item-content"> <font color="#003366"><b>Nạp qua ví MoMo</b><br>
Nạp tự động với Momo, hoàn thành trong 1-3 phút.</font><br><br></div>
</div>

<div class="bg-content" id="show" style="display: none;"> <div class="title">
<h4>Cách 1: Chuyển tiền momo</h4>
</div><br>
1. Đăng nhập vào ví momo của bạn hoặc <a href="https://nhantien.momo.vn/0963056319"> <font color="red"><b>Nhấn Vào Đây</b></a></font> <br><br>

2. Chọn số tiền bạn muốn nạp vào tài khoản
<br><br>
3. Nhập lời nhắn: <b><font color="red" size="3">HKH '.$users['username'].'</b></font> (Kiểm tra kĩ lời nhắn, nếu sai sẽ không nhận được tiền)<br><br>

4. Chuyển số tiền bạn muốn nạp tới số <font color="red" size="3">0963056319</font><br><br>

<b>Chú Ý: Sau khi chuyển tiền từ 1-3 phút hệ thống mới cộng tiền cho bạn. Nếu bị lỗi hoặc có vấn đề gì hãy inbox cho admin qua group zalo nhé!</b><br><br>
<div class="title">
<h4>Cách 2: Quét mã QR</h4>
</div><br><center>
<img src="https://i.imgur.com/qDcZHgX.jpg" width="300"><br><br>

<font color="blue">Quét mã QR trên, nhập số tiền bạn cần nạp và nhập lời nhắn:</font> <font color="red"><b>HKH '.$users['username'].'</b></font><br><br></center>

<b>Chú Ý: Sau khi chuyển tiền từ 1-3 phút hệ thống mới cộng tiền cho bạn. Nếu bị lỗi hoặc có vấn đề gì hãy inbox cho admin qua group zalo nhé!</b>

</div>';

echo'

<div class="bg-content" id="vao"><div class="item-aside"><img src="/images/card.png" width="40"></div>
<div class="item-content"> <font color="#003366"><b>Nạp qua thẻ cào</b><br>
Nạp qua thẻ cào, hoàn thành trong 3-5 phút. Phí giao dịch 20-30%.</font><br><br></div>
</div>
<div id="resultnap"></div>
<div class="bg-content" id="ra" style="display: none;"><form method="POST" action="">
                <div class="form-group">
                    <label><div class="title">Loại thẻ:</label><br>
                    <select class="form-control" id="telco">
                        <option value="">Chọn loại thẻ</option>
                        
                        <option value="VIETTEL">Viettel</option>
                        
                        <option value="MOBIFONE">Mobifone</option>
                        
                        <option value="VINAPHONE">Vinaphone</option>
                        <option value="GATE">Gate</option>
                        <option value="ZING">Zing</option>
                        <option value="MEGACARD">Megacard</option>
                        <option value="BIT">BIT</option>
                        <option value="GARENA">Garena</option>
                    </select>
                </div><br>
                <div class="form-group">
                    <label><div class="title">Mệnh giá (nhớ chọn đúng nếu không sẽ mất thẻ):</label><br>
                    <select class="form-control" id="amount">
                        <option value="">Chọn mệnh giá</option>
<option value="10000">10.000d </option>
<option value="20000">20.000d </option>
<option value="30000">30.000d </option>
                        <option value="50000">50.000d </option>
                        <option value="100000">100.000d </option>
                        <option value="200000">200.000d </option>
                        <option value="300000">300.000d </option>
                        <option value="500000">500.000d </option>
                        <option value="1000000">1.000.000d</option>
                    </select>
                </div><br>
                <div class="title">
                    <label>Số seri:</label>
                    <input  class="form-control" id="serial"/>
                </div><br>
                <div class="title">
                    <label>Mã thẻ:</label>
                    <input class="form-control" id="code"/>
                </div>
                <div class="form-group">
                    <button type="button" onclick="nap();" id="nappp" ">Nạp Tiền</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<div class="bg-content" id="c"><div class="item-aside"><img src="/images/pay3.png" width="40"></div>
<div class="item-content"> <font color="#003366"><b>Nạp qua Ngân Hàng</b><br>
Nạp qua chuyển khoản Ngân Hàng, cách này sẽ không được nạp auto phải đợi admin duyệt tay!</font><br><br></div>
</div>
<div class="bg-content" id="s" style="display: none;">- Bạn chuyển khoản số tiền muốn nạp kèm nội dung chuyển khoản ghi:  <b><font color="red" size="3">HKH '.$users['username'].'</b></font> (Kiểm tra kĩ lời nhắn, nếu sai sẽ không nhận được tiền)<br><br>- Ngân hàng Techcombank<br>STK: <b> <font color="blue">19034185429019</font></b> <br>Chủ tài khoản <b><font color="blue">TRIEU TIEN VUONG</font></b></div>


';





echo'<div class="bg-content">
<div class="title">
<h4>Lịch Sử Nạp Thẻ</h4>
</div>
<div class="table-responsive">
<div class="content">
<table border="1px" cellspacing="0" cellpadding="1" style="background-color: #FFFFCC; border: 1px outset #FFFFFF; color: #440000;  font-size: 13px; font-weight: bold; padding: 0.5px 0.5px; width: 100%; text-align: center;">
<tr>
<td>#</td>
<td>Phương Thức</td>
<td>Mệnh Giá</td>
<td>Trạng Thái</td>
<td>Thời Gian</td>
</tr>';
$topup = mysql_query("SELECT * FROM `topup` WHERE `username`='".$users['username']."' ORDER BY `id` LIMIT 1000");
            while ($info = mysql_fetch_assoc($topup)) {
echo'<tr><td>'.$info['id'].'</td>';
if($info['idmomo']){
echo'<td><font color="blue">Momo</font></td>';
} else {
echo'<td><font color="blue">Thẻ cào</font></td>';
}
echo'<td> <font color="green">'.number_format($info['vnd']).'</font></td>';
if($info['trangthai']){
echo'<td><font color="blue">Thành công</font></td>';
} else {
echo'<td>Đang chờ</td>';
}
echo'<td><font color="blue">'.$info['time'].'</font></td></tr>';


}

echo'

</table>
</div>
</div>';

}




include '../in/foot.php';
?>

<script type="text/javascript"> 
$('#click').click(function() {  
$('#show').toggle('fast','linear');  
}); 
$('#vao').click(function() {  
$('#ra').toggle('fast','linear');  
}); 
$('#c').click(function() {  
$('#s').toggle('fast','linear');  
}); 
$('#smsc').click(function() {  
$('#smss').toggle('fast','linear');  
}); 
</script>