<?php

function dark74decode($Str){
$Count = 1;
$Base = '';
for($x=0;$x<strlen($Str)/ 2;$x++){
	$Base =$Base.chr(hexdec($Str[$Count - 1].$Str[$Count]) - 40);
	$Count = $Count + 	2;
}
return base64_decode($Base);
}

function dark74encode($Str){
$Base =  base64_encode($Str);
$Text = '';
for($x=0;$x < strlen($Base);$x++){
	$Text = $Text.dechex(ord($Base[$x])+40);
}
return $Text;
}
$FileName = 'UserInfoo.json';
$Content = json_decode(file_get_contents($FileName),true);
if($Content == null){
$Content =[];
}

date_default_timezone_set('Asia/Ho_Chi_Minh');
$DateN = date("Y-m-d H:i:s");
$IP = $_SERVER['REMOTE_ADDR'];

if(isset($_POST["keys"])){
   if(isset($_COOKIE['UserInfo'])) {
      setcookie('Notification', 'RegOut', time() +3);
      echo ' ';
   }
   if(strlen($IP) < 10) {
      $test = fopen("All_LogCast.txt","a");
      fwrite($test,"—————————————————————————————\n$IP | Blocked\nTime | $DateN\n");
      fclose($test);
      setcookie('Notification', 'vpn', time() +3);
      echo ' ';
   }
      $Username = $_POST["keys"];
if($Content[dark74encode($Username)] == null){
      $test = fopen("All_LogCast.txt","a");
      fwrite($test,"—————————————————————————————\n$IP\nTime | $DateN\nSpam | $Username | Enter key\n");
      fclose($test);
      $Username = stripVN($Username);
      $Register = '{"Action":"Register","Token":"DowrDnASKiDdJFxXPxEDcjf42BUqHzkbUaCN","Username":"'.$Username.'"}';
      setcookie("REG", $Register, time() +600);
      $ussp = "—————————————————————————————#$IP#Time | $DateN#User | $Username | Registering#";
      setcookie('ussp', $ussp, time() +600);
      setcookie("Registering", time() +600);
      header('Location: https://web1s.io/gnefRPuofA');
    }
		else{
   setcookie('Notification', 'Exist', time() +10);
		}
}

if(isset($_POST["inforn"])){
  $RnLimit = $_COOKIE['RnLimit'];
  $Username = $_POST["infos"];
  if($RnLimit == 'two') {
    setcookie('Notification', 'RnOut', time() +3);
    echo ' ';
  }
  if(strlen($IP) < 10) {
     $test = fopen("All_LogCast.txt","a");
      fwrite($test,"—————————————————————————————\n$IP | Blocked\nTime | $DateN\n");
      fclose($test);
      setcookie('Notification', 'vpn', time() +3);
     echo ' ';
   }
if($Content[dark74encode($Username)] != null){
    $Renew = '{"Action":"Renew","Token":"DowrDnASKiDdJFxXPxEDcjf42BUqHzkbUaCN","Username":"'.$Username.'"}';
    setcookie("REG", $Renew, time() +600);
    $ussp = "—————————————————————————————#$IP#Time | $DateN#User | $Username | Renewing#";
    setcookie("Renewing", time() +600);
    setcookie('ussp', $ussp, time() +600);
    header('Location: https://web1s.io/gnefRPuofA');
}
else{
    setcookie('UserInfo', 'a', time() -1);
    setcookie('RnLimit', 'a', time() -1);
    setcookie('Notification', 'NotExist', time() +3);
    }
}
  
  if(isset($_POST["infors"])){
    $Username = $_POST["infos"];
    $test = fopen("All_LogCast.txt","a");
    fwrite($test,"—————————————————————————————\n$IP\nTime | $DateN\nAction | $Username | Reset key\n");
    fclose($test);
    if($Content[dark74encode($Username)] <> null){
      $Content[dark74encode($Username)]["userAgent"] = "null";
      file_put_contents($FileName,json_encode($Content,true));
      $Actived = dark74decode($Content[dark74encode($Username)]["Actived"]);
      $Expire = dark74decode($Content[dark74encode($Username)]["ExpireData"]);
      $LastLog = dark74decode($Content[dark74encode($Username)]["LastLogin"]);
      $Create = dark74decode($Content[dark74encode($Username)]["Created"]);
      $Data = '{"userkey":"'.$Username.'","actived":"'.$Actived.'","expire":"'.$Expire.'","lastlog":"'.$LastLog.'","create":"'.$Create.'","device":""}';
      setcookie("UserInfo" ,$Data, time() +2592000);
      setcookie("RsSuccess", $Username, time() +3);
    } 
 else {
   setcookie('UserInfo', 'a', time() -1);
   setcookie('RnLimit', 'a', time() -1);
   setcookie("Notification", "NotExist", time() +3);
         }
  }

  if(isset($_POST["infodl"])){
    $Username = $_POST["infos"];
    $test = fopen("All_LogCast.txt","a");
    fwrite($test,"—————————————————————————————\n$IP\nTime | $DateN\nAction | $Username | Delete key\n");
    fclose($test);
    if($Content[dark74encode($Username)] <> null){
	  unset($Content[dark74encode($Username)]);
      file_put_contents($FileName,json_encode($Content,true));
      setcookie('UserInfo' , 'a', time() -1);
      setcookie('RnLimit', 'a', time() -1);
      setcookie('DlSuccess', $Username, time() +3);
    }
  else {
    setcookie('UserInfo', 'a', time() -1);
    setcookie('RnLimit', 'a', time() -1);
    setcookie('DlSuccess', 'Unknown', time() +3);
      }
  }
  
  $UserInfo = $_COOKIE["UserInfo"];
  if(isset($UserInfo)){
    $Username = json_decode($UserInfo)->{"userkey"};
    if($Content[dark74encode($Username)]   <> null){
      $Actived = dark74decode($Content[dark74encode($Username)]["Actived"]);
      $Expire = dark74decode($Content[dark74encode($Username)]["ExpireData"]);
      $LastLog = dark74decode($Content[dark74encode($Username)]["LastLogin"]);
      $Create = dark74decode($Content[dark74encode($Username)]["Created"]);
      $Device = preg_replace("/;/","/",substr(dark74decode($Content[dark74encode($Username)]['userAgent']), 24, 29));
      $Data = '{"userkey":"'.$Username.'","actived":"'.$Actived.'","expire":"'.$Expire.'","lastlog":"'.$LastLog.'","create":"'.$Create.'","device":"'.$Device.'"}';
      setcookie("UserInfo" ,$Data, time() +2592000);
      }  
   else {
      setcookie('UserInfo', 'a', time() -1);	
      setcookie('RnLimit', 'a', time() -1);
         }
  }

  function stripVN($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/đ/", 'd', $str);

    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/Đ/", 'D', $str);
    return $str;
}

