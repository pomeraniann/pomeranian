<?php

// twitterユーザ情報を取得
$myself = json_decode($twitter->response["response"]);
$twiscreenName = $myself->{"screen_name"};
$twiname = $myself->{"name"};
$twiurl = $myself->{"url"};
$twiid = $myself->{"id_str"};
$twilocation = $myself->{"location"};
$twidescription = $myself->{"description"};
$twitter->request("GET", $twitter->url("1/account/verify_credentials"));

?>

