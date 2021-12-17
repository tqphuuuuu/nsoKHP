<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");

include '../in/conn.php';

    if (!isset($_POST['telco']) || !isset($_POST['amount']) || !isset($_POST['serial']) || !isset($_POST['code'])) {
        ?>

<script>
        Swal({
            title: 'Lỗi nạp thẻ',
            text: 'Bạn vui lòng nhập đủ thông tin thẻ!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  

<?
    } else {

        $request_id = rand(100000000, 999999999);  //Mã đơn hàng của bạn
        $command = 'charging';  // Nap the
        $url = 'https://thesieure.com/chargingws/v2?';
        $partner_id = '2024418261';
        $partner_key = 'd03909e41b0cebed4c5d1880d47b019f';

        $dataPost = array();
        $dataPost['request_id'] = $request_id;
        $dataPost['code'] = $_POST['code'];
        $dataPost['partner_id'] = $partner_id;
        $dataPost['serial'] = $_POST['serial'];
        $dataPost['telco'] = $_POST['telco'];
        $dataPost['command'] = $command;
        ksort($dataPost);
        $sign = $partner_key;
        foreach ($dataPost as $item) {
            $sign .= $item;
        }
        
        $mysign = md5($sign);

        $dataPost['amount'] = $_POST['amount'];
        $dataPost['sign'] = $mysign;

        $data = http_build_query($dataPost);
        function curl_get_contents($url)
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
$url .= $data;
$result = curl_get_contents($url);

        $obj = json_decode($result);

        if ($obj->status == 99) {
            //Gửi thẻ thành công, đợi duyệt.
$time = date("H:i:s d-m-Y");
@mysql_query("INSERT INTO topup(`request_id`,`trangthai`, `vnd`, `username`, `time`) VALUES ('".$request_id."','0','".$_POST['amount']."','".$users['username']."','".$time."');");
            ?>
<script>
        Swal({
            title: 'Thành công!',
            text: 'Gửi thẻ thành công! Bạn vui lòng đợi 1-5 phút để hệ thống duyệt và cộng tiền cho bạn nhé',
            type: 'success',
            confirmButtonText: 'Xong'
        })
    
</script>  
<?php
        } elseif ($obj->status == 1) {
            //Thành Công
@mysql_query("INSERT INTO topup(`request_id`,`trangthai`, `vnd`, `username`, `time`) VALUES ('".$request_id."','1','".$obj['amount']."','".$users['username']."','".$time."');");
@mysql_query("UPDATE `users` SET `vnd` = `vnd` + '".$obj['amount']."', `tongnap` = `tongnap` + '".$obj['amount']."', `naptuan` = `naptuan` + '".$obj['amount']."' WHERE `username` = '".$users['username']."' ");
            ?>
<script>
        Swal({
            title: 'Nạp thành công!',
            text: 'Bạn nhận được <?=$obj['amount']?> vnd',
            type: 'success',
            confirmButtonText: 'Xong'
        })
    
</script>  
<?php
        } elseif ($obj->status == 2) {
            //Thành công nhưng sai mệnh giá
            ?>
<script>
        Swal({
            title: 'Lỗi nạp thẻ',
            text: 'Bạn đã chọn sai mệnh giá. Hệ thống đã cảnh báo và sẽ không chịu trách nhiệm!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<?php
        } elseif ($obj->status == 3) {
            //Thẻ lỗi
            ?>
<script>
        Swal({
            title: 'Lỗi nạp thẻ',
            text: 'Thẻ bạn nhập không đúng hoặc đã được sử dụng, vui lòng kiểm tra lại!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<?php
        } elseif ($obj->status == 4) {
            //Bảo trì
?>
            <script>
        Swal({
            title: 'Lỗi nạp thẻ',
            text: 'Thẻ bạn nhập không đúng hoặc đã được sử dụng, vui lòng kiểm tra lại!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<?php
        } else {
?>
            <script>
        Swal({
            title: 'Lỗi nạp thẻ',
            text: '<?=$obj->message?>',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  <?

        }


    }

?>