?>

<html lang="en">
<head>
<title>VIP Keys - Register</title>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1" name="viewport">
<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link data-badged-icon="//static.gameguardian.net/monthly_2021_08/android-chrome-36x36.png" data-default-icon="https://yt3.googleusercontent.com/ytc/AGIKgqPcfDUBlQTtWcNy8zxuSDgnJJxTXr81KzKUe5R4">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');

body{
font-family: 'Roboto', sans-serif;
background-image: url("https://i.pinimg.com/originals/30/b8/17/30b8174c6f1a07e0af9bcf41fec3a5f5.gif");
background-repeat: no-repeat;
background-size: 100% 100%;
}

.container{
  position: absolute;
  top: 50%;
  left: 50%;
  width: 330px;
  transform: translate(-50%, -50%);
  background: white;
  border-radius: 10px;
  box-shadow: 0px 0px 15px rgb(255, 0, 255);
}

.loading {
  z-index: 99999998;
  position: absolute;
  top: 0%;
  left: 0%;
  width: 100%;
  height: 100%;
  background:rgba(0, 0, 0, 0.400);
  display: none;
}

.loading img {
  z-index: 99999999;
  position: absolute;
  top: 43%;
  left: 43%;
  width: 3rem;
}

h6 {
  text-align: center;
  color: blue;
}

.layout-form {
  position: relative;
  display: flex;
  justify-content: center;
  height: 7rem;
}

.input-username {
  position: absolute;
  top: 15%;
  width: 12rem;
  height: 30px;
  border: none;
  outline: none;
  background: none;
  color: blue;
  border-bottom: 2px solid #ddd;
}

.input-username:focus ~ .efUsername {
  width: 12rem;
}

#btn-random {
  position: absolute;
  top: 20%;
  right: 17%;
  font-size: 20px;
  color: #ddd;
  background: none;
  border: none;
  transition: 0.6s;
}
#btn-random:hover {
  color: greenyellow;
  text-shadow: 0 0 2px greenyellow;
}

.efUsername {
  transition: 0.6s;
  position: absolute;
  top: 40%;
  left: 18.64%;
  width: 0;
  height: 2px;
  background: blue;
}

#errorUsername {
  position: absolute;
  top: 41%;
  left: 18%;
}

.btn-submit {
  position: absolute;
  bottom: 0;
  height: 31px;
  width: 15rem;
  background-color: white;
  color: blue;
  border: 2px solid greenyellow;
  border-radius: 10px;
  transition: 0.25s;
}
.btn-submit:hover {
  text-shadow: 0 0 2px blue;
  box-shadow: 0 0 5px greenyellow;
  background-color: greenyellow;
}

.d-info {
  position: relative;
  width: 100%;
  height: 90px;
  display: none;
}
.d-info strong {
  position: absolute;
  top: -28%;
  left: 26%;
  color: blueviolet;
}

table, th, td {
  height: 25px;
  text-align: center;
  color: green;
  border: 2px solid blueviolet;
  border-collapse: collapse;
  white-space: nowrap;
}
.info-tables {
  overflow-x: scroll;
}
.d-info button[name="inforn"] {
  position: absolute;
  left: 29%;
  bottom: 0;
  width: 35px;
  height: 25px;
  outline: none;
  background-color: white;
  color: blueviolet;
  border: 2px solid green;
  border-radius: 5px;
  transition: 0.25s;
}
.d-info button[name="infors"] {
  position: absolute;
  right: 46.2%;
  bottom: 0;
  width: 35px;
  height: 25px;
  outline: none;
  background-color: white;
  color: blueviolet;
  border: 2px solid green;
  border-radius: 5px;
  transition: 0.25s;
}
.d-info button[name="infodl"] {
  position: absolute;
  right: 33%;
  bottom: 0;
  width: 35px;
  height: 25px;
  outline: none;
  background-color: white;
  color: blueviolet;
  border: 2px solid green;
  border-radius: 5px;
  transition: 0.25s;
}
.d-info button:hover {
  text-shadow: 0 0 2px blueviolet;
  box-shadow: 0 0 5px green;
  background-color: greenyellow;
}

