<?php
include 'in/conn.php';

$req = mysql_query("SELECT * FROM `player`  WHERE `topsk` >= '1' ORDER BY `topsk` DESC LIMIT 3");
$i = 1;
while ($top=mysql_fetch_array($req)) {

$a = json_decode($top['ninja'], true);
$ninja = $a[0];


echo'<div class="title">';
if($i == 1){
@mysql_query("UPDATE `ninja` SET `top` = 'Đẹp Trai Nhất Sever' WHERE `name` = '".$ninja."' ");

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




$req = mysql_query("SELECT * FROM `users`  WHERE `naptuan` >= '1' ORDER BY `naptuan` DESC LIMIT 3");
$i = 1;
while ($top=mysql_fetch_array($req)) {

$nick = mysql_fetch_array(mysql_query("SELECT * FROM `player` WHERE `username`='" . $top['username'] . "' LIMIT 1")); 
$a = json_decode($nick['ninja'], true);
$ninja = $a[0];


echo'<div class="title">';
if($i == 1){
@mysql_query("UPDATE `ninja` SET `top` = 'Chủ Tịch' WHERE `name` = '".$ninja."' ");

echo'<font color="red"><b>[TOP '.$i.']</b> '.$ninja.'';
} else if($i == 2){
@mysql_query("UPDATE `ninja` SET `top` = 'Dân Chơi' WHERE `name` = '".$ninja."' ");

echo'<font color="blue"><b>[TOP '.$i.']</b> '.$ninja.'';
} else if($i == 3){

@mysql_query("UPDATE `ninja` SET `top` = 'Thiếu Gia' WHERE `name` = '".$ninja."' ");

echo'<font color="green"><b>[TOP '.$i.']</b> '.$ninja.'';
} else {
echo'<font color="#008080"><b>#'.$i.'</b> ';
}


echo''.$ninja.'</font> - <font color="#009999">'.number_format($top['id']).'</font></div>';
++$i;
               }

$req = mysql_query("SELECT * FROM `users`  WHERE `tongnap` >= '1' ORDER BY `tongnap` DESC LIMIT 3");
$i = 1;
while ($top=mysql_fetch_array($req)) {

$nick = mysql_fetch_array(mysql_query("SELECT * FROM `player` WHERE `username`='" . $top['username'] . "' LIMIT 1")); 
$a = json_decode($nick['ninja'], true);
$ninja = $a[0];


echo'<div class="title">';
if($i == 1){
@mysql_query("UPDATE `ninja` SET `top` = '[TOP 1 SEVER]' WHERE `name` = '".$ninja."' ");

echo'<font color="red"><b>[TOP '.$i.']</b> '.$ninja.'';
} else if($i == 2){
@mysql_query("UPDATE `ninja` SET `top` = 'Đại Gia' WHERE `name` = '".$ninja."' ");

echo'<font color="blue"><b>[TOP '.$i.']</b> '.$ninja.'';
} else if($i == 3){

@mysql_query("UPDATE `ninja` SET `top` = 'Đại Gia' WHERE `name` = '".$ninja."' ");

echo'<font color="green"><b>[TOP '.$i.']</b> '.$ninja.'';
} else {
echo'<font color="#008080"><b>#'.$i.'</b> ';
}


echo''.$ninja.'</font> - <font color="#009999">'.number_format($top['id']).'</font></div>';
++$i;
               }



echo'<br>';
?>