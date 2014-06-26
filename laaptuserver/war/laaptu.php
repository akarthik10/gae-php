<?php


//header('Content-Type: text/plain');

@$user=urlencode($_REQUEST['user']);
@$pass=$_REQUEST['pass'];



if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == "Submit") {



$ch1=curl_init();
curl_setopt($ch1,CURLOPT_URL, $_REQUEST['domain']."laaptu.com/captvalidate.action?secure_code=".$_POST['response']);
curl_setopt($ch1,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch1,CURLOPT_HEADER,FALSE);
curl_setopt($ch1,CURLOPT_COOKIE, $_POST['cookie']);
curl_setopt($ch1, CURLOPT_REFERER, "http://www.laaptu.com");
curl_setopt($ch1,CURLOPT_RETURNTRANSFER,TRUE);
$res1=curl_exec($ch1);

//file_put_contents("cookie.txt", $_POST['cookie']);

/*$ch2=curl_init();
curl_setopt($ch2,CURLOPT_URL, "https://script.google.com/macros/s/AKfycbzSsRzwM-SZFqL8T52P6rZJrgvV0pJ5d8ot0qraYjIadBBeN1c/exec?mode=update&user=".urlencode($_POST['user'])."&cookie=".urlencode($_REQUEST['cookie']));
curl_setopt($ch2,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch2,CURLOPT_HEADER,FALSE);
curl_setopt($ch2,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch2,CURLOPT_COOKIE, $_POST['cookie']);
curl_setopt($ch2, CURLOPT_REFERER, "http://www.laaptu.com");
curl_setopt($ch2,CURLOPT_RETURNTRANSFER,TRUE);
$res2=curl_exec($ch2);*/
die($_POST['cookie']);


}

if($user=="" || $pass=="") die("ERROR|USERPASS");


$domain = "";
$ch0=curl_init();
curl_setopt($ch0,CURLOPT_URL, "http://www.laaptu.com/");
curl_setopt($ch0,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch0,CURLOPT_HEADER,TRUE);
curl_setopt($ch0, CURLOPT_REFERER, "http://www.laaptu.com");
curl_setopt($ch0,CURLOPT_RETURNTRANSFER,TRUE);
$res0=curl_exec($ch0);

if(preg_match('/location: ?(.*?)laaptu/i', $res0, $redir)){
$domain = $redir[1];
}
else
{
	$domain = "www.";
}


$ch1=curl_init();
curl_setopt($ch1,CURLOPT_URL,$domain."laaptu.com/login.action");
curl_setopt($ch1,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch1,CURLOPT_HEADER,TRUE);
curl_setopt($ch1,CURLOPT_POST,TRUE);
curl_setopt($ch1,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($ch1,CURLOPT_POSTFIELDS,"username=".$user."&password=".$pass);
$res1=curl_exec($ch1);
preg_match_all('/set-cookie: ?(JS.*?=.*?);/i',$res1, $cookie);
preg_match_all('/location: ?(.*?)\n/i',$res1, $redir);



$cookie = end(end($cookie));
$red =  end(end($redir));
//echo $cookie;
$cookiepart = explode("~", $cookie);

//echo $res1;
//print_r($cookie);
//print_r($redir);

$ch2=curl_init();
curl_setopt($ch2,CURLOPT_URL,$domain."laaptu.com/Validaccount.action?id=".$cookiepart[1]);
curl_setopt($ch2,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch2,CURLOPT_HEADER,FALSE);
curl_setopt($ch2,CURLOPT_COOKIE, $cookie);
curl_setopt($ch2, CURLOPT_REFERER, $domain."laaptu.com/login.action");
curl_setopt($ch2,CURLOPT_RETURNTRANSFER,TRUE);
$res2=curl_exec($ch2);
preg_match_all('/"(loadcaptcha.*?)"/i', $res2, $image);




$ch2=curl_init();
curl_setopt($ch2,CURLOPT_URL,$domain."laaptu.com/".end(end($image)));
curl_setopt($ch2,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch2,CURLOPT_HEADER,FALSE);
curl_setopt($ch2,CURLOPT_COOKIE, $cookie);
curl_setopt($ch2, CURLOPT_REFERER, "http://www.laaptu.com");
curl_setopt($ch2,CURLOPT_RETURNTRANSFER,TRUE);
$res2=curl_exec($ch2);

//file_put_contents("captcha.jpg", $res2);


echo '<form name="captchasolver" action="" method="post">';
//echo '<img src="./captcha.jpg"></img>';
echo '<img src="data:image/jpg;base64,' . base64_encode( $res2) . '" />';
echo '<input type="text" name="response" value="" />';
echo '<input type="hidden" name="cookie" value="'.$cookie.'" />';
echo '<input type="hidden" name="user" value="'.$user.'" />';
echo '<input type="hidden" name="domain" value="'.$domain.'" />';
echo '<input type="submit" name="submit" value="Submit" /> </form>';













?>