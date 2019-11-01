<?php

//Traduzione
if(substr($msg,0,8)=='/traduci' && $rtext){
if(strlen($msg)==8)$lang = 'it';
else $lang = str_replace('/traduci ','',$msg);
$r = translate($rtext, $lang);
sm($chatID, "Traduzione: <code>$r</code>");
}

//Linguaggio Detect
if($rtext && $msg == '/lang')sm($chatID, "Lingua: ".language($rtext));

?>
