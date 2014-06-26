<?php


@ $msg = urlencode($_REQUEST['msg']);


header('Content-Type: text/plain');
$ch1=curl_init();
curl_setopt($ch1,CURLOPT_URL,"https://script.google.com/macros/s/AKfycbwdJkGV70sD21_uIvCmEYWccnuv43PCtT-rGQq8ByOyv4i3uWU/exec?message=".$msg);
curl_setopt($ch1,CURLOPT_FOLLOWLOCATION,TRUE);
curl_setopt($ch1,CURLOPT_RETURNTRANSFER,TRUE);
$res1=curl_exec($ch1);
echo "O4AFB-OK";

?>