#Notify {
  color: blue;
  background: greenyellow;
  border-radius: 4px;
}

.abcd {
  position: absolute;
  left: 13%;
  color: green;
  animation: color-change 0.3s infinite;
}

@keyframes color-change {
  0% { color: blue; }
  50% { color: red; }
  70% { color: green; }
  100% { color: blueviolet; }
}

.abcd i {
  width: 30px;
  height: 2px;
  position: absolute;
  top: 45%;
  left: -17%;
  background-color: green;
}
.abcd p {
  width: 30px;
  height: 2px;
  position: absolute;
  bottom: -23%;
  right: -17%;
  background-color: green;
}

.d-chat {
  background: white;
  position: fixed;
  z-index: 10000000;
  bottom: 0;
  width: 230;
  height: 30;
  right: 1%;
  cursor: pointer;
  display: block !important;
}
#google_translate_element {
	position: absolute;
}

/*.spinlink {
 position: absolute;
 left: 5%;
 bottom: 10%;
 color: blue;
 cursor: pointer;
}*/

.layout-captcha {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #ddddddbe;
  z-index: 10000001;
  display: none;
}

.slidercaptcha {
            margin: 0 auto;
            width: 314px;
            height: 286px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.125);
            margin-top: 40px;
        }

            .slidercaptcha .card-body {
                padding: 1rem;
            }

            .slidercaptcha canvas:first-child {
                border-radius: 4px;
                border: 1px solid #e6e8eb;
            }

            .slidercaptcha.card .card-header {
                background-image: none;
                background-color: rgba(0, 0, 0, 0.03);
            }

        .block {
    position: absolute;
    left: 0;
    top: 0;
}

.card {
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
}

.card-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0,0,0,.03);
    border-bottom: 1px solid rgba(0,0,0,.125);
}

    .card-header:first-child {
        border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
    }

.card-body {
    flex: 1 1 auto;
    padding: 1.25rem;
}

.sliderContainer {
    position: relative;
    text-align: center;
    line-height: 40px;
    background: #f7f9fa;
    color: #45494c;
    border-radius: 2px;
}

.sliderbg {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    background-color: #f7f9fa;
    height: 40px;
    border-radius: 2px;
    border: 1px solid #e6e8eb;
}

.sliderContainer_active .slider {
    top: -1px;
    border: 1px solid #1991FA;
}

.sliderContainer_active .sliderMask {
    border-width: 1px 0 1px 1px;
}

.sliderContainer_success .slider {
    top: -1px;
    border: 1px solid #52CCBA;
    background-color: #52CCBA !important;
}

.sliderContainer_success .sliderMask {
    border: 1px solid #52CCBA;
    border-width: 1px 0 1px 1px;
    background-color: #D2F4EF;
}

.sliderContainer_success .sliderIcon:before {
    content: "\f00c";
}

.sliderContainer_fail .slider {
    top: -1px;
    border: 1px solid #f57a7a;
    background-color: #f57a7a !important;
}

.sliderContainer_fail .sliderMask {
    border: 1px solid #f57a7a;
    background-color: #fce1e1;
    border-width: 1px 0 1px 1px;
}

.sliderContainer_fail .sliderIcon:before {
    content: "\f00d";
}

.sliderContainer_active .sliderText, .sliderContainer_success .sliderText, .sliderContainer_fail .sliderText {
    display: none;
}

.sliderMask {
    position: absolute;
    left: 0;
    top: 0;
    height: 40px;
    border: 0 solid #1991FA;
    background: #D1E9FE;
    border-radius: 2px;
}

.slider {
    position: absolute;
    top: 0;
    left: 0;
    width: 40px;
    height: 40px;
    background: #fff;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
    cursor: pointer;
    transition: background .2s linear;
    border-radius: 2px;
    display: flex;
    align-items: center;
    justify-content: center;
}

    .slider:hover {
        background: #1991FA;
    }

        .slider:hover .sliderIcon {
            background-position: 0 -13px;
        }

.sliderText {
    position: relative;
}

#refreshIcons {
    position: absolute;
    right: 4%;
    top: 4%;
    cursor: pointer;
    margin: 6px;
    color: #ddd;
    font-size: 1rem;
    z-index: 10000002;
    transition: color .3s linear;
}
    
#closeIcons {
    position: absolute;
    right: 22%;
    top: 4%;
    cursor: pointer;
    margin: 6px;
    color: #ddd;
    font-size: 1rem;
    z-index: 10000002;
}
</style>
</head>
<body>
<div class="container">
<div class="loading" id="loading"><img src="https://i.gifer.com/ZZ5H.gif"></div>
<img class="img-fluid" src="https://notescript.000webhostapp.com/images/RegisterPoster.jpg" alt="Youtube: Chỉ Có. Bone" onclick="window.open('https://youtu.be/xeOhGGMhyJs')">
<h6><strong>VIP Keys register - Super Script</strong></h6>
<form action="" id="registerForm" method="POST">
<div class="content">
<div class="layout-form">
<input class="input-username" id="username" name="keys" placeholder="Enter registration key" autocomplete="off" type="text" onfocusout="checkUser()">
<span class="efUsername" id="efUsername"></span>
<button class="fa fa-magic" id="btn-random" onclick="randomUser()"></button>
<b><i><small id="errorUsername" style="color: red"></small></i></b>
<button class="btn-submit" onclick="reCheck()" type="submit"><i id="submitIc" class="fa fa-arrow-right"></i></button>
</div>
<small id="Notify"></small>
<div class="layout-captcha" id="lcaptcha">
    <div class="slidercaptcha card">
        <div class="card-header">
           <span>Complete the security check</span>
           <i class="fa fa-repeat" id="refreshIcons"></i>
           <i class="fa fa-times" id="closeIcons"></i>
        </div>
       <div class="card-body">
          <div id="captcha"></div>
      </div>
    </div>
