<?php
session_start();
/**_Tác giải Thăng Kuppj_**/
/**_FACEBOOK vantuvm_**/
/**_AGGAME_**/
/*_chống truy cập liên tục_*/
function stop_website() {
$time = date("Y-m-d H:i:s");
$stop = $_SESSION['time_stop'];
$numbTime=strtotime($time)-strtotime($stop);
if($numbTime<2&&$_SESSION['number_spams']<5){
$_SESSION['number_spams'] +=1;
} else if($numbTime<2&&$_SESSION['number_spams']>=5){
$_SESSION['time_stop']=$time;
exit (0);
} else {
$_SESSION['number_spams']=0;
}
$_SESSION['time_stop']=$time;
}
/*_làm tròn thời gian bằng String_*/
function string_tempo_restas($time, $timeold){
$numb = strtotime($time)-strtotime($timeold);
if ($numb >= 31104000) {
return FLOOR($numb / 31104000)." năm";
} else if ($numb >= 2592000) {
return FLOOR($numb / 2592000)." tháng";
} else if ($numb >= 604800) {
return FLOOR($numb / 604800)." tuần";
} else if ($numb >= 86400) {
return FLOOR($numb / 86400)." ngày";
} else if ($numb >= 3600) {
return FLOOR($numb / 3600)." giờ";
} else if ($numb >= 60) {
return FLOOR($numb / 60)." phút";
} else {
return $numb." giây";
}
return;
}
/*_ẩn String bằng *_*/
function cover_letters($text,$length){
if($length>strlen($text)){
$length=strlen($text);
}else if($length<0){
$length=0;
}
for($i=0;$i<$length;$i++){
$srt=$srt."*";
}
return $srt.substr($text,$length);
}
/*_làm tròn số bằng String_*/
function get_string_number($num){
if ($num >= 1000000000) {
return ($num / 1000000000) + " tỷ";
} else if ($num >= 1000000) {
return ($num / 1000000) + " triệu";
} else if ($num >= 1000) {
return ($num / 1000) + " k";
} else {
return $num;
}
}
/*_thêm thời gian_*/
function add_Datetime($time,$timenew){
return $time;
}
stop_website();
?>