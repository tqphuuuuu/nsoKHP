<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
include 'in/conn.php';
$status = $_GET['status'];
$message = $_GET['message'];
$amount = $_GET['amount'];
$request_id = $_GET['request_id'];


if($status == 1){
if(mysql_num_rows(mysql_query("SELECT request_id FROM topup WHERE request_id='".$request_id."'")) == 1){
$id = mysql_fetch_array(mysql_query("SELECT * FROM `topup` WHERE `request_id`='" . $request_id . "' LIMIT 1")); 
if($id['trangthai'] == 0){

@mysql_query("UPDATE `users` SET `vnd` = `vnd` + '$amount', `tongnap` = `tongnap` + '$amount', `naptuan` = `naptuan` + '$amount' WHERE `username` = '".$id['username']."' ");
@mysql_query("UPDATE `topup` SET `trangthai` = '1' WHERE `request_id` = '$request_id' ");
@mysql_query("UPDATE `player` SET `nap` = `nap` + '$amount' WHERE `username` = '".$id['username']."' ");
echo' '.$id['username'].' + '.$amount.'vnd <br>';
echo' '.$id['username'].' + '.$amount.'vnd <br>';

}
}
}
?>