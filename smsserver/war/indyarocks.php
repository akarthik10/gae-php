<?php


$user = $_REQUEST['user'];
$pass = $_REQUEST['pass'];
@$nums = $_REQUEST['num'];
@$msg = urlencode($_REQUEST['msg']);

header('Content-Type: text/plain');

if($nums=='') die("ERROR|NUMBER");
else if($msg=='') die("ERROR|MESSAGE");
$ch1=curl_init();
curl_setopt($ch1,CURLOPT_URL,"http://www.indyarocks.com/login");
curl_setopt($ch1,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch1,CURLOPT_HEADER,TRUE);
curl_setopt($ch1,CURLOPT_POST,TRUE);
curl_setopt($ch1,CURLOPT_POSTFIELDS, "LoginForm%5Busername%5D=".$user."&LoginForm%5Bpassword%5D=".$pass."&yt0=Login");
curl_setopt($ch1,CURLOPT_RETURNTRANSFER,TRUE);
$res1=curl_exec($ch1);

if(stripos($res1, 'login.php'))
		die("ERROR|LOGIN");
preg_match_all('/set-cookie:.*?,(PHP.*?=.*?);/i',$res1, $cookie);


$num = array();
$num = explode(',', $nums);


foreach ($num as $number) {

$ch2=curl_init();
curl_setopt($ch2,CURLOPT_URL,"http://www.indyarocks.com/send-free-sms");
curl_setopt($ch2,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch2,CURLOPT_HEADER,TRUE);
curl_setopt($ch2,CURLOPT_POST,TRUE);
curl_setopt($ch2, CURLOPT_COOKIE, end(end($cookie)));
curl_setopt($ch2,CURLOPT_POSTFIELDS, "freeSmschkmemberVal=NM&FreeSms%5Bmobile%5D=".$number."&FreeSms%5Bpost_message%5D=".$msg);
curl_setopt($ch2,CURLOPT_RETURNTRANSFER,TRUE);
$res2=curl_exec($ch2);
echo "SUCCESS|".$number."\n";
}















?>