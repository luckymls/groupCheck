<?php

//Main File

if($_GET[token]){
$api = 'bot'.$_GET[token];
}

//Updates

$update = json_decode(file_get_contents('php://input'),true);

//Normal

$msg = $update[message][text];
$msgid = $update[message][message_id];
$userID = $update[message][from][id];
$nome = $update[message][from][first_name];
$cognome = $update[message][from][last_name];
$username = $update[message][from][username];
$lang = $update[message][from][language_code];
$chatID = $update[message][chat][id];

if($chatID){
$title = $update[message][chat][title];
$cusername = $update[message][chat][username];
}
$rid = $update[message][reply_to_message][from][id];
$rtext = $update[message][reply_to_message][text];
$entities = $update[message][entities];
$cbdata = $update[callback_query][data];

if($cbdata){
$cbid = $update[callback_query][id];
$msgid = $update[callback_query][message][message_id];
$userID = $update[callback_query][from][id];
$nome = $update[callback_query][from][first_name];
$cognome = $update[callback_query][from][last_name];
$username = $update[callback_query][from][username];
$lang = $update[callback_query][from][language_code];
$chatID = $update[callback_query][message][chat][id];

if($chatID){
$title = $update[callback_query][message][chat][title];
$cusername = $update[callback_query][message][chat][username];
}
}

$inline_query = $update[inline_quey];

if($inline_query){
$userID = $update[inline_query][from][id];
$nome = $update[inline_query][from][first_name];
$cognome = $update[inline_query][from][last_name];
$username = $update[inline_query][from][username];
$lang = $update[inline_query][from][language_code];
$query = $update[inline_query][query];
}

$chosen_inline_result = $update[chosen_inline_result];

if($chosen_inline_result){
$userID = $update[chosen_inline_result][from][id];
$nome = $update[chosen_inline_result][from][first_name];
$cognome = $update[chosen_inline_result][from][last_name];
$username = $update[chosen_inline_result][from][username];
$lang = $update[chosen_inline_result][from][language_code];
$inline_message_id = $update[chosen_inline_result][inline_message_id];
$query = $update[chosen_inline_result][query];
$result_id = $update[chosen_inline_result][result_id];
}

//Database

mysql_select_db('my_channelbot');

//Tab nome
$tab = 'utenti_bot'; //Utenti bot generale
$utab = 'utenti_gruppi'; //Utenti nei gruppi del bot
$gtab = 'gruppi'; //Tabella gruppi
$atab = 'admin'; //Tabella dei ruoli
$ctab = 'cloni';  //Tabella dei cloni

//Functions
//Request => Par: url, data, json_decode = true (?)

function req($url, $data, $jd){

$data = http_build_query($data);
$context = stream_context_create(array('http' => array('content' => $data)));

$r = file_get_contents($url, false, $context);
if($jd)
return json_decode($r,true);
else
return $r;
}

function sm($chat, $txt, $menu, $pm, $reply){
global $api;

$arg = array(
'chat_id' => $chat,
'text' => $txt,
'reply_markup' => null,
'parse_mode' => 'html',
'reply_to_message_id' => $reply);
if($menu){$arg[reply_markup] = json_encode(array('inline_keyboard' => $menu));}

return req("https://api.telegram.org/$api/sendmessage", $arg, true);
}

function emt($txt, $menu){
global $api,$chatID, $msgid;

$arg = array(
'chat_id' => $chatID,
'message_id' => $msgid,
'text' => $txt,
'parse_mode' => 'html',
'reply_markup' => null);
if($menu){$arg[reply_markup] = json_encode(array('inline_keyboard' => $menu));}

return req("https://api.telegram.org/$api/editmessagetext", $arg, true);
}

function cb_reply($text, $alert = true){
global $api,$cbid;
$arg = array(
'callback_query_id' => $cbid,
'text' => $text,
'show_alert' => $alert
);
return req("https://api.telegram.org/$api/answercallbackquery", $arg, true);
}

function is_url($url){
  $regex = "((https?|ftp)\:\/\/)?";
   $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";
   $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})";
   $regex .= "(\:[0-9]{2,5})?";
   $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?";
   $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?";
   $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?";

      if(preg_match("/^$regex$/i", $url)) return true;

}

function menu($menu, $back){

// menu("{testo | ah}{ciao | si}");
$new_menu = array();
$e = explode('
',$menu);
foreach($e as $ent){
$x = explode('{', $ent);
foreach($x as $div){
if($div != null){
$div = str_replace('}','',$div); //ciao | si
$ef = explode(' | ',$div);
$text = $ef[0];
$data = $ef[1];
if(is_url($data))
array_push($new_menu, array('text' => $text, 'url' => $data));
  else
array_push($new_menu, array('text' => $text,'callback_data' => $data));
}}
$new_men[] = $new_menu;

}
if($back) $new_men[] = array(array('text' => "Indietro",'callback_data' => 'pmenu'));
return $new_men;}

function smedia($chat, $file_id, $caption, $menu){
global $api, $update;
$up = $update[message];
$photo = $up[photo][0][file_id];
$video = $up[video][file_id];
$videon = $up[video_note][file_id];
$audio = $up[audio][file_id];
$voice = $up[voice][file_id];
$sticker = $up[sticker][file_id];
$gif = $up[document][file_id];


$arg = array(
'chat_id' => $chat,
'caption' => $caption,
'reply_markup' => null
);
if($menu)$arg[reply_markup] = json_encode(array('inline_keyboard' => $menu));

if($photo)$arg[$type = 'photo'] = $photo;
if($video)$arg[$type = 'video'] = $video;
if($videon)$arg[$type = 'video_note'] = $videon;
if($audio)$arg[$type = 'audio'] = $audio;
if($voice)$arg[$type = 'voice'] = $voice;
if($sticker)$arg[$type = 'sticker'] = $sticker;
if($gif)$arg[$type = 'document'] = $gif;

return req("https://api.telegram.org/$api/send$type", $arg, true);
}

function dm($chat, $id){
global $api;
$arg = array(
'chat_id' => $chat,
'message_id' => $id
);
return req("https://api.telegram.org/$api/send$type", $arg, true);
}

function ban($chat, $id){
global $api;
$arg = array(
'chat_id' => $chat,
'user_id' => $id
);
return req("https://api.telegram.org/$api/kickchatmember", $arg, true);
}

function sban($chat, $id){
global $api;
$arg = array(
'chat_id' => $chat,
'user_id' => $id
);
return req("https://api.telegram.org/$api/unbanchatmember", $arg, true);
}

//Obtain username, id of a user

function get($thing){
global $tab;
if(!is_int($thing)){
$x = mysql_fetch_assoc(mysql_query("select * from $tab where username='$thing'"));
}else {
$x = mysql_fetch_assoc(mysql_query("select * from $tab where user_id='$thing'"));
}
if($x) return array('id' => $x[user_id], 'username' => $x[username]);
else return false;
}

function isadmin($id){
global $atab,$chatID;
$r = mysql_fetch_assoc(mysql_query("select * from $atab where chat_id='$chatID' and user_id='$id'"));
if($r[status] == 'administrator' || $r[status] == 'creator') return true;
else
return false;
}

//Escape a string use this in update, select and insert query
function db($var){
if(stripos(' '.$var, '!0'))return str_replace('!0',"'",$var);
else
return str_replace("'", '!0', $var);
}

function update($tab, $query){
mysql_query("update $tab $query");
}

?>
