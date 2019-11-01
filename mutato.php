<?php



if(substr($msg,0,7)=='/mutato' && $isadmin){
if(strlen($msg) == 7) str_replace('/mutato','',$msg);
else str_replace('/mutato ','',$msg);
$ban = array();
$s = explode(' ',$msg);
if($rid && (!strpos(' '.$s[0],'@') && !is_int($s[0]))){
$reason = $msg;
$ban = array('id' => $rid, 'username' => get($rid)[username], 'reason' => $reason);
goto mut;}
if(strpos(' '.$s[0],'@') && !is_int($s[0])){
$reason = str_replace($s[0],'',$msg);
$ban = array('id' => get($s[0])[user_id], 'username' => get($s[0])[username], 'reason' => $reason);
goto mut;}
if(is_int($s[0])){
$reason = str_replace($s[0],'',$msg);
$ban = array('id' => $s[0], 'username' => get($s[0])[username], 'reason' => $reason);
goto mut;}
if($entities){
$type = $entities[0][type];
$id = $entities[0][user][id];
$end = $entities[0][offset]+$entities[0][lenght]-5;
if($id && $type == 'text_mention'){
$reason =  substr($msg, 0, $end);
$ban = array('id' => $id, 'username' => get($id)[username], 'reason' => $reason);
}
}
mut:
if(!isadmin($ban[id])){
update($utab, "set mutato='1' where chat_id='$chatID' and user_id='$ban[id]'");
if($r[ok]){
$reason = '<b>per '.$ban[reason].'</b>';
sm($chatID, 'Ho mutato '.$ban[username]."[$ban[id]]");
}
}
}

if(substr($msg,0,9)=='/unmutato' && $isadmin){
if(strlen($msg) == 9) str_replace('/unmutato','',$msg);
else str_replace('/unmutato ','',$msg);
$ban = array();
$s = explode(' ',$msg);
if($rid && (!strpos(' '.$s[0],'@') && !is_int($s[0]))){
$reason = $msg;
$ban = array('id' => $rid, 'username' => get($rid)[username], 'reason' => $reason);
goto unmut;}
if(strpos(' '.$s[0],'@') && !is_int($s[0])){
$reason = str_replace($s[0],'',$msg);
$ban = array('id' => get($s[0])[user_id], 'username' => get($s[0])[username], 'reason' => $reason);
goto unmut;}
if(is_int($s[0])){
$reason = str_replace($s[0],'',$msg);
$ban = array('id' => $s[0], 'username' => get($s[0])[username], 'reason' => $reason);
goto unmut;}
if($entities){
$type = $entities[0][type];
$id = $entities[0][user][id];
$end = $entities[0][offset]+$entities[0][lenght]-5;
if($id && $type == 'text_mention'){
$reason =  substr($msg, 0, $end);
$ban = array('id' => $id, 'username' => get($id)[username], 'reason' => $reason);
}
}
unmut:
if(!isadmin($ban[id])){
update($utab, "set mutato='0' where chat_id='$chatID' and user_id='$ban[id]'");
if($r[ok]){
$reason = '<b>per '.$ban[reason].'</b>';
sm($chatID, 'Ho smutato '.$ban[username]."[$ban[id]]");
}
}
}
