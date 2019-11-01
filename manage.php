<?php

#manca da mettere il ban  a tempo

//ban
if(substr($msg,0,4)=='/ban' && $isadmin){
if(strlen($msg) == 4) str_replace('/ban','',$msg);
else str_replace('/ban ','',$msg);
$ban = array();
$s = explode(' ',$msg);
if($rid && (!strpos(' '.$s[0],'@') && !is_int($s[0]))){
$reason = $msg;
$ban = array('id' => $rid, 'username' => get($rid)[username], 'reason' => $reason);
goto ban;}
if(strpos(' '.$s[0],'@') && !is_int($s[0])){
$reason = str_replace($s[0],'',$msg);
$ban = array('id' => get($s[0])[user_id], 'username' => get($s[0])[username], 'reason' => $reason);
goto ban;}
if(is_int($s[0])){
$reason = str_replace($s[0],'',$msg);
$ban = array('id' => $s[0], 'username' => get($s[0])[username], 'reason' => $reason);
goto ban;}
if($entities){
$type = $entities[0][type];
$id = $entities[0][user][id];
$end = $entities[0][offset]+$entities[0][lenght]-5;
if($id && $type == 'text_mention'){
$reason =  substr($msg, 0, $end);
$ban = array('id' => $id, 'username' => get($id)[username], 'reason' => $reason);
}
}
ban:
$r = ban($chatID, $ban[id]);
if($r[ok]){
$reason = '<b>per '.$ban[reason].'</b>';
sm($chatID, 'Ho bannato '.$ban[username]."[$ban[id]]");
}else{
sm($userID, "Non sono riuscito a bannare ".$ban[username]."[$ban[id]]");
}
}


//sban
if(substr($msg,0,6)=='/unban' && $isadmin){
if(strlen($msg) == 6) str_replace('/unban','',$msg);
else str_replace('/unban ','',$msg);
$ban = array();
$s = explode(' ',$msg);
if($rid && (!strpos(' '.$s[0],'@') && !is_int($s[0]))){
$reason = $msg;
$ban = array('id' => $rid, 'username' => get($rid)[username], 'reason' => $reason);
goto sban;}
if(strpos(' '.$s[0],'@') && !is_int($s[0])){
$reason = str_replace($s[0],'',$msg);
$ban = array('id' => get($s[0])[user_id], 'username' => get($s[0])[username], 'reason' => $reason);
goto sban;}
if(is_int($s[0])){
$reason = str_replace($s[0],'',$msg);
$ban = array('id' => $s[0], 'username' => get($s[0])[username], 'reason' => $reason);
goto sban;}
if($entities){
$type = $entities[0][type];
$id = $entities[0][user][id];
$end = $entities[0][offset]+$entities[0][lenght]-5;
if($id && $type == 'text_mention'){
$reason =  substr($msg, 0, $end);
$ban = array('id' => $id, 'username' => get($id)[username], 'reason' => $reason);
}
}
sban:
$r = sban($chatID, $ban[id]);
if($r[ok]){
$reason = '<b>per '.$ban[reason].'</b>';
sm($chatID, 'Ho sbannato '.$ban[username]."[$ban[id]]");
}else{
sm($userID, "Non sono riuscito a sbannare ".$ban[username]."[$ban[id]]");
}
}


//kick
if(substr($msg,0,5)=='/kick' && $isadmin){
if(strlen($msg) == 5) str_replace('/kick','',$msg);
else str_replace('/kick ','',$msg);
$ban = array();
$s = explode(' ',$msg);
if($rid && (!strpos(' '.$s[0],'@') && !is_int($s[0]))){
$reason = $msg;
$ban = array('id' => $rid, 'username' => get($rid)[username], 'reason' => $reason);
goto kick;}
if(strpos(' '.$s[0],'@') && !is_int($s[0])){
$reason = str_replace($s[0],'',$msg);
$ban = array('id' => get($s[0])[user_id], 'username' => get($s[0])[username], 'reason' => $reason);
goto kick;}
if(is_int($s[0])){
$reason = str_replace($s[0],'',$msg);
$ban = array('id' => $s[0], 'username' => get($s[0])[username], 'reason' => $reason);
goto kick;}
if($entities){
$type = $entities[0][type];
$id = $entities[0][user][id];
$end = $entities[0][offset]+$entities[0][lenght]-5;
if($id && $type == 'text_mention'){
$reason =  substr($msg, 0, $end);
$ban = array('id' => $id, 'username' => get($id)[username], 'reason' => $reason);
}
}
kick:
ban($chatID, $ban[id]);
$r = sban($chatID, $ban[id]);
if($r[ok]){
$reason = '<b>per '.$ban[reason].'</b>';
sm($chatID, 'Ho kickato '.$ban[username]."[$ban[id]]");
}else{
sm($userID, "Non sono riuscito a kickare ".$ban[username]."[$ban[id]]");
}
}
