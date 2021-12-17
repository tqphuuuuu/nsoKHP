<?php
session_start();
if (isset($_SESSION['usermem'])) {
include('in/config.php');
echo'<div class="bg-content">';

    if ($_GET[clan] == 'reg') {
        $title = "Thành lập biệt đội";
        $idc     = mysql_real_escape_string($_POST['idc']);
        $name    = mysql_real_escape_string($_POST['name']);
        $time    = date("Y-m-d H:i:s");
        $reqclan = mysql_query("SELECT * FROM `clan` WHERE `name`= '$name' LIMIT 1");
echo'<div class="title"><center><font color="red">Phí thành lập biệt đội là 2.000 lượng!</center></font></b></div><br>';
        if ($armymem['clan'] == 0) {
            if ($armymem['online'] == 0) {
                if ($_POST['reg']) {
                    if ($idc == null || name == null) {
?>
<script>
        Swal({
            title: 'Lỗi thành lập',
            text: 'Bạn vui lòng nhập đủ thông tin biệt đội muốn đăng ký.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
                        
                    <?
                    } else if ($armymem['luong'] < 2000) {
?>
<script>
        Swal({
            title: 'Lỗi thành lập',
            text: 'Bạn không đủ 2.000 lượng để thành lập.!',
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
            text: 'Tên biệt đội đã tồn tại vui lòng chọn tên khác!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
                        <?
                    } else {
                        if (mb_strlen($thongbao, "UTF-8") == 0) {
                            $thongbao = "Không có thông báo";
                        }
                        @mysql_query("INSERT INTO `clan`
                (`name`,`master`,`masterName`,`thongBao`,`icon`,`memMax`,`auto_access`,`dateCreat`)
                VALUES
                ('$name', '$user[user_id]', '$user[user]', '$thongbao', '$idc', 20, '[0,0,0,0]', '$time') ");
                        $clan = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `name`='$name' LIMIT 1"));
                        @mysql_query("UPDATE `armymem` SET `luong` = `luong` - 2000, `clan` =  '$clan[id]' WHERE `id` = '$clan[master]' ");
                        header('Location: /clan.php?clan=info');
                    }
                }
?>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <form action="" method="POST" name="reg">
                    
                    <table>
                        <tr>
                            <td>Tên biệt đội:</td>
                            <td><input type="text" name="name" class="name" id="name" placeholder="Nhập tên biệt đội" /></td>
                        </tr>
                    </table>
                    <h4><font  color="#FF7700"><b>CHỌN ICON BIỆT ĐỘI</b></font></h4>
                    <table>
                        <?php
                $ids = 0;
                for ($i = 1; $i <= 20; $i++) {
?>
                            <tr>
                                <?php
                    for ($j = 1; $j <= 9; $j++) {
                        $ids += 1;
?>
                                    <td style="border: 1px solid #AAA">
                                        <img src="images/clan/<?= $ids; ?>.png">
                                        <input type="radio" name="idc" value="<?= $ids; ?>">&nbsp;&nbsp;&nbsp;
                                    </td>
                                <?
                    }
?>
                            </tr>
                        <?
                }
?>
                    </table>
                    <input type="submit" name="reg" value="Thành lập">
                </form>
            <?
            } else {
?>
<script>
        Swal({
            title: 'Lỗi thành lập',
            text: 'Bạn cần thoát game để thành lập đội.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>                  <?
            }
?>
        <?
        } else {
?>
<script>
        Swal({
            title: 'Lỗi thành lập',
            text: 'Hiện tại bạn đang có biệt đội hãy rời khỏi để thành lập.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
            <?
        }
?>
       										
                       
            </div> <?
    } else if ($_GET[rights] > 0) {
        include('in/conn.php');
        $user    = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `user`='" . $_SESSION['usermem'] . "' LIMIT 1"));
        $armymem = mysql_fetch_array(mysql_query("SELECT * FROM `armymem` WHERE `id`='" . $user[user_id] . "' LIMIT 1"));
        $clan    = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . $armymem[clan] . "' LIMIT 1"));
        $Mem     = mysql_fetch_array(mysql_query("SELECT * FROM `armymem` WHERE `id`='" . mysql_real_escape_string($_GET[rights]) . "' LIMIT 1"));
        if ($clan[master] == $user['user_id'] && $armymem[clan] != 0 && $armymem[clan] == $Mem[clan] && $clan[master] != $Mem[id]) {
            if ($Mem[rightsclan] == 0 && $clan[rights] < 2) {
                @mysql_query("UPDATE `armymem` SET `rightsclan` = 1 WHERE `id` = '{$Mem['id']}' ");
                @mysql_query("UPDATE `clan` SET `rights` = `rights` + 1 WHERE `id` = '{$Mem['clan']}' ");
            } else {
                @mysql_query("UPDATE `armymem` SET `rightsclan` = 0  WHERE `id` = '{$Mem['id']}' ");
                @mysql_query("UPDATE `clan` SET `rights` = `rights` - 1 WHERE `id` = '{$Mem['clan']}' ");
            }
            header('Location: /clan.php?clan=info');
        } else {
            header('Location: /clan.php');
        }
    } else if ($_GET[clan] == xin) {
        $title = "Yêu cầu tham gia biệt đội";
        $user    = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `user`='" . $_SESSION['usermem'] . "' LIMIT 1"));
        $armymem = mysql_fetch_array(mysql_query("SELECT * FROM `armymem` WHERE `id`='" . $user[user_id] . "' LIMIT 1"));
        $clan    = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . $armymem[clan] . "' LIMIT 1"));
        $mbclan  = mysql_result(mysql_query("SELECT COUNT(*) FROM `armymem` WHERE `clan` = '" . $clan['id'] . "' "), 0);
        $join    = mysql_result(mysql_query("SELECT COUNT(*) FROM `armymem` WHERE (`join` = '" . $clan['id'] . "' AND `clan` = 0) "), 0);
        if ($armymem[clan] == $clan[id] && ($armymem[rightsclan] == 1 || $user[user_id] = $clan[master])) {
?>
            <div class="title"><center>Danh Sách Phê Duyệt</center></div>
            
            <?
            if ($join <= 0) {
?>
                <li><b><font color="blue">Không có yêu cầu tham gia nào</font></b></li>
                <?
            }
            $id     = mysql_real_escape_string($_POST[accept]);
            $accmem = mysql_fetch_array(mysql_query("SELECT * FROM `armymem` WHERE `id`='" . $id . "' LIMIT 1"));
            if ($_POST[accept] && $accmem[clan] == 0 && $mbclan < $clan[memMax]) {
                @mysql_query("UPDATE `armymem` SET `join` = 0, `mbclan` =  '{$mbclan}',`clan` =  '{$clan['id']}' WHERE `id` = '{$id}' ");
                @mysql_query("UPDATE `clan` SET `mem` =  `mem` + 1 WHERE `id` = '{$clan[id]}' ");
                ?><li>Đã phê duyệt <b><?= $accmem[user]; ?></b></li>
                        <?
            }
            $id = mysql_real_escape_string($_POST[disaccept]);
            if ($_POST[disaccept]) {
                $accmem = mysql_fetch_array(mysql_query("SELECT * FROM `armymem` WHERE `id`='" . $id . "' LIMIT 1"));
                @mysql_query("UPDATE `armymem` SET `join` =  0 WHERE `id` = '{$id}' ");
?><li>Đã từ chối <b><?= $accmem[user]; ?></b></li>
                <?
            }
?>
                <?
            $Mem = mysql_query("SELECT * FROM `armymem` ORDER BY `mbclan` ASC ");
            while ($Member = mysql_fetch_assoc($Mem)) {
                if ($Member[join] == $clan[id] && $Member[clan] == 0) { {
?>
                        <form action="" method="post">
                            <table width="100%">
                                <tr>
                                    <td style="border: 1px solid #AAA">
                                        Tên: <b><font color="blue"><?= $Member[user] ?></font></b><br />
                                        Xu: <b><?= $Member[xu] ?></b> - 
                                        Lượng: <b><?= $Member[luong] ?></b><br />
                                        Cup: <b><?= $Member[dvong] ?></b> - 
                                        Xp: <b><?= $Member[xpMax] ?></b><br />
                                        <?
                        if ($mbclan < $clan[memMax]) {
?>
                                            <button type="submit" value="<?= $Member[id] ?>" name="accept">Chấp Nhận</button> - 
                                        <?
                        } else {
?>
                                            Không thể duyệt - 
                                        <?
                        }
?>
                                        <button type="submit" value="<?= $Member[id] ?>" name="disaccept">Từ Chối</button>
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
?>
<li><a href="/clan.php?clan=info">« Biệt Đội</a></li>
            <?
        } else {
            header('Location: /clan.php?clan=info');
        }
    } else if ($_GET[clan] == 'edit') {
        $title = "Thiết lập biệt đội";
        
        $thongbao = mysql_real_escape_string($_POST['thongbao']);
        $user     = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `user`='" . $_SESSION['usermem'] . "' LIMIT 1"));
        $armymem  = mysql_fetch_array(mysql_query("SELECT * FROM `armymem` WHERE `id`='" . $user[user_id] . "' LIMIT 1"));
        $clan     = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . $armymem[clan] . "' LIMIT 1"));
        if ($armymem[id] == $clan[master]) {
?>
            <?
            if ($_POST['save']) {
                header('Location: /clan.php?clan=edit');
                @mysql_query("UPDATE `clan` SET  `thongBao` =  '{$thongbao}' WHERE `id` = '{$clan[id]}' ");
            }
?>

            <form action="clan.php?clan=edit" method="POST">
                
                    
                    <center><h4>Sửa Thông Báo Clan</h4>
                        <textarea name="thongbao" id="thongbao" placeholder="Thông báo ra biệt đội"/><?= $clan['thongBao']; ?></textarea>
                    <br>
                
                <button type="submit" name="save" value="ok">Lưu Lại
                </button>
            </form>

            <em><br />Bạn có thể nhường lại chức đội trưởng cho thành viên trong biệt đội của bạn với giá 10.000 lượng của biệt đội
                <br /></em>
            <em><font color="red">
                <br />
                <?
            if ($_POST['send'] && $_POST['newmaster']) {
                $newmaster = mysql_real_escape_string($_POST['newmaster']);
                $mbs       = mysql_result(mysql_query("SELECT COUNT(*) FROM `armymem` WHERE (`clan` = '" . $clan['id'] . "' AND `user` =  '" . $newmaster . "') "), 0);
                if ($clan[luong] < 10000) {
?>
<script>
        Swal({
            title: 'Lỗi',
            text: 'Biệt đội bạn không đủ 10.000 lượng.!',
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
            text: 'Thành viên bạn vừa nhập không thuộc biệt đội của bạn.!',
            type: 'error',
            confirmButtonText: 'Đóng'
        })
    
</script>  
                        
                        <?
                } else {
                    $mem = mysql_fetch_array(mysql_query("SELECT * FROM `armymem` WHERE `user`='" . $newmaster . "' LIMIT 1"));
                    @mysql_query("UPDATE `clan` SET  `master` =  '{$mem[id]}', `masterName` =  '{$newmaster}', `luong` = `luong` - 10000 WHERE `id` = '{$clan[id]}' ");
                    @mysql_query("UPDATE `armymem` SET  `rightsclan` =  0
WHERE `user` = '{$newmaster}' ");
?>
<script>
        Swal({
            title: 'Thành công!',
            text: 'Bạn đã chuyển nhượng biệt đội lại cho <?= $newmaster; ?> bạn sẽ không còn quyền hạn với biệt đội này.!',
            type: 'success',
            confirmButtonText: 'Đóng'
        })
    
</script>  
                        
                        <?
                }
            }
?></font></em>
            <form action="" method="POST" name="save">
                <table>
                    <td>Người nhận:</td>
                    <td>
                        <input type="text" name="newmaster" placeholder="Nhập tên thành viên" maxlength="16"  />
                    </td>
                    <td>
<input type="submit" name="send" value="Nhường Lại"  />
                        
                </button>
                    </td>
                    </tr>
                </table>
            </form>
            <br /><a href="/clan.php?clan=info">« Quay lại</a></center>
        <?
        }
?>
        <?
    } else if ($_GET[kick] > 0) {
        include('in/conn.php');
        $user    = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `user`='" . $_SESSION['usermem'] . "' LIMIT 1"));
        $armymem = mysql_fetch_array(mysql_query("SELECT * FROM `armymem` WHERE `id`='" . $user[user_id] . "' LIMIT 1"));
        $clan    = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . $armymem[clan] . "' LIMIT 1"));
        $Mem     = mysql_fetch_array(mysql_query("SELECT * FROM `armymem` WHERE `id`='" . mysql_real_escape_string($_GET[kick]) . "' LIMIT 1"));
        if ($armymem[clan] != 0 && $armymem[clan] == $Mem[clan]) {
            if (($clan[master] == $user['user_id'] && $clan[master] != $Mem['id']) || ($armymem['rightsclan'] == 1 && $Mem['rightsclan'] == 0 && $clan[master] != $Mem['id'])) {
                if ($Mem[rightsclan] == 1) {
                    @mysql_query("UPDATE `clan` SET `rights` = `rights` - 1 WHERE `id` = '{$Mem['clan']}' ");
                }
                @mysql_query("UPDATE `armymem` SET `clan` = 0, `xuclan` = 0, `luongclan` = 0, `cupclan` = 0, `xpclan` = 0, `rightsclan` = 0 WHERE `id` = '{$Mem['id']}' ");
                @mysql_query("UPDATE `clan` SET `mem` =  `mem` - 1 WHERE `id` = '{$clan[id]}' ");
                header('Location: /clan.php?clan=info');
            } else {
                header('Location: /clan.php?clan=info');
            }
        } else {
            header('Location: /clan.php');
        }
    } else if ($_GET[thamgia] != 0) {
        include('in/conn.php');
        $user    = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `user`='" . $_SESSION['usermem'] . "' LIMIT 1"));
        $armymem = mysql_fetch_array(mysql_query("SELECT * FROM `armymem` WHERE `id`='" . $user[user_id] . "' LIMIT 1"));
        $clan    = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . mysql_real_escape_string($_GET[thamgia]) . "' LIMIT 1"));
        $mem     = mysql_result(mysql_query("SELECT COUNT(*) FROM `armymem` WHERE `clan` = '" . $clan['id'] . "' "), 0);
        if ($armymem[clan] == 0 && $mem < $clan[memMax]) {
            @mysql_query("UPDATE `armymem` SET `join` =  '{$clan['id']}' WHERE `id` = '{$user['user_id']}' ");
            @mysql_query("UPDATE `armymem` SET `mbclan` =  '{$mem}' WHERE `id` = '{$user['user_id']}' ");
        }
        header('Location: /clan.php');
    } else if ($_GET[thamgia] == huy) {
        
        $user = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `user`='" . $_SESSION['usermem'] . "' LIMIT 1"));
        @mysql_query("UPDATE `armymem` SET `join` =  0 WHERE `id` = '{$user['user_id']}' ");
        @mysql_query("UPDATE `armymem` SET `mbclan` =  0 WHERE `id` = '{$user['user_id']}' ");
        header('Location: /clan.php');
    } else if ($_GET[clan] == 'info') {
        $title = "Biệt đội";
        
        $user    = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `user`='" . $_SESSION['usermem'] . "' LIMIT 1"));
        $armymem = mysql_fetch_array(mysql_query("SELECT * FROM `armymem` WHERE `id`='" . $user[user_id] . "' LIMIT 1"));
        if ($armymem['clan'] != 0) {
            $clan      = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id`='" . $armymem[clan] . "' LIMIT 1"));
            $XPmax     = 25000 * $clan['level'] * ($clan['level'] + 1);
            $percentXP = (int) (($clan['xp'] * 100) / $XPmax);
            $bookmub   = mysql_result(mysql_query("SELECT COUNT(*) FROM `armymem` WHERE `join` = '" . $clan['id'] . "' AND `clan` = 0 "), 0);
            $phomb     = mysql_result(mysql_query("SELECT COUNT(*) FROM `armymem` WHERE (`clan` = '" . $clan['id'] . "' AND `rightsclan` = 1) "), 0);
            @mysql_query("UPDATE `clan` SET `rights` = '{$phomb}' WHERE `id` = '{$clan[id]}' ");
            $numb = mysql_result(mysql_query("SELECT COUNT(*) FROM `armymem` WHERE `clan` = '" . $clan['id'] . "' "), 0);
            @mysql_query("UPDATE `clan` SET `mem` = '{$numb}' WHERE `id` = '{$clan[id]}' ");
?>
            <h4><center><font  color="#FF7700"><b><img width ="20px" src="/images/clan/<?= $clan[icon]; ?>.png" alt="Icon Biệt Đội <?= $chan[name]; ?>"> <?= $clan['name']; ?></b></font></center></h4>
            <center>THÔNG BÁO:<br />
                <b><?= $clan[thongBao]; ?></b>
            </center>
            <b><font color="blue">
                <li>Đội phó: <?= $phomb; ?> / 2</li>
                <li>Thành viên: <?= $numb ?> / <?= number_format($clan[memMax]); ?></li>
                <li>Xu: <?= $clan[xu]; ?></li>
                <li>Lượng: <?= $clan[luong]; ?></li>
                <li>Cup: <?= $clan[cup]; ?></li>
                <li> Kinh Nghiệm: <?= $clan['xp']; ?> /  <?= $XPmax; ?>
                <li>Cấp: <?= $clan['level']; ?>  +  <?= $percentXP; ?> %</li>
            </b>
            <?php
            if ($_POST['out'] && $clan['master'] != $user['user_id']) {
                if ($armymem[rightsclan] == 1) {
                    @mysql_query("UPDATE `clan` SET `rights` = `rights` - 1 WHERE `id` = '{$armymem['clan']}' ");
                }
                @mysql_query("UPDATE `clan` SET `mem` =  `mem` - 1 WHERE `id` = '{$clan[id]}' ");
                @mysql_query("UPDATE `armymem` SET `clan` = 0, `xuclan` = 0, `luongclan` = 0, `xpclan` = 0, `cupclan` = 0, `rightsclan` = 0 WHERE `id` = '{$user['user_id']}' ");
                header('Location: ./clan.php');
            }
?>
            <form action="" method="POST" name="menu">
                <?
            if ($clan['master'] != $user['user_id']) {
?>
                    <li> <input type="submit" name="out" value="Rời khỏi biệt đội"></li>
                <?
            }
?>
            </form>
            <?
            if (($clan['master'] == $user['user_id'] || $armymem[rightsclan] == 1) && $bookmub > 0) {
?>
                <li><b>
                    <a href="/clan.php?clan=xin" title="Đơn xin gia nập" alt="Đơn xin gia nhập">Yêu Cầu Tham Gia</b></a> (+<?= $bookmub; ?>) </li><br>
            <?
            }
?>
            <?
            if ($clan['master'] == $user['user_id']) {
?>
                <li>
                    <a href="/clan.php?clan=edit" title="chỉnh" alt="chỉnh sửa"><b>Thiết Lập Biệt Đội</b></a>
                </li><br>
            <?
            }
?>
            </font></b>
            <table width="100%">
                <tr>
                    <?
            $Topclan = mysql_fetch_array(mysql_query("SELECT * FROM `armymem` WHERE (`id`='" . $clan[master] . "' AND `clan`='" . $clan[id] . "') LIMIT 1"));
?>
                    <td style="border: 1px solid #AAA">
                        <img width ="12px" src="/images/line/<?= $Topclan['online']; ?>.png" />
                        <b><font color="red">[ <img width ="14px" src="/images/clan/top1.png" /> Đội trưởng] <?= $Topclan[user] ?></font></b>
                        <br />
                        Kinh nghiệm: <?= (number_format($Topclan['xpclan'])) ?>
                        - Cup: <?= (number_format($Topclan['cupclan'])) ?><br />
                        Xu đóng góp: <?= (number_format($Topclan['xuclan'])) ?>
                        - Lượng đóng góp: <?= (number_format($Topclan['luongclan'])) ?><br />
                    </td>
                </tr>
            </table>
            <?
            $clanMem = mysql_query("SELECT * FROM `armymem` ORDER BY `xpclan` DESC ");
            while ($Member = mysql_fetch_assoc($clanMem))
                if ($Member[clan] == $clan[id] && $clan[master] != $Member[id] && $Member[rightsclan] == 1) { {
?>
                        <table width="100%">
                            <tr>
                                <td style="border: 1px solid #AAA">
                                    <img width ="12px" src="/images/line/<?= $Member['online']; ?>.png" />
                                    <b><font color="green">[ <img width ="14px" src="/images/clan/top2.png" /> Đội phó] <?= $Member[user] ?></font></b>
                                    <br />
                                    Kinh nghiệm: <?= (number_format($Member['xpclan'])) ?>
                                    - Cup: <?= (number_format($Member['cupclan'])) ?><br />
                                    Xu đóng góp: <?= (number_format($Member['xuclan'])) ?>
                                    - Lượng đóng góp: <?= (number_format($Member['luongclan'])) ?><br />
                                    <?
                        if (($clan[master] == $user['user_id'] && $clan[master] != $Member['id']) || ($armymem['rightsclan'] == 1 && $Member['rightsclan'] == 0)) {
?>
                                        <b>Thao tác: </b>
                                        <?
                            if ($clan[master] == $user['user_id']) {
                                if ($Member[rightsclan] == 0 && $phomb < 2) {
?>
                                                <a href="/clan.php?rights=<?= $Member[id]; ?>">Phong đội phó</a> - 
                                            <?
                                } else if ($Member[rightsclan] > 0) {
?>
                                                <a href="/clan.php?rights=<?= $Member[id]; ?>">Hạ xuống thành viên</a> - 
                                                <?
                                }
                            }
?>
                                        <a href="/clan.php?kick=<?= $Member[id]; ?>">Kích khỏi biệt đội</a>
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
            $clanMem = mysql_query("SELECT * FROM `armymem` ORDER BY `xpclan` DESC ");
            $topC    = 0;
            while ($Member = mysql_fetch_assoc($clanMem))
                if ($Member[clan] == $clan[id] && $clan[master] != $Member[id] && $Member[rightsclan] == 0) {
                    $TopC += 1; {
?>
                        <table width="100%">
                            <tr>
                                <td style="border: 1px solid #AAA">
                                    <img width ="12px" src="/images/line/<?= $Member['online']; ?>.png" />
                                    <?
                        if ($TopC <= 3) {
?>
                                        <b><font color="teal">[Ưu tú] <?= $Member[user] ?></font></b><br />
                                    <?
                        } else {
?>
                                        <b>[Thành viên] <?= $Member[user] ?></b><br />
                        <?
                        }
?>
                                    Kinh nghiệm: <?= (number_format($Member['xpclan'])) ?>
                                    - Cup: <?= (number_format($Member['cupclan'])) ?><br />
                                    Xu đóng góp: <?= (number_format($Member['xuclan'])) ?>
                                    - Lượng đóng góp: <?= (number_format($Member['luongclan'])) ?><br />
                                    <?
                        if (($clan[master] == $user['user_id'] && $clan[master] != $Member['id']) || ($armymem['rightsclan'] == 1 && $Member['rightsclan'] == 0)) {
?>
                                        <b>Thao tác: </b>
                                        <?
                            if ($clan[master] == $user['user_id']) {
                                if ($Member[rightsclan] == 0 && $clan[rights] < 2) {
?>
                                                <a href="/clan.php?rights=<?= $Member[id]; ?>">Phong đội phó</a> - 
                                            <?
                                } else if ($Member[rightsclan] > 0) {
?>
                                                <a href="/clan.php?rights=<?= $Member[id]; ?>">Hạ xuống thành viên</a> - 
                                                <?
                                }
                            }
?>
                                        <a href="/clan.php?kick=<?= $Member[id]; ?>">Kích khỏi biệt đội</a>
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
            header('Location: ./clan.php');
        }
?>
        <?
    } else {
        $title = "Danh sách biệt đội";
        
        $page     = mysql_real_escape_string(isset($_GET['page']) ? $_GET['page'] : 1);
        $limit    = mysql_real_escape_string(isset($_GET['limit']) ? $_GET['limit'] : 10);
        $order    = mysql_real_escape_string(isset($_GET[order]) ? $_GET[order] : 'xp');
        $type     = mysql_real_escape_string(isset($_GET[type]) ? $_GET[type] : 'DESC');
        $start    = ($page - 1) * $limit;
        $user     = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `user`='" . $_SESSION['usermem'] . "' LIMIT 1"));
        $armymem  = mysql_fetch_array(mysql_query("SELECT * FROM `armymem` WHERE `id`='" . $user[user_id] . "' LIMIT 1"));
        $numbclan = mysql_result(mysql_query("SELECT COUNT(*) FROM `clan`"), 0);
        if (mysql_result(mysql_query("SELECT COUNT(*) FROM `clan` WHERE `id` = '" . $armymem['join'] . "' "), 0) == 0) {
            @mysql_query("UPDATE `armymem` SET `join` = 0 WHERE `id` = '{$user['user_id']}' ");
        }
?>

 
        <?
        if ($armymem['clan'] != 0) {
Header('Location: /clan.php?clan=info');
?>
           <center> <b><a href="/clan.php?clan=info">Vào Biệt Đội Của Bạn »</a></b></center><br />
        <?
        } else {
?>
            <center><br>Hiện Sever Đang Có <?= $numbclan; ?> Biệt Đội<br><b><a href="/clan.php?clan=reg">Thành Lập Biệt Đội Mới»</a></b></center><br />
        <?
        }
?>
        <?
        if ($numbclan == 0) {
?>
            <h4><font color="green">Chưa có biệt đội nào được thành lập hãy là người đầu tiên</font></h4>
            <?
        } else {
            if ($armymem[join] != 0 && $armymem[clan] == 0) {
?>
                <a href="/clan.php?thamgia=huy">« Huỷ yêu cầu hiện đang tham gia</a>
            <?
            }
?>
            <center><b>Trang: <?= $page; ?></b></center>
            <?
            $clan = mysql_query("SELECT * FROM `clan` ORDER BY `$order` $type LIMIT $start, $limit");
            while ($clanInfo = mysql_fetch_assoc($clan)) {
                $mem = mysql_result(mysql_query("SELECT COUNT(*) FROM `armymem` WHERE `clan` = '" . $clanInfo['id'] . "' "), 0);
?><table width="100%">
                    <tr>
                        <td style="border: 1px solid #AAA">
                            <img src="/images/clan/<?= $clanInfo[icon]; ?>.png" alt="Icon Biệt Đội <?= $chanInfo[name]; ?>"> <font color="blue"><b><?= $clanInfo[name]; ?></b></font><br>
                            Đội trưởng: <font color="red"><b><?= $clanInfo[masterName]; ?></font></b>
                            <br />
                            Xp: <b><?= number_format($clanInfo[xp]); ?></b>
                            Cup: <b><?= number_format($clanInfo[cup]); ?></b>
                            Level: <b><?= number_format($clanInfo[level]); ?></b>
                            <br />Thành viên: <b><?= $mem; ?>/<?= number_format($clanInfo[memMax]); ?></b>
                            <?
                if ($armymem[clan] == 0 && $mem < $clanInfo[memMax]) {
                    if ($armymem[join] == 0) {
?>
                                    <a href="/clan.php?thamgia=<?= $clanInfo[id]; ?>" title="Tham gia biệt đội <?= $clanInfo[name]; ?>" alt="<?= $clanInfo[name]; ?>" ><b>[Xin Vào]</b></a>
                                <?
                    } else if ($clanInfo[id] == $armymem[join]) {
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
            if ($numbclan > 10) {
?>
                <table width="100%">
                    <tr>
                        <td width="50%" align="center">
                            <?
                if ($page > 1) {
?>
                                <a href="/clan.php?page=<?= $page - 1; ?>" alt="trang trước" title="trang trước">« Trang trước</a>
                <?
                }
?>
                        </td>
                        <td width="50%" align="center">
                            <?
                if ($page * 10 < $numbclan) {
?>
                                <a href="/clan.php?page=<?= $page + 1; ?>" alt="trang tiếp" title="trang tiếp">Trang tiếp »</a>
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
include('in/foot.php');
?>