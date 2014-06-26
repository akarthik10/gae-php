<?php


header('Content-Type: text/plain');

$quiztype = array();
$quiztype[0] = array();
$quiztype[1] = array();

$quiztype[0][0] = "quiz";
$quiztype[0][1] = "checkAnswer";
$quiztype[1][0] = "mathquiz";
$quiztype[1][1] = "checkAnswerMath";
$cval = array();

//$cookie = file_get_contents("cookie.txt");
$cookie = $_REQUEST['cookie'];
$cval=explode("=", $cookie);
$ch2=curl_init();
curl_setopt($ch2,CURLOPT_URL,"http://www.laaptu.com/mathquiz.action?id=".$cval[1]);
curl_setopt($ch2,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch2,CURLOPT_HEADER,FALSE);
curl_setopt($ch2,CURLOPT_COOKIE, $cookie);
curl_setopt($ch2, CURLOPT_REFERER, "http://www.laaptu.com");
curl_setopt($ch2,CURLOPT_RETURNTRANSFER,TRUE);
$res2=curl_exec($ch2);

if(stripos($res2, 'window.location="logout.action";')) die("LOGIN");

//echo $res2;
preg_match_all('/<input type="hidden" name="(.*?)".*?value="(.*?)">/', $res2, $hidden);
preg_match('/<input type="hidden" name="(hidQuestion)" id="hidQuestion" value=\'(.*?)\'/i', $res2, $ques);
preg_match_all("/selectAnswer\('(.*?)'\);\" t/i", $res2, $sel);
preg_match_all('/<div class="ruptext">(.*?)<\/div>/', $res2, $balance);

$query = "";
$actans = $sel[1][rand()%(count($sel[1]))];
for($i=0; $i< count($hidden[1]); $i++){
	if($hidden[1][$i]=="selAnswer")
		$query.=$hidden[1][$i]."=".$actans;
	else
		$query.=$hidden[1][$i]."=".$hidden[2][$i];
	//if($i!=count($hidden[1])-1)
		$query.="&";


}
$query.="hToken=".$cval[1]."&hCat=1&".$ques[1]."=".urlencode($ques[2]);

echo $balance[1][0].".".$balance[1][1];

$ch1=curl_init();
curl_setopt($ch1,CURLOPT_URL,"http://www.laaptu.com/checkAnswerMath.action");
curl_setopt($ch1,CURLOPT_FOLLOWLOCATION,FALSE);
curl_setopt($ch1,CURLOPT_HEADER,TRUE);
curl_setopt($ch1,CURLOPT_POST,TRUE);
curl_setopt($ch1, CURLOPT_COOKIE, $cookie);
curl_setopt($ch1,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($ch1,CURLOPT_POSTFIELDS,$query);
$res1=curl_exec($ch1);




?>