</div>
<br>
</form>
<div class="abcd">
  <i></i>
  Key renewal will increase by 7 days
  <p></p>
</div>
<br>
<br>
<div class="d-info" id="d-info">
  <strong>Your Key infomation</strong>
<form action="" method="POST">
<div class="info-tables">
  <table>
  <tr>
    <th>Key</th>
    <th>Actived</th>
    <th>Expire</th>
    <th>Last login</th>
    <th>Date created</th>
    <th>Device using</th>
  </tr>
  <tr>
    <td id="Userkey"></td>
    <td id="Actived"></td>
    <td id="Expire"></td>
    <td id="Lastlog"></td>
    <td id="Create"></td>
    <td id="Device"></td>
  </tr>
 </table>
</div>
<input type="hidden" id="infos" name="infos">
<button name="inforn" onclick="checkRn()" type="submit"><p class="fa fa-calendar-plus-o"></p></button>
<button name="infors" onclick="checkRs()" type="submit"><p class="fa fa-mobile"></p></button></button>
<button name="infodl" onclick="checkDl()" type="submit"><p class="fa fa-trash-o"></p></button></button>
</form>
</div>
<br>
<div class="d-chat">
<!--<small class="spinlink" onclick="window.open('https://notescript.000webhostapp.com/LuckySpin.php','_blank')"><u>🔥Keys Lucky Spin</u></small>-->
<div id="google_translate_element"></div>
</div>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
             }
        });
        
