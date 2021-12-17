<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
include '../in/conn.php';
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

$result = curl_get_contents("https://api.web2m.com/historyapimomo1h/8F1859EE-4EE9-74F4-FFE8-FE8B471983B2");


        $result = json_decode($result, true);
        foreach ((array) $result['momoMsg']['tranList'] as $data)
        {
            $partnerId      = $data['partnerId'];               // SỐ ĐIỆN THOẠI CHUYỂN
            $comment        = $data['comment'];                 // NỘI DUNG CHUYỂN TIỀN
            $tranId         = $data['tranId'];                  // MÃ GIAO DỊCH
            $partnerName    = $data['partnerName'];             // TÊN CHỦ VÍ
            $amount         = $data['amount'];                  // SỐ TIỀN CHUYỂN
            $io         = $data['io'];                  // IO

            $username = substr($comment ,+7);


if($io == 1){
if(mysql_num_rows(mysql_query("SELECT idmomo FROM topup WHERE idmomo='".$tranId."'")) == 0){
$time = date("H:i:s d-m-Y");

@mysql_query("INSERT INTO topup(`idmomo`, `trangthai`, `vnd`, `username`, `time`) VALUES ('".$tranId."','1','".$amount."','".$username."','".$time."');");
@mysql_query("UPDATE `users` SET `vnd` = `vnd` + '$amount', `tongnap` = `tongnap` + '$amount', `naptuan` = `naptuan` + '$amount' WHERE `username` = '$username' ");
echo' '.$username.' + '.$amount.'vnd <br>';
}
}



}
        

?>