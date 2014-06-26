<?php

$user = $_REQUEST['user'];
$pass = $_REQUEST['pass'];
@$num = $_REQUEST['num'];
@$msg = urlencode($_REQUEST['msg']);

header('Content-Type: text/plain');
$ch1=curl_init();
curl_setopt($ch1,CURLOPT_URL,"http://site3.way2sms.com/Login1.action");
curl_setopt($ch1,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch1,CURLOPT_HEADER,TRUE);
curl_setopt($ch1,CURLOPT_POST,TRUE);
curl_setopt($ch1,CURLOPT_POSTFIELDS, "gval=&errordisp=&username=".$user."&password=".$pass);
curl_setopt($ch1,CURLOPT_RETURNTRANSFER,TRUE);
$res1=curl_exec($ch1);

if(stripos($res1, "entry2.action")) die("ERROR|LOGIN");

preg_match_all('/set-cookie: ?(JSE.*?=.*?);/i',$res1, $cookie);
$token = explode("~", $cookie[1][0]);

if($num=="" || $msg=="")	die("ERROR|ARGUMENTS");

$ch3=curl_init();
curl_setopt($ch3,CURLOPT_URL,"http://site3.way2sms.com/singles.action?Token=".$token[1]);
curl_setopt($ch3,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch3,CURLOPT_HEADER,TRUE);
curl_setopt($ch3, CURLOPT_COOKIE, $cookie[1][0]);
curl_setopt($ch3, CURLOPT_REFERER, "http://site3.way2sms.com");
curl_setopt($ch3,CURLOPT_RETURNTRANSFER,TRUE);
$res3=curl_exec($ch3);


//echo $res3;

preg_match_all('/(?:(?:(?:hidden)|(?:display.*?none)).*?name=\'(.*?)\'.*?value=\'(.*?)\')|(?:textarea.*?display.*?none.*?name=\'(.*?)\'.*?>(.*?)<)/i', $res3, $hid1);
preg_match_all('/(?:(?:(?:hidden)|(?:display.*?none)).*?value="(.*?)".*?name="(.*?)")|(?:select.*?name="(.*?)".*?display.*?none.*?value="(.*?)")/i', $res3, $hid2);
preg_match_all('/setAttribute\("type",\s?"hidden"\).*?value",\s"(.*?)".*?name",\s?"(.*?)"/si', $res3, $hid3);
preg_match_all('/<input name=\'(.*?)\'.*?placeholder=\'Mobile Number\'/si', $res3, $hid4);

$query="";

/*
print_r($hid1);
print_r($hid2);
print_r($hid3);
print_r($hid4);
*/
for($i=0; $i<count($hid1[1]); $i++){
	if($hid1[1][$i]=="" && $hid1[2][$i]=="")
		$query.=$hid1[3][$i]."=".$hid1[4][$i];
	else
		$query.=$hid1[1][$i]."=".$hid1[2][$i];
	$query.="&";
}

for($i=0; $i<count($hid2[1]); $i++){
	if($hid2[1][$i]=="" && $hid2[2][$i]=="")
		$query.=$hid2[3][$i]."=".$hid2[4][$i];
	else
		$query.=$hid2[2][$i]."=".$hid2[1][$i];
	$query.="&";
}

for($i=0; $i<count($hid3[1]); $i++){
	
		$query.=$hid3[2][$i]."=".$hid3[1][$i];
		$query.="&";
}

$query.=$hid4[1][0]."=".$num."&textfield2=%2B91&textArea=".$msg."&txtLen=0";

//echo $query;
//die();
/*
catnamedis=Birthday&t_15_k_5=PTQCXA&i_m=ssms&kriya=sf55sa5655sdf5&m_15_b=KaEkMPjA&EQRzbQJ=&PTQCXA=8241148EA09C927D7E141BD2F48E543E.w812&adno=1&catnamedis=Birthday&hud_action=abfghst5654g&Token=8241148EA09C927D7E141BD2F48E543E.w812&textfield2=%2B91&KaEkMPjA=7760662670&textArea=Hi+there+what+do+you+want&txtLen=115
*/


/*
(?:(?:(?:hidden)|(?:display.*?none)).*?name='(.*?)'.*?value='(.*?)')|(?:textarea.*?display.*?none.*?name='(.*?)'.*?>(.*?)<)
(?:(?:(?:hidden)|(?:display.*?none)).*?value="(.*?)".*?name="(.*?)")|(?:select.*?name="(.*?)".*?display.*?none.*?value="(.*?)")
setAttribute\(\"type\",\s?\"hidden\"\).*?value\",\s\"(.*?)\".*?name\",\s?\"(.*?)\"
<input name='(.*?)'.*?placeholder='Mobile Number'
textfield2=%2B91
textArea
*/

$ch2=curl_init();
curl_setopt($ch2,CURLOPT_URL,"http://site3.way2sms.com/stp2p.action");
curl_setopt($ch2,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch2,CURLOPT_HEADER,TRUE);
curl_setopt($ch2,CURLOPT_POST,TRUE);
curl_setopt($ch2, CURLOPT_REFERER, "http://site3.way2sms.com/singles.action");
curl_setopt($ch2, CURLOPT_COOKIE, $cookie[1][0]);
curl_setopt($ch2,CURLOPT_POSTFIELDS, $query);
curl_setopt($ch2,CURLOPT_RETURNTRANSFER,TRUE);
$res2=curl_exec($ch2);


if(stripos($res2, "generalconfirm.action") && stripos($res2, "successfully")) die("OK|".$num);
if(stripos($res2, "singles"))	die("ERROR|UNKNOWN");
die("ERROR|UNKNOWN");









?>