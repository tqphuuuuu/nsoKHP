<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN"><html>
    <head>
		<meta name="viewport" content="width=device-width,maximum-scale=1,user-scalable=no"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ninja School Lậu Sever HKH</title>
        <link rel="stylesheet" href="http://ninjaschool.vn/css/template.css" type="text/css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.css">	
		<link rel="shortcut icon" href='http://27.0.14.78/dl/image/iconninja32.png' type="image/x-icon" />
		<link rel="apple-touch-icon" href="http://ninjaschool.vn/images/logo256.png" />
		<meta name="description" content="Ninja School Lậu Sever HKH.Pro Miễn phí full map full tiền tải vể và trải nghiệm ngay.!"/>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
            function reg(){
                $.ajax({
                    url : "reg.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         user : $('#user').val(),
                         pass : $('#pass').val()
                         

                    },
                    success : function (result){
                        $('#result').html(result);
                    }
                });
            }
function log(){
                $.ajax({
                    url : "log.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         user : $('#user').val(),
                         pass : $('#pass').val()

                    },
                    success : function (result){
                        $('#result').html(result);
                    }
                });
            }
function free(){
                $.ajax({
                    url : "free.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         ok : $('#ok').val()

                    },
                    success : function (result){
                        $('#okfree').html(result);
                    }
                });
            }
        </script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Barlow:wght@100&display=swap');

@font-face {
    font-family: 'Barlow', sans-serif;
}

body{font-family: small;font-size: 12px;}


button {
  display: inline-block;
  padding: 5px 10px;
  margin: 3px;
  font-family: AVO, Arial !important;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: 0;
  color: #fff;
  background-color: #00736b;
  border: none;
  border-radius: 15px;
  box-shadow: 0 4px #1c3f39
}

button:hover {
  background-color: #3e8e41
}

button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px)
}
.button {
  padding: 2px 6px
}
input,
select {
  outline: 0;
  border: none;
  border-radius: 15px;
  text-indent: 5px;
  padding: 3px
}
input, select {
  width: 200px;
}


h3{
-webkit-margin-before: 0px;
-webkit-margin-after: 0px;
}
h4{
-webkit-margin-before: 0.2em;
-webkit-margin-after: 0.2em;
}

</style>
    </head>   
    <body>
        <div class="body_body">
	<div style="line-height: 3px;
    font-size: 10px;
    padding-right: 5px;
       padding-bottom: 6px;">
			<img height=12 src="http://ninjaschool.vn/12.png" style="vertical-align: middle;"/> 
			<span style="vertical-align: middle;">Trò chơi dành cho người chơi 12 tuổi trở lên. Chơi quá 180 phút mỗi ngày sẽ có hại cho sức khỏe
			</span>
			</div>			
            <div class="left_top"></div><div class="bg_top"><div class="right_top"></div></div>
            <div class="body-content">
            	<div class="bg-content2">
                <div class="a" align="center"><a href="/"><img src="http://ninjaschool.vn/images/logo.png" /></a></div>
                <div id="top">
                    <div class="link-more">	
                        <div class="h" align="center">
                            <!--<div style="color: #032E58;margin-top:-8px;margin-bottom:4px;">
							<center> <b>Mạng xã hội cho điện thoại di động</b></center> 
							</div>-->
							<div class="bg_noel"></div>
							<div class="menu2" style="background: #561d00;">
                            <table width="100%" border="0" cellspacing="4	">
                                <tr class="menu">		
									<td style="width:25%" id="selected"><a href="/">Trang Chủ</a></td>
                                    <td style="width:25%" ><a href="/downloads">Tải Games</a></td> 
                                    <td style="width:25%" ><a href="https://www.facebook.com/groups/1392509430935908/?ref=share">Group Facebook</a></td> 
									<td style="width:25%"><a href="https://zalo.me/g/jxrens821" target="_blank">Group Zalo</a></td>
								</tr>
                            </table>
							</div>
																