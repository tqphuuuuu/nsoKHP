<?php
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
include '../in/config.php';
if (isset($_SESSION['usermem'])) {
$a = mysql_fetch_array(mysql_query("SELECT * FROM `player` WHERE `username`='".$users['username']."' LIMIT 1")); 
$b = json_decode($a['ninja'], true);
$ninja = mysql_fetch_array(mysql_query("SELECT * FROM `ninja` WHERE `name`='".$b[0]."' LIMIT 1")); 
if(empty($ninja)){
?>
<script>
        Swal({
            title: 'Chưa tạo nhân vật',
            text: 'Bạn chưa kích hoạt tài khoản hoặc chưa tạo nhân vật ở sever chính thức!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<meta http-equiv="refresh" content="3;url=/">
<?
include '../in/foot.php';
Exit;
}
echo'<div class="bg-content">
<div style="font-size:12px" align="right"><font color="blue">Xin chào <b>'.$ninja['name'].' </b> -  Số dư <b>'.number_format($users['vnd']).'</b> VND</font><br>
<a href="/naptien"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Nạp Tiền</button></a>

<a href="/mualuong.php"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 70px; text-align: center;">Mua Lượng</button></a>

<a href="/clan"><button style="background-color: #00736b; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 45px; text-align: center;">Clan</button></a>

<a href="/password.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Đổi MKhẩu</button></a>

<a href="/logout.php"><button style="background-color: #CC6666; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 65px; text-align: center;">Đăng Xuất</button></a>

</div>
</div>';



echo'<div class="bg-content">';

    if ($_GET[clan] == 'reg') {
        $title = "Thành lập Clan";
        $name    = mysql_real_escape_string($_POST['name']);
        $reqclan = mysql_query("SELECT * FROM `clan` WHERE `name`= '$name' LIMIT 1");
echo'<div class="title"><center><font color="red">Phí thành lập Clan là 200.000 VND!</center></font></b></div><br>';
?>
<script>
        Swal({
            title: 'Chú ý khi lập clan',
            text: 'Bạn vui lòng thoát khỏi game trước khi tạo clan để tránh bị lỗi nhé.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  

<?
        if ($ninja['clan'] == 0) {
                if ($_POST['reg']) {

                    if ($name == null) {
?>
<script>
        Swal({
            title: 'Lỗi thành lập',
            text: 'Bạn vui lòng nhập đủ thông tin Clan muốn đăng ký.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
                        
                    <?
                    } else if ($users['vnd'] < 200000) {
?>
<script>
        Swal({
            title: 'Lỗi thành lập',
            text: 'Bạn không đủ 200.000 vnd để thành lập.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<?
 } else if(!preg_match('/^[A-Za-z0-9]+$/',$name)){
?>
<script>
        Swal({
            title: 'Lỗi đăng ký',
            text: 'Tên clan chỉ được phép ghi liền không dấu, và không có ký tự đặc biệt!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
                       
                        <?
                    } else if (mysql_num_rows($reqclan)) {
?>
                        <script>
        Swal({
            title: 'Lỗi thành lập',
            text: 'Tên clan đã tồn tại vui lòng chọn tên khác!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
                        <?} else if(mb_strlen($name, 'UTF-8') < 5 || mb_strlen($name, 'UTF-8') > 20 ){?>
<script>
        Swal({
            title: 'Lỗi đăng ký',
            text: 'Tên clan phải có độ dài từ 5 - 20 ký tự.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
<?} else {
                        if (mb_strlen($thongbao, "UTF-8") == 0) {
                            $thongbao = "Không có thông báo";
                        }
                        @mysql_query("INSERT INTO `clan`
                (`pc`,`thongbao`,`name`)
                VALUES
                ('".$ninja['name']."', '$thongbao', '$name') ");
                        $clan = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `pc`='".$ninja['name']."' LIMIT 1"));
                        @mysql_query("UPDATE `users` SET `vnd` = `vnd` - 200000 WHERE `username` = '".$users['username']."' ");
                        @mysql_query("UPDATE `ninja` SET `clan` = '".$clan['id']."', `iconclan`='4', `nameclan`='".$clan['name']."' WHERE `name` = '".$ninja['name']."' ");

                        header('Location: /clan/?clan=info');
                    }
                }
?>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <form action="" method="POST" name="reg">
                    
                    <table>
                        <tr>
                            <td>Tên Clan:</td>
                            <td><input name="name"  id="name" placeholder="Nhập tên Clan" /></td>
                        </tr>
                    </table>
                    
                    <button type="submit" name="reg" value="ok">Thành Lập</button>
                </form>
            <?
        } else {
?>
<script>
        Swal({
            title: 'Lỗi thành lập',
            text: 'Hiện tại bạn đang có Clan hãy rời khỏi để thành lập.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
            <?
        }
?>
       										
                       
            </div> <?
    } else if ($_GET[rights]) {
        include('in/conn.php');
        $clan    = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . $ninja[clan] . "' LIMIT 1"));
        $Mem     = mysql_fetch_array(mysql_query("SELECT * FROM `ninja` WHERE `name`='" . mysql_real_escape_string($_GET[rights]) . "' LIMIT 1"));
        if ($clan[pc] == $ninja['name'] && $Mem[clan] != 0 && $ninja[clan] == $Mem[clan] && $clan[pc] != $Mem[name]) {
            if ($clan[ppc] == $Mem['name']) {
                @mysql_query("UPDATE `ninja` SET `iconclan` = '2'  WHERE `name` = '{$Mem['name']}' ");
                @mysql_query("UPDATE `clan` SET `ppc` = '' WHERE `id` = '{$Mem['clan']}' ");
            } else {
                @mysql_query("UPDATE `ninja` SET `iconclan` = '3'   WHERE `name` = '{$Mem['name']}' ");
                @mysql_query("UPDATE `clan` SET `ppc` = '".$Mem[name]."' WHERE `id` = '{$Mem['clan']}' ");
            }
            header('Location: /clan/?clan=info');
        } else {
            header('Location: /clann/');
        }
    } else if ($_GET[clan] == xin) {
        $title = "Yêu cầu tham gia Clan";
        $clan    = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . $ninja[clan] . "' LIMIT 1"));
        $mbclan  = mysql_result(mysql_query("SELECT COUNT(*) FROM `ninja` WHERE `clan` = '" . $clan['id'] . "' "), 0);
        $join    = mysql_result(mysql_query("SELECT COUNT(*) FROM `ninja` WHERE (`join` = '" . $clan['id'] . "' AND `clan` = 0) "), 0);
        if ($ninja[clan] == $clan[id] && ($ninja['name'] == $clan[pc] || $ninja['name'] == $clan[ppc])) {
?>
            <div class="title"><center>Danh Sách Phê Duyệt</center></div>
            
            <?
            if ($join <= 0) {
?>
                <li><b><font color="blue">Không có yêu cầu tham gia nào</font></b></li>
                <?
            }
            $id     = mysql_real_escape_string($_POST[accept]);
            $accmem = mysql_fetch_array(mysql_query("SELECT * FROM `ninja` WHERE `name`='" . $id . "' LIMIT 1"));
            if ($_POST[accept] && $accmem[clan] == 0 && $mbclan < $clan[menmax]) {
                @mysql_query("UPDATE `ninja` SET `join` = '0', `iconclan` =  '2',`clan` =  '{$clan['id']}', `nameclan`='".$clan['name']."', `xexp` = '".$clan['xexp']."', `timeexp`='".$clan['timeexp']."' WHERE `name` = '".$accmem['name']."' ");
                @mysql_query("UPDATE `clan` SET `men` =  `men` + 1 WHERE `id` = '".$clan['id']."' ");
                ?><li>Đã phê duyệt <b><?= $accmem[name]; ?></b></li>
                        <?
            }
            $id = mysql_real_escape_string($_POST[disaccept]);
            if ($_POST[disaccept]) {
                $accmem = mysql_fetch_array(mysql_query("SELECT * FROM `ninja` WHERE `name`='".$accmem['name']."' LIMIT 1"));
                @mysql_query("UPDATE `ninja` SET `join` =  0 WHERE `name` = '{$id}' ");
?><li>Đã từ chối <b><?= $accmem[name]; ?></b></li>
                <?
            }
?>
                <?
            $Mem = mysql_query("SELECT * FROM `ninja` WHERE `join`='".$clan[id]."' ORDER BY `level` ASC ");
            while ($Member = mysql_fetch_assoc($Mem)) {
                if ($Member[join] == $clan[id] && $Member[clan] == 0) { {
?>
                        <form action="" method="post">
                            <table width="100%">
                                <tr>
                                    <td style="border: 1px solid #AAA">
                                        Tên: <b><font color="blue"><?= $Member[name] ?></font></b> - Level: <b><font color="blue"><?= $Member[level] ?></font></b> <br />
                                        
                                        <?
                        if ($mbclan < $clan[menmax]) {
?>
                                            <button type="submit" value="<?= $Member[name] ?>" name="accept">Chấp Nhận</button> - 
                                        <?
                        } else {
?>
                                            Không thể duyệt - 
                                        <?
                        }
?>
                                        <button type="submit" value="<?= $Member[name] ?>" name="disaccept">Từ Chối</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <?
                    }
                }
?>
            <?
            }
?><br>
<li><a href="/clan/?clan=info">« Quay lại</a></li>
            <?
        } else {
            header('Location: /clan/?clan=info');
        }
    } else if ($_GET[clan] == 'edit') {
        $title = "Thiết lập Clan";
        
        $thongbao = mysql_real_escape_string($_POST['thongbao']);
        
        $clan     = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . $ninja[clan] . "' LIMIT 1"));
        if ($ninja[name] == $clan[pc]) {
?>
            <?
            if ($_POST['save']) {
                header('Location: /clan/?clan=edit');
                @mysql_query("UPDATE `clan` SET  `thongbao` =  '{$thongbao}' WHERE `id` = '{$clan[id]}' ");
            }
?>

            <form action="?clan=edit" method="POST">
                
                    
                    <center><h4>Sửa Thông Báo Clan</h4>
                        <textarea name="thongbao" id="thongbao" placeholder="<?= $clan['thongbao']; ?>" style="min-width:100px; max-width:98%;min-height:50px;height:100%;width:100%;"/></textarea>
                    <br>
                
                <button type="submit" name="save" value="ok">Lưu Lại
                </button>
            </form>

            <center><br><br />Bạn có thể nhường lại chức đội trưởng cho thành viên trong Clan của bạn với giá 5.000.000 lượng của Clan
                <br /></center>
            <em><font color="red">
                <br />
                <?
            if ($_POST['send'] && $_POST['newmaster']) {
                $newmaster = mysql_real_escape_string($_POST['newmaster']);
                $mbs       = mysql_result(mysql_query("SELECT COUNT(*) FROM `ninja` WHERE (`clan` = '" . $clan['id'] . "' AND `name` =  '" . $newmaster . "') "), 0);
                if ($clan[luong] < 5000000) {
?>
<script>
        Swal({
            title: 'Lỗi',
            text: 'Clan bạn không đủ 5.000.000 lượng.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  

                    <?
                } else if (!preg_match('/^[a-z0-9]+$/', $newmaster)) {
?>
<script>
        Swal({
            title: 'Lỗi',
            text: 'Tên tài khoản có chứa ký tự đặc biệt hoặc viết hoa.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
                        
                    <?
                } else if ($mbs == 0) {
?>
<script>
        Swal({
            title: 'Lỗi',
            text: 'Thành viên bạn vừa nhập không thuộc Clan của bạn.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
                        
                        <?
                } else {
                    $mem = mysql_fetch_array(mysql_query("SELECT * FROM `ninja` WHERE `name`='" . $newmaster . "' LIMIT 1"));
                    @mysql_query("UPDATE `clan` SET  `pc` =  '{$mem[name]}', `luong` = `luong` - 5000000 WHERE `id` = '{$clan[id]}' ");
                    @mysql_query("UPDATE `ninja` SET  `iconclan` =  '4'
WHERE `name` = '{$newmaster}' ");
@mysql_query("UPDATE `ninja` SET  `iconclan` =  '2'
WHERE `name` = '{$ninja['name']}' ");
?>
<script>
        Swal({
            title: 'Thành công!',
            text: 'Bạn đã chuyển nhượng Clan lại cho <?= $newmaster; ?> bạn sẽ không còn quyền hạn với Clan này.!',
            type: 'success',
            confirmButtonText: 'Đóng'
        })
    
</script>  
                        
                        <?
                }
            }
?></font></em>
            <form action="" method="POST" name="save">
               <center>
                    Người nhận:<br>
                    
                        <input name="newmaster" placeholder="Nhập tên thành viên" maxlength="20"  />
                    
                    <br>
<button type="submit" name="send" value="ok">Nhường Lại</button>
                        
                
                    
            </form>
<br>
            <br /><a href="/clan/?clan=info">« Quay lại</a></center>
        <?
        }
?>
        <?
    } else if ($_GET[kick]) {
        include('in/conn.php');
        $clan    = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . $ninja[clan] . "' LIMIT 1"));
        $Mem     = mysql_fetch_array(mysql_query("SELECT * FROM `ninja` WHERE `name`='" . mysql_real_escape_string($_GET[kick]) . "' LIMIT 1"));
        if ($ninja[clan] != 0 && $ninja[clan] == $Mem[clan]) {
            if (($clan[pc] == $ninja['name'] && $clan[pc] != $Mem['name']) || ($clan[ppc] == $ninja['name'] && $clan[ppc] != $Mem['name'])) {
                if ($clan[ppc] == $Mem['name']) {
                    @mysql_query("UPDATE `clan` SET `ppc` ='' WHERE `id` = '{$Mem['clan']}' ");
                }
                @mysql_query("UPDATE `ninja` SET `clan` = 0, `luongclan` = 0, `conghien` = 0, `iconclan` = 0, `nameclan` = '', `xexp` = 0, `timeexp` = '0' WHERE `name` = '{$Mem['name']}' ");
                @mysql_query("UPDATE `clan` SET `men` =  `men` - 1 WHERE `id` = '{$clan[id]}' ");
                header('Location: /clan/?clan=info');
            } else {
                header('Location: /clan/?clan=info');
            }
        } else {
            header('Location: /clan');
        }
    } else if ($_GET[thamgia] != 0) {
        include('in/conn.php');
        $clan    = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . mysql_real_escape_string($_GET[thamgia]) . "' LIMIT 1"));
        $mem     = mysql_result(mysql_query("SELECT COUNT(*) FROM `ninja` WHERE `clan` = '" . $clan['id'] . "' "), 0);
        if ($ninja[clan] == 0 && $mem < $clan[menmax]) {
            @mysql_query("UPDATE `ninja` SET `join` =  '{$clan['id']}' WHERE `name` = '{$ninja['name']}' ");
        }
        header('Location: /clan/');
    } else if ($_GET[thamgia] == huy) {
        @mysql_query("UPDATE `ninja` SET `join` = '' WHERE `name` = '{$ninja['name']}' ");
        header('Location: /clan/');
    } else if ($_GET[clan] == 'info') {
        $title = "Clan";
        if ($ninja['clan'] != 0) {
            $clan      = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . $ninja[clan] . "' LIMIT 1"));

            $bookmub   = mysql_result(mysql_query("SELECT COUNT(*) FROM `ninja` WHERE `join` = '" . $clan['id'] . "' AND `clan` = 0 "), 0);
            $numb = mysql_result(mysql_query("SELECT COUNT(*) FROM `ninja` WHERE `clan` = '" . $clan['id'] . "' "), 0);
            @mysql_query("UPDATE `clan` SET `men` = '{$numb}' WHERE `id` = '{$clan[id]}' ");
?>
            <h4><center><font  color="#FF7700"><b><?= $clan['name']; ?></b></font></center></h4>
            <center>THÔNG BÁO:<br />
                <b><?= $clan[thongbao]; ?></b>
<?php
if($clan['timeexp'] >= round(microtime(true) * 1000)){
$seconds = $clan['timeexp'] / 1000;
$time = date("H:ip, d/m/Y", $seconds);
echo'<br><br><marquee behavior="alternate"> <b><font color="blue">Tăng x'.$clan['xexp'].' kinh nghiệm cho toàn đội</font></marquee></b><br> <font color="green"><b>Thời hạn x'.$clan['xexp'].' tới '.$time.'</font></b>';
}
?>

            </center>

            <b><font color="blue">
                <li>Đội trưởng: <b><font color="red"><?= $clan['pc']; ?> </font></b></li>
                <li>Thành viên: <?= $numb ?> / <?= number_format($clan[menmax]); ?></li>
                
                
                <li>Điểm cống hiến: <?= number_format($clan[conghien]); ?> điểm</li>
<li>Tổng lượng: <?= number_format($clan[luong]); ?> lượng</li><br>
            </b>
            
            
            <?
            if (($clan['pc'] == $ninja['name']) && $bookmub > 0) {
?>
                <li><b>
                    <a href="/clan/?clan=xin" title="Đơn xin gia nập" alt="Đơn xin gia nhập">Yêu Cầu Tham Gia</b></a> (+<?= $bookmub; ?>) </li><br>
            <?
            }
?>
            <?
            if ($clan['pc'] == $ninja['name']) {
?>
                <li>
                    <a href="/clan/?clan=edit" title="chỉnh" alt="chỉnh sửa"><b>Thiết Lập Clan</b></a>
                </li><br>
            <li>
                    <a href="/clan/nangcap.php" title="nâng cấp" alt="nâng cấp"><b>Nâng cấp Clan</b></a>
                </li><br>
            <li>
                    <a href="shop.php"><b>Shop Clan</b></a>
                </li><br>
<li>
                    <a href="kho.php"><b>Kho Clan</b></a>
                </li>  <br>
            <?
            }
?>

          </font></b>


<?php
            if ($_POST['out'] && $clan['pc'] != $ninja['name']) {
                if ($clan[ppc] == $ninja['name']) {
                    @mysql_query("UPDATE `clan` SET `ppc` ='' WHERE `id` = '{$ninja['clan']}' ");
                }
                    @mysql_query("UPDATE `ninja` SET `clan` = 0, `luongclan` = 0, `conghien` = 0, `iconclan` = 0, `nameclan` = '', `xexp` = 0, `timeexp` = '0' WHERE `name` = '{$ninja['name']}' ");
                @mysql_query("UPDATE `clan` SET `men` =  `men` - 1 WHERE `id` = '{$clan[id]}' ");
                header('Location: /clan');
            }
?>
<form action="" method="POST" name="menu">
                <?
            if ($clan['pc'] != $ninja['name']) {
?>
                   <li><button type="submit" value="ok" name="out">Rời Clan</button></li><br>
                <?
            }
?>
            </form>


            <table width="100%">
                <tr>
                    <?
            $Topclan = mysql_fetch_array(mysql_query("SELECT * FROM `ninja` WHERE (`name`='" . $clan[pc] . "') LIMIT 1"));
?>
                    <td style="border: 1px solid #AAA">
                        <b><font color="red">[Đội trưởng] <?= $Topclan[name] ?></font></b>
                        <br />
                        Đã đóng góp: <?= (number_format($Topclan['luongclan'])) ?> lượng - Cống hiến: <?= (number_format($Topclan['conghien'])) ?> điểm<br />
                    </td>
                </tr>
            </table>
            <?
            $clanMem = mysql_query("SELECT * FROM `ninja` WHERE `clan` = '".$clan['id']."' ORDER BY `luongclan` DESC ");
            while ($Member = mysql_fetch_assoc($clanMem))
                if ($Member[clan] == $clan[id] && $clan[pc] != $Member[name] && $clan[ppc] == $Member[name]) { {
?>
                        <table width="100%">
                            <tr>
                                <td style="border: 1px solid #AAA">
                                    
                                    <b><font color="green">[Đội phó] <?= $Member[name] ?></font></b>
                                    <br>
                                    Đã đóng góp: <?= (number_format($Member['luongclan'])) ?> lượng - Cống hiến: <?= (number_format($Member['conghien'])) ?> điểm<br />
                                    <?
                        if ($clan[pc] == $ninja['name'] && $clan[pc] != $Member['name']) {
?>
                                        <b>Thao tác: </b>
                                        <?
                            if ($clan[pc] == $ninja['name']) {
                                if (empty($clan[ppc])) {
?>
                                                <a href="/clan/?rights=<?= $Member[name]; ?>">Phong đội phó</a> - 
                                            <?
                                } else if ($clan[ppc] == $Member[name]) {
?>
                                                <a href="/clan/?rights=<?= $Member[name]; ?>">Hạ xuống thành viên</a> - 
                                                <?
                                }
                            }
?>
                                        <a href="/clan/?kick=<?= $Member[name]; ?>">Kích khỏi Clan</a>
                                    <?
                        }
?>
                                </td>
                            </tr>
                        </table>
                    <?
                    }
?>
                <?
                }
?>
            <?
            $clanMem = mysql_query("SELECT * FROM `ninja` WHERE `clan` = '".$clan['id']."' ORDER BY `conghien` DESC ");
            $topC    = 0;
            while ($Member = mysql_fetch_assoc($clanMem))
                if ($Member[clan] == $clan[id] && $clan[pc] != $Member[name] && $clan[ppc] != $Member[name]) {
                    $TopC += 1; {
?>
                        <table width="100%">
                            <tr>
                                <td style="border: 1px solid #AAA">
                                    
                                    <?
                        if ($TopC <= 3) {
?>
                                        <b><font color="teal">[Ưu tú] <?= $Member[name] ?></font></b><br />
                                    <?
                        } else {
?>
                                        <b>[Thành viên] <?= $Member[name] ?></b><br />
                        <?
                        }
?>
                                     Đã đóng góp: <?= (number_format($Member['luongclan'])) ?> lượng - Cống hiến: <?= (number_format($Member['conghien'])) ?> điểm<br />
                                    <?
                        if (($clan[pc] == $ninja['name'] && $clan[pc] != $Member['name']) || ($ninja['name'] == $clan[ppc] && $Member['name'] != $clan[ppc])) {
?>
                                        <b>Thao tác: </b>
                                        <?
                            if ($clan[pc] == $ninja['name']) {
                                if ($Member[name] != $clan[ppc] && empty($clan[ppc])) {
?>
                                                <a href="/clan/?rights=<?= $Member[name]; ?>">Phong đội phó</a> - 
                                            <?
                                } else if ($clan[pc] == $Member[name]) {
?>
                                                <a href="/clan/?rights=<?= $Member[name]; ?>">Hạ xuống thành viên</a> - 
                                                <?
                                }
                            }
?>
                                        <a href="/clan/?kick=<?= $Member[name]; ?>">Kích khỏi Clan</a>
                        <?
                        }
?>
                                </td>
                            </tr>
                        </table>
                    <?
                    }
?>
                <?
                }
?>
            <?
        } else {
            header('Location: /clan/');
        }
?>
        <?
    } else {
        $title = "Danh sách Clan";
        
        $page     = mysql_real_escape_string(isset($_GET['page']) ? $_GET['page'] : 1);
        $limit    = mysql_real_escape_string(isset($_GET['limit']) ? $_GET['limit'] : 20);
        $order    = mysql_real_escape_string(isset($_GET[order]) ? $_GET[order] : 'conghien');
        $type     = mysql_real_escape_string(isset($_GET[type]) ? $_GET[type] : 'DESC');
        $start    = ($page - 1) * $limit;
        $numbclan = mysql_result(mysql_query("SELECT COUNT(*) FROM `clan`"), 0);
        if (mysql_result(mysql_query("SELECT COUNT(*) FROM `clan` WHERE `id` = '" . $ninja['join'] . "' "), 0) == 0) {
            @mysql_query("UPDATE `ninja` SET `join` = 0 WHERE `name` = '{$ninja['name']}' ");
        }
?>

 
        <?
        if ($ninja['clan'] != 0) {
Header('Location: /clan/?clan=info');
?>
           <center> <b><a href="/clan/?clan=info">Vào Clan Của Bạn »</a></b></center><br />
        <?
        } else {
?>
            <center><br>Hiện Sever Đang Có <?= $numbclan; ?> Clan<br><b><a href="/clan/?clan=reg">Thành Lập Clan Mới»</a></b></center><br />
        <?
        }
?>
        <?
        if ($numbclan == 0) {
?>
            <h4><font color="green">Chưa có Clan nào được thành lập hãy là người đầu tiên</font></h4>
            <?
        } else {
            if ($ninja[join] != 0 && $ninja[clan] == 0) {
?>
                <a href="/clan/?thamgia=huy">« Huỷ yêu cầu hiện đang tham gia</a>
            <?
            }
?>
            <center><b>Trang: <?= $page; ?></b></center>
            <?
            $clan = mysql_query("SELECT * FROM `clan` ORDER BY `$order` $type LIMIT $start, $limit");
            while ($clanInfo = mysql_fetch_assoc($clan)) {
                $mem = mysql_result(mysql_query("SELECT COUNT(*) FROM `ninja` WHERE `clan` = '" . $clanInfo['id'] . "' "), 0);
?><table width="100%">
                    <tr>
                        <td style="border: 1px solid #AAA">
                            <font color="blue"><b><?= $clanInfo[name]; ?></b></font><br>
                            Đội trưởng: <font color="red"><b><?= $clanInfo[pc]; ?></font></b> - Cống hiến <b><?=number_format($clanInfo[conghien]); ?></b> điểm
                            <br />
                            <b><?= $clanInfo[thongbao]; ?></b>
                            
                            <br />Thành viên: <b><?= $mem; ?>/<?= number_format($clanInfo[menmax]); ?></b>
                            <?
                if ($ninja[clan] == 0 && $mem < $clanInfo[menmax]) {

                    if ($ninja[join] == 0) {
?>
                                    <a href="/clan/?thamgia=<?= $clanInfo[id]; ?>" title="Tham gia Clan <?= $clanInfo[name]; ?>" alt="<?= $clanInfo[name]; ?>" ><b>[Xin Vào]</b></a>
                                <?
                    } else if ($clanInfo[id] == $ninja[join]) {
?>
                                    <font color="green"><b>Chờ duyệt</b></font>
                                    <?
                    }
                }
?>
                        </td></tr>
                </table>
                <?
            }
            if ($numbclan > 20) {
?>
                <table width="100%">
                    <tr>
                        <td width="50%" ="center">
                            <?
                if ($page > 1) {
?>
                                <a href="?page=<?= $page - 1; ?>"><button style="background-color: #00B2BF; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 80px; text-align: center;">« Trang Trước</button></a>
                <?
                }
?>
                        </td>
                        <td width="50%" align="center">
                            <?
                if ($page * 20 < $numbclan) {
?>
                                <a href="?page=<?= $page + 1; ?>"><button style="background-color: #00B2BF; border: 0px solid #009DE0; border-radius: 5px 5px 5px 5px; color: #FFFFFF;  font-size: 11px; font-weight: bold; padding: 6px 1px; width: 75px; text-align: center;">Trang Tiếp »</button> </b></a>

                <?
                }
?>
                        </td>
                    </tr>
                </table>
            <?
            }
?>
        <?
        }
?>
    <?
    }
?>
    <?
} else {
    header('Location: /');
}
echo'</div>';
include '../in/foot.php';
?>