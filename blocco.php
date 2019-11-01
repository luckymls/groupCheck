<?php

if($cbdata == 'blocentrate'){
$menu[] = menu("{Utenti | blocutenteinfo}{On | blocutenteon}{Off | blocutenteoff}");
$menu[] = menu("{Bot | blocbotinfo}{On | blocboton}{Off | blocbotoff}",true);
if($bloccobot)$bot = 'Attivo'; else $bot = 'Spento';
if($bloccoutenti)$utente = 'Attivo'; else $utente = 'Spento';
emt("<b>Blocco Ingressi</b>
Blocco utenti: <code>$utente</code>
Blocco bot: <code>$bot</code>",$menu);
}

if(substr($cbdata,0,10)=='blocutente'){
$cbdata = str_replace('blocutente','',$cbdata);
if($cbdata == 'info')cb_reply("Blocca l'accesso al gruppo a utenti",true);
elseif($cbdata == 'on'){
$stato = 'Attivo';
update($gtab, "set blocutenti='1' where chat_id='$chatID'");
}elseif($cbdata == 'off'){
$stato = 'Spento';
update($gtab,"set blocutenti='0' where chat_id='$chatID'");
}
if($bloccobot)$bot = 'Attivo'; else $bot = 'Spento';

emt("<b>Blocco Ingressi</b>
Blocco utenti: <code>$stato</code>
Blocco bot: <code>$bot</code>",$menu);
}

if(substr($cbdata,0,7)=='blocbot'){
$cbdata = str_replace('blocbot','',$cbdata);
if($cbdata == 'info')cb_reply("Blocca l'inserimento di bot nel gruppo",true);
elseif($cbdata == 'on'){
$stato = 'Attivo';
update($gtab, "set blocbot='1' where chat_id='$chatID'");
}elseif($cbdata == 'off'){
$stato = 'Spento';
update($gtab,"set blocbot='0' where chat_id='$chatID'");
}
if($bloccoutenti)$utente = 'Attivo'; else $utente = 'Spento';
emt("<b>Blocco Ingressi</b>
Blocco utenti: <code>$utente</code>
Blocco bot: <code>$stato</code>",$menu);
}

//Blocco bot
if($update[message][new_chat_members] && !$isadmin && $userID != $update[message][new_chat_member][id] && $bloccobot){
foreach($update[message][new_chat_members] as $up){
$id = $up[id];
$us = strtolower($up[username]);
if(substr($us, -3) == 'bot'){
#$de = json_decode($x = file_get_contents("https://api.telegram.org/$api/sendmessage?chat_id=$id&text=ehy"),true)[error_code];

ban($chatID, $id); //banno il bot
$text .= "
@$us [$id]";
}
}

if($userID){
ban($chatID, $userID);
ban($chatID, $userID);

$add_who = "@$username [$userID] รจ stato kickato.";
}
if($text){
sm($chatID, "Ho bannato i seguenti bot:
<code>$text
$add_who</code>
<b>Bot non ammessi!</b>",'html');
}
}

//Blocco utenti
if($update[message][new_chat_member] && $bloccoutenti){
sm($chatID, "Gruppo Bloccato.");
ban($chatID, $update[message][new_chat_member][id]);
}