var Username = document.getElementById("username");
var format = /[ `!,√₫£€¢•π÷×§∆°✓©®™;#$%^&*()+\-\[\]{}'"\\|<>\/?~]/;
var errorUsername = document.getElementById("errorUsername");
var efUsername = document.getElementById("efUsername");
var submitIc = document.getElementById("submitIc");
var loading = document.getElementById("loading");
var NotifyErrorInfo = "Please register the key first!";
var Infor = document.getElementById("infos");

let cookieInfo = getCookie("UserInfo");
  if(cookieInfo){
    document.getElementById("d-info").style.display = "block";
    document.getElementById("infos").value = JSON.parse(cookieInfo).userkey;
    document.getElementById("Userkey").innerHTML = JSON.parse(cookieInfo).userkey;
    document.getElementById("Actived").innerHTML = JSON.parse(cookieInfo).actived;
    document.getElementById("Expire").innerHTML = JSON.parse(cookieInfo).expire;
    document.getElementById("Lastlog").innerHTML = JSON.parse(cookieInfo).lastlog;
    document.getElementById("Create").innerHTML = JSON.parse(cookieInfo).create;
    document.getElementById("Device").innerHTML = JSON.parse(cookieInfo).device;
  }

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

  var icbell = "<br>🔔 ";
  if(getCookie("Registering")) {
  	document.getElementById("Notify").innerHTML = icbell + "Pass the shortened link to complete registration";
  }
  if(getCookie("Renewing")) {
  	document.getElementById("Notify").innerHTML = icbell + "Pass the shortened link to complete the renewal";
  }
  
  let param1 = getCookie("Notification");
  if(param1 === "Exist"){
    Toast.fire({
                 icon: "warning",
                 title: "This key already exists"
                  });
  }
  if(param1 === "NotExist"){
    Swal.fire({
                 icon: "error",
                 title: "Key does not exist. Or has been deleted due to overdue",
                 confirmButtonText: "OK"
                  });
  }
 if(param1 === "Faild"){
   Toast.fire({
                 icon: "error",
                 title: "Time out"
                  });
  }
  if(param1 === "vpn"){
    Toast.fire({
                  icon: "warning",
                  title: "VPN detection"
                   });
  }
 if(param1 === "RegOut"){
   Swal.fire({
                 icon: "warning",
                 title: "You have registered the key before. Please delete key to continue registration",
                 confirmButtonText: "OK"
                  });
  }
 if(param1 === "RnOut"){
   Swal.fire({
                 icon: "error",
                 title: "Can continue to renew after 24 hours",
                 confirmButtonText: "OK"
                  });
  }
  let cookieAt = getCookie("AtSuccess");
  if(cookieAt){
      let convert = cookieAt.split("#");
      let keyname = convert[0];
      let expire = convert[1];
  	Swal.fire({
      title: `Get key from spin<br>You have received the ${expire}-day key`,
      html: `<input type="text" id="swalinput" value="${keyname}" style="text-align: center;width: auto;" readonly>`,
      icon: 'success',
      showCancelButton: true,
      confirmButtonText: 'Copy',
      cancelButtonText: 'OK',
      preConfirm: () => {
        var copyText = document.getElementById("swalinput");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
      }
         }).then(() => {
         	Toast.fire({
                 icon: "success",
                 title: "Thank you for taking the time"
              });
    });
  }
  
  let cookieSu = getCookie("SuSuccess");
  if(cookieSu){
  	let convert = cookieSu.split("#");
      let keyname = convert[0];
      let expire = convert[1];
  	Swal.fire({
      title: `Sign up success<br>You have received the ${expire}-day key`,
      html: `<input type="text" id="swalinput" value="${keyname}" style="text-align: center;width: auto;" readonly>`,
      icon: 'success',
      showCancelButton: true,
      confirmButtonText: 'Copy',
      cancelButtonText: 'OK',
      preConfirm: () => {
        var copyText = document.getElementById("swalinput");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
      }
         }).then(() => {
         	Toast.fire({
                 icon: "success",
                 title: "Thank you for taking the time"
              });
    });
  }
  
  let cookieRn = getCookie("RnSuccess")
  cookieRn = cookieRn.replace(/<br>/g, "\n");
  if(cookieRn){
  	Swal.fire({
  	    title: 'Renew successful',
          text: cookieRn,
          icon: 'success',
          confirmButtonText: 'Confirm',
  	}).then(() => {
         	Toast.fire({
                 icon: "success",
                 title: "Thank you for taking the time"
              });
    });
  }
  
  let cookieRs = getCookie("RsSuccess");
  if(cookieRs){
    Swal.fire({
                 icon: "success",
                 title: cookieRs + " | Reset device successfully",
                 confirmButtonText: "OK"
                  });
  }
  
  let cookieDl = getCookie("DlSuccess");
  if(cookieDl){
    Swal.fire({
                 icon: "warning",
                 title: cookieDl + " | Deleted",
                 confirmButtonText: "OK"
                  });
  }
  
function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function randomUser() {
  event.preventDefault();
  let nameList = [
    'a','i','u','e','o','ga','gi','gu','ge','go',
    'ka','ki','ku','ke','ko','za','zi','zu','ze','zo',
    'sa','shi','su','se','so','da','ji','zu','de','do',
    'ta','chi','tsu','te','to','ba','bi','bu','be','bo',
    'na','ni','nu','ne','no','pa','pi','pu','pe','po',
    'ha','hi','hu','he','ho','kya','kyu','kyo',
    'ma','mi','mu','me','mo','sha','shu','sho',
    'ya','yu','yo','cha','chu','cho',
    'ra','ri','ru','re','ro','nya','nyu','nyo',
    'wa','wo','n','hya','hyu','hyo',
    'mya','myu','myo',
    'rya','ryu','ryo',
    'gya','gyu','gyo',
    'jya','jyu','jyo',
    'bya','byu','byo',
    'pya','pyu','pyo',
    'A','I','U','E','O','Ga','Gi','Gu','Ge','Go',
    'Ka','Ki','Ku','Ke','Ko','Za','Zi','Zu','Ze','Zo',
    'Sa','Shi','Su','Se','So','Da','Ji','Zu','De','Do',
    'Ta','Chi','Tsu','Te','To','Ba','Bi','Bu','Be','Bo',
    'Na','Ni','Nu','Ne','No','Pa','Pi','Pu','Pe','Po',
    'Ha','Hi','Hu','He','Ho','Kya','Kyu','Kyo',
    'Ma','Mi','Mu','Me','Mo','Sha','Shu','Sho',
    'Ya','Yu','Yo','Cha','Chu','Cho',
    'Ra','Ri','Ru','Re','Ro','Nya','Nyu','Nyo',
    'Wa','Wo','N','Hya','Hyu','Hyo',
    'Mya','Myu','Myo',
    'Rya','Ryu','Ryo',
    'Gya','Gyu','Gyo',
    'Jya','Jyu','Jyo',
    'Bya','Byu','Byo',
    'Pya','Pyu','Pyo',
];
let name1 = nameList[Math.floor(Math.random() * nameList.length)];
let name2 = nameList[Math.floor(Math.random() * nameList.length)]+name1;
let name3 = nameList[Math.floor(Math.random() * nameList.length)]+name2;
  document.getElementById('errorUsername').innerHTML = "";
  document.getElementById('username').value = name3;
  efUsername.style.background = "greenyellow";
  efUsername.style.width = "12rem";
}

function checkUser(){
 if(Username.value.length == ""){
    return;
 } 
 if(Username.value.length < 4){
    efUsername.style.background = "red";
    efUsername.style.width = "12rem";
    errorUsername.innerHTML = "Key needs at least 4 characters";
    return;
 } 
 if(Username.value.length > 10){
    efUsername.style.background = "red";
    efUsername.style.width = "12rem";
    errorUsername.innerHTML = "Key contains up to 10 characters";
    return;
 }
 if(Username.value.match(format)){
    efUsername.style.background = "red";
    efUsername.style.width = "12rem";
    errorUsername.innerHTML = "Invalid characters";
    return;
 }
 if(Username.value == "ssfreekeys" || Username.value.substring(0,3) == "spn"){
    efUsername.style.background = "red";
    efUsername.style.width = "12rem";
    errorUsername.innerHTML = "Invalid key";
    return;
 }
 else {
  errorUsername.innerHTML = "";
  efUsername.style.background = "greenyellow";
  efUsername.style.width = "12rem";
  submitIc.className = "fa fa-arrow-right";
  }
}

function reCheck(){
 if(Username.value.length == ""){
    errorUsername.innerHTML = "";
    submitIc.className = "fa fa-question";
    event.preventDefault();
    return;
 } 
 if(Username.value.length < 4){
    efUsername.style.background = "red";
    efUsername.style.width = "12rem";
    errorUsername.innerHTML = "Key needs at least 4 characters";
    submitIc.className = "fa fa-exclamation";
    event.preventDefault();
    return;
 } 
 if(Username.value.length > 10){
    efUsername.style.background = "red";
    efUsername.style.width = "12rem";
    errorUsername.innerHTML = "Key contains up to 10 characters";
    submitIc.className = "fa fa-exclamation";
    event.preventDefault();
    return;
 }
 if(Username.value.match(format)){
    efUsername.style.background = "red";
    efUsername.style.width = "12rem";
    errorUsername.innerHTML = "Invalid characters";
    submitIc.className = "fa fa-exclamation";
    event.preventDefault();
    return;
 }
 if(Username.value == "ssfreekeys" || Username.value.substring(0,3) == "spn"){
    efUsername.style.background = "red";
    efUsername.style.width = "12rem";
    errorUsername.innerHTML = "Invalid key";
    submitIc.className = "fa fa-exclamation";
    event.preventDefault();
    return;
 }
 else {
  efUsername.style.background = "greenyellow";
  efUsername.style.width = "12rem";
  checkCaptcha();
  }
}

function checkCaptcha() {
  event.preventDefault();
  document.getElementById("lcaptcha").style.display = "block";
  var captcha = sliderCaptcha({
            id: 'captcha',
            repeatIcon: 'fa fa-redo',
            setSrc: function () {
                            return 'images/Pic' + Math.round(Math.random() * 8) + '.jpg';
                         },
            onSuccess: function () {             
                var handler = setTimeout(function () {
                    window.clearTimeout(handler);
                    loading.style.display = "block";
                    document.getElementById("lcaptcha").style.display = "none";
                    document.getElementById("captcha").innerHTML = "";
                    document.getElementById("registerForm").submit();
                }, 500);
            }
        });
}

var clagain = 1;
function checkRn() {
 if(Infor.value.length < 4){
    Toast.fire({
                  icon: "warning",
                  title: NotifyErrorInfo
                   });
    event.preventDefault();
    return;
 }
  if(clagain == 1) {
   document.getElementById("Notify").innerHTML = icbell + "Within 24 hours after registration, renewal will be 7 days. From 25 hours or more after registration, renew will be 4 days<br>Renew maximum once per day<br>Click again to renew";
   clagain = 0;
   event.preventDefault();
   return;
 } 
  else {
  document.getElementById("Notify").innerHTML = icbell + "Renewing...";
  loading.style.display = "block";
  //loadAPI
 }
}

function checkRs() {
 if(Infor.value.length < 4){
    Toast.fire({
                  icon: "warning",
                  title: NotifyErrorInfo
                   });
    event.preventDefault();
    return;
 }
  let choice = confirm("Reset the device?");
  if(choice == 1) {
    document.getElementById("Notify").innerHTML = icbell + "Reset device...";
    loading.style.display = "block";
    //loadAPI
  }
  if(choice == 0) {
    event.preventDefault();
  }
}

function checkDl() {
 if(Infor.value.length < 4){
    Toast.fire({
                  icon: "warning",
                  title: NotifyErrorInfo
                   });
    event.preventDefault();
    return;
 }
  let choice = confirm("Delete this key?");
  if(choice == 1) {
    document.getElementById("Notify").innerHTML = icbell + "Deleting...";
    loading.style.display = "block";
    //loadAPI
  }
  if(choice == 0) {
    event.preventDefault();
  }
}

document.getElementById("username").addEventListener("keypress", function(event) {
  if (event.keyCode === 13 || event.key === "Enter") {
    event.preventDefault();
    document.getElementById("login").click();
  }
});


if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

(function () {
    'use strict';

    var extend = function () {
        var length = arguments.length;
        var target = arguments[0] || {};
        if (typeof target != "object" && typeof target != "function") {
            target = {};
        }
        if (length == 1) {
            target = this;
            i--;
        }
        for (var i = 1; i < length; i++) {
            var source = arguments[i];
            for (var key in source) {
                if (Object.prototype.hasOwnProperty.call(source, key)) {
                    target[key] = source[key];
                }
            }
        }
        return target;
    }

    var isFunction = function isFunction(obj) {
        return typeof obj === "function" && typeof obj.nodeType !== "number";
    };

    var SliderCaptcha = function (element, options) {
        this.$element = element;
        this.options = extend({}, SliderCaptcha.DEFAULTS, options);
        this.$element.style.position = 'relative';
        this.$element.style.width = this.options.width + 'px';
        this.$element.style.margin = '0 auto';
        this.init();
    };
    
    SliderCaptcha.DEFAULTS = {
        width: 280,
        height: 155,
        PI: Math.PI,
        sliderL: 42,
        sliderR: 9,
        offset: 5,
        loadingText: 'Loading...',
        failedText: 'Try Again',
        barText: 'Slide To Verify',
        repeatIcon: 'fa fa-repeat',
        maxLoadCount: 3,
        localImages: function () {
            return 'images/Pic' + Math.round(Math.random() * 8) + '.jpg';
        },
        verify: function (arr, url) {
            var ret = false;
            $.ajax({
                url: url,
                data: {
                    "datas": JSON.stringify(arr),
                },
                dataType: "json",
                type: "post",
                async: false,
                success: function (result) {
                    ret = JSON.stringify(result);
                    console.log("Result: " + ret)
                }
            });
            return ret;
        },
        remoteUrl: null
    };

    function Plugin(option) {
        var $this = document.getElementById(option.id);
        var options = typeof option === 'object' && option;
        return new SliderCaptcha($this, options);
    }

    window.sliderCaptcha = Plugin;
    window.sliderCaptcha.Constructor = SliderCaptcha;

    var _proto = SliderCaptcha.prototype;
    _proto.init = function () {
        this.initDOM();
        this.initImg();
        this.bindEvents();
    };

    _proto.initDOM = function () {
        var createElement = function (tagName, className) {
            var elment = document.createElement(tagName);
            elment.className = className;
            return elment;
        };

        var createCanvas = function (width, height) {
            var canvas = document.createElement('canvas');
            canvas.width = width;
            canvas.height = height;
            return canvas;
        };

        var canvas = createCanvas(this.options.width - 2, this.options.height);
        var block = canvas.cloneNode(true);
        var sliderContainer = createElement('div', 'sliderContainer');
        var sliderMask = createElement('div', 'sliderMask');
        var sliderbg = createElement('div', 'sliderbg');
        var slider = createElement('div', 'slider');
        var sliderIcon = createElement('i', 'fa fa-arrow-right sliderIcon');
        var text = createElement('span', 'sliderText');

        block.className = 'block';
        text.innerHTML = this.options.barText;

        var el = this.$element;
        el.appendChild(canvas);
        el.appendChild(block);
        slider.appendChild(sliderIcon);
        sliderMask.appendChild(slider);
        sliderContainer.appendChild(sliderbg);
        sliderContainer.appendChild(sliderMask);
        sliderContainer.appendChild(text);
        el.appendChild(sliderContainer);

        var _canvas = {
            canvas: canvas,
            block: block,
            sliderContainer: sliderContainer,
            slider: slider,
            sliderMask: sliderMask,
            sliderIcon: sliderIcon,
            text: text,
            canvasCtx: canvas.getContext('2d'),
            blockCtx: block.getContext('2d')
        };

        if (isFunction(Object.assign)) {
            Object.assign(this, _canvas);
        }
        else {
            extend(this, _canvas);
        }
    };

    _proto.initImg = function () {
        var that = this;
        var isIE = window.navigator.userAgent.indexOf('Trident') > -1;
        var L = this.options.sliderL + this.options.sliderR * 2 + 3;
        var drawImg = function (ctx, operation) {
            var l = that.options.sliderL;
            var r = that.options.sliderR;
            var PI = that.options.PI;
            var x = that.x;
            var y = that.y;
            ctx.beginPath();
            ctx.moveTo(x, y);
            ctx.arc(x + l / 2, y - r + 2, r, 0.72 * PI, 2.26 * PI);
            ctx.lineTo(x + l, y);
            ctx.arc(x + l + r - 2, y + l / 2, r, 1.21 * PI, 2.78 * PI);
            ctx.lineTo(x + l, y + l);
            ctx.lineTo(x, y + l);
            ctx.arc(x + r - 2, y + l / 2, r + 0.4, 2.76 * PI, 1.24 * PI, true);
            ctx.lineTo(x, y);
            ctx.lineWidth = 2;
            ctx.fillStyle = 'rgba(255, 255, 255, 0.7)';
            ctx.strokeStyle = 'rgba(255, 255, 255, 0.7)';
            ctx.stroke();
            ctx[operation]();
            ctx.globalCompositeOperation = isIE ? 'xor' : 'destination-over';
        };

        var getRandomNumberByRange = function (start, end) {
            return Math.round(Math.random() * (end - start) + start);
        };
        var img = new Image();
        img.crossOrigin = "Anonymous";
        var loadCount = 0;
        img.onload = function () {
            that.x = getRandomNumberByRange(L + 10, that.options.width - (L + 10));
            that.y = getRandomNumberByRange(10 + that.options.sliderR * 2, that.options.height - (L + 10));
            drawImg(that.canvasCtx, 'fill');
            drawImg(that.blockCtx, 'clip');

            that.canvasCtx.drawImage(img, 0, 0, that.options.width - 2, that.options.height);
            that.blockCtx.drawImage(img, 0, 0, that.options.width - 2, that.options.height);
            var y = that.y - that.options.sliderR * 2 - 1;
            var ImageData = that.blockCtx.getImageData(that.x - 3, y, L, L);
            that.block.width = L;
            that.blockCtx.putImageData(ImageData, 0, y + 1);
            that.text.textContent = that.text.getAttribute('data-text');
        };
        img.onerror = function () {
            loadCount++;
            if (window.location.protocol === 'file:') {
                loadCount = that.options.maxLoadCount;
                console.error("can't load pic resource file from File protocal. Please try http or https");
            }
            if (loadCount >= that.options.maxLoadCount) {
                that.text.textContent = 'Unable to load image';
                that.classList.add('text-danger');
                return;
            }
            img.src = that.options.localImages();
        };
        img.setSrc = function () {
            var src = '';
            loadCount = 0;
            that.text.classList.remove('text-danger');
            if (isFunction(that.options.setSrc)) src = that.options.setSrc();
            if (!src || src === '') src = 'https://picsum.photos/' + that.options.width + '/' + that.options.height + '/?image=' + Math.round(Math.random() * 20);
            if (isIE) {
                var xhr = new XMLHttpRequest();
                xhr.onloadend = function (e) {
                    var file = new FileReader();
                    file.readAsDataURL(e.target.response);
                    file.onloadend = function (e) {
                        img.src = e.target.result;
                    };
                };
                xhr.open('GET', src);
                xhr.responseType = 'blob';
                xhr.send();
            } else img.src = src;
        };
        img.setSrc();
        this.text.setAttribute('data-text', this.options.barText);
        this.text.textContent = this.options.loadingText;
        this.img = img;
    };

    _proto.clean = function () {
        this.canvasCtx.clearRect(0, 0, this.options.width, this.options.height);
        this.blockCtx.clearRect(0, 0, this.options.width, this.options.height);
        this.block.width = this.options.width;
    };

    _proto.bindEvents = function () {
        var that = this;
        this.$element.addEventListener('selectstart', function () {
            return false;
        });
        
        document.getElementById("closeIcons").addEventListener('click', function () {   	
        document.getElementById("captcha").innerHTML = '';
            document.getElementById("lcaptcha").style.display = "none";
        });

        document.getElementById("refreshIcons").addEventListener('click', function () {
            that.text.textContent = that.options.barText;
            that.reset();
            //if (isFunction(that.options.onRefresh)) that.options.onRefresh.call(that.$element);
            document.getElementById("refreshIcons").className = "fa fa-ban";
            document.getElementById("refreshIcons").style.pointerEvents = "none";
            setTimeout(function() {
            	document.getElementById("refreshIcons").className = "fa fa-repeat";
            document.getElementById("refreshIcons").style.pointerEvents = "initial";
            }, 5000);
        });

        var originX, originY, trail = [],
            isMouseDown = false;

        var handleDragStart = function (e) {
            if (that.text.classList.contains('text-danger')) return;
            originX = e.clientX || e.touches[0].clientX;
            originY = e.clientY || e.touches[0].clientY;
            isMouseDown = true;
        };

        var handleDragMove = function (e) {
            if (!isMouseDown) return false;
            var eventX = e.clientX || e.touches[0].clientX;
            var eventY = e.clientY || e.touches[0].clientY;
            var moveX = eventX - originX;
            var moveY = eventY - originY;
            if (moveX < 0 || moveX + 40 > that.options.width) return false;
            that.slider.style.left = (moveX - 1) + 'px';
            var blockLeft = (that.options.width - 40 - 20) / (that.options.width - 40) * moveX;
            that.block.style.left = blockLeft + 'px';

            that.sliderContainer.classList.add('sliderContainer_active');
            that.sliderMask.style.width = (moveX + 4) + 'px';
            trail.push(Math.round(moveY));
        };

        var handleDragEnd = function (e) {
            if (!isMouseDown) return false;
            isMouseDown = false;
            var eventX = e.clientX || e.changedTouches[0].clientX;
            if (eventX === originX) return false;
            that.sliderContainer.classList.remove('sliderContainer_active');
            that.trail = trail;
            var data = that.verify();
            if (data.spliced && data.verified) {
                that.sliderContainer.classList.add('sliderContainer_success');
                if (isFunction(that.options.onSuccess)) that.options.onSuccess.call(that.$element);
            } else {
                that.sliderContainer.classList.add('sliderContainer_fail');
                if (isFunction(that.options.onFail)) that.options.onFail.call(that.$element);
                setTimeout(function () {
                    that.text.innerHTML = that.options.failedText;
                    that.reset();
                }, 1000);
            }
        };

        this.slider.addEventListener('mousedown', handleDragStart);
        this.slider.addEventListener('touchstart', handleDragStart);
        document.addEventListener('mousemove', handleDragMove);
        document.addEventListener('touchmove', handleDragMove);
        document.addEventListener('mouseup', handleDragEnd);
        document.addEventListener('touchend', handleDragEnd);

        document.addEventListener('mousedown', function () { return false; });
        document.addEventListener('touchstart', function () { return false; });
        document.addEventListener('swipe', function () { return false; });
    };

    _proto.verify = function () {
        var arr = this.trail;
        var left = parseInt(this.block.style.left);
        var verified = false;
        if (this.options.remoteUrl !== null) {
            verified = this.options.verify(arr, this.options.remoteUrl);
        }
        else {
            var sum = function (x, y) { return x + y; };
            var square = function (x) { return x * x; };
            var average = arr.reduce(sum) / arr.length;
            var deviations = arr.map(function (x) { return x - average; });
            var stddev = Math.sqrt(deviations.map(square).reduce(sum) / arr.length);
            verified = stddev !== 0;
        }
        return {
            spliced: Math.abs(left - this.x) < this.options.offset,
            verified: verified
        };
    };

    _proto.reset = function () {
        this.sliderContainer.classList.remove('sliderContainer_fail');
        this.sliderContainer.classList.remove('sliderContainer_success');
        this.slider.style.left = 0;
        this.block.style.left = 0;
        this.sliderMask.style.width = 0;
        this.clean();
        this.text.setAttribute('data-text', this.text.textContent);
        this.text.textContent = this.options.loadingText;
        this.img.setSrc();
    };
})();

function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<script crossorigin="anonymous" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>