<?php

$user = $_REQUEST['user'];
$pass = $_REQUEST['pass'];
@ $num = $_REQUEST['num'];
@ $msg = urlencode($_REQUEST['msg']);

if(strlen($num)!=10)
	die("ERROR|NUMBER");
else if($msg=='')
	die("ERROR|MESSAGE");

header('Content-Type: text/plain');
$ch1=curl_init();
curl_setopt($ch1,CURLOPT_URL,"http://fullonsms.com/login.php");
curl_setopt($ch1,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch1,CURLOPT_HEADER,TRUE);
curl_setopt($ch1,CURLOPT_POST,TRUE);
curl_setopt($ch1,CURLOPT_POSTFIELDS, "MobileNoLogin=".$user."&LoginPassword=".$pass."&x=72&y=16&redirect=");
curl_setopt($ch1,CURLOPT_RETURNTRANSFER,TRUE);
$res1=curl_exec($ch1);
preg_match_all('/set-cookie: ?(FOS.*?=.*?);/i',$res1, $cookie);

if(!stripos($res1, 'landing_page'))
	die("ERROR|LOGIN");


$ch2=curl_init();
curl_setopt($ch2,CURLOPT_URL,"http://fullonsms.com/home.php");
curl_setopt($ch2,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch2,CURLOPT_HEADER,TRUE);
curl_setopt($ch2,CURLOPT_POST,TRUE);
curl_setopt($ch2, CURLOPT_COOKIE, end(end($cookie)));
curl_setopt($ch2,CURLOPT_POSTFIELDS, "ActionScript=%2Fhome.php&CancelScript=%2Fhome.php&HtmlTemplate=%2Fdisk1%2Fhtml%2Ffullonsms%2FStaticSpamWarning.html&MessageLength=140&MobileNos=".$num."&Message=".$msg."&SelTpl=defaultId&Gender=0&FriendName=Your+Friend+Name&ETemplatesId=&TabValue=contacts");
curl_setopt($ch2,CURLOPT_RETURNTRANSFER,TRUE);
$res2=curl_exec($ch2);
if(stripos($res2, 'msgsent'))
	echo "SUCCESS|".$num;
else
	echo "ERROR|NOTSENT";















?>