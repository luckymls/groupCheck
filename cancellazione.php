<?php

//Cancellazione automatica impostata di default su / solo per utenti

if($cbdata == 'cancmessaggi'){
$menu[] = menu('{Comandi | cancommandi}');
$menu[] = menu('{Silenzio | silenzio}');
$menu[] = menu('{Notifiche | servizio}',true);
emt('Scegli cosa modificare!',$menu);
}

//cancommandi
if($cbdata == 'cancommandi'){
$menu[] = menu('{Admin | cancinfoadmin}{/ | cancadminslash}{/!#. | cancadminall}{off | cancadminoff}');
$menu[] = menu('{Utente | cancinfoutente}{/ | cancutenteslash}{/!#. | cancutenteall}{off | cancutenteoff}',true);
if($c_admin == 'slash') $admin = 'inizianti per /';
if($c_admin == 'all') $admin = 'inizianti per !.#/';
if($c_admin == 'off') $admin = 'spento';
if($c_utente == 'slash') $utente = 'inizianti per /';
if($c_utente == 'all') $utente = 'inizianti per !.#/';
if($c_utente == 'off') $utente = 'spento';
emt("<b>Cancellazione Comandi</b>
Quali comandi devono essere cancellati?
<code>esempio: /ban,!ban</code>

<b>Admin: $admin</b>
<b>Utenti: $utente</b>",$menu);
}
//Informazioni Utenti&Admin
if(substr($cbdata,0,8)=='cancinfo'){
$cbdata = str_replace('cancinfo','',$cbdata);
if($cbdata == 'admin')
cb_reply('Scegli che comandi cancellare a gli admin!');
else
cb_reply('Scegli che comandi cancellare a gli utenti');
}

//Cancellazione comandi admin
if(substr($cbdata,0,9)=='cancadmin'){
$cbdata = str_replace('cancinfo','',$cbdata);
if($c_utente == 'slash') $utente = 'inizianti per /';
if($c_utente == 'all') $utente = 'inizianti per !.#/';
if($c_utente == 'off') $utente = 'spento';
if($cbdata == 'slash'){
update($gtab, "set cancadmin='slash' where chat_id='$chatID'");
$admin = 'inizianti per /';
}elseif($cbdata == 'all'){
update($gtab, "set cancadmin='slash' where chat_id='$chatID'");
$admin = 'inizianti per !.#/';
}elseif($cbdata == 'off'){
update($gtab, "set cancadmin='off' where chat_id='$chatID'");
$admin = 'spento';
}
$menu[] = menu('',true);
emt("<b>Cancellazione Comandi</b>
Quali comandi devono essere cancellati?
<code>esempio: /ban,!ban</code>

<b>Admin: $admin</b>
<b>Utenti:</b> $utente", $menu);
}

//Cancellazione comandi utenti
if(substr($cbdata,0,10)=='cancutente'){
$cbdata = str_replace('cancutente','',$cbdata);
if($c_admin == 'slash') $admin = 'inizianti per /';
if($c_admin == 'all') $admin = 'inizianti per !.#/';
if($c_admin == 'off') $admin = 'off';
if($cbdata == 'slash'){
update($gtab, "set cancutente='slash' where chat_id='$chatID'");
$utente = 'inizianti per /';
}elseif($cbdata == 'all'){
update($gtab, "set cancutente='slash' where chat_id='$chatID'");
$utente = 'inizianti per !.#/';
}elseif($cbdata == 'off'){
update($gtab, "set cancutente='off' where chat_id='$chatID'");
$utente = 'spento';
}
$menu[] = menu('',true);
emt("<b>Cancellazione Comandi</b>
Quali comandi devono essere cancellati?
<code>esempio: /ban,!ban</code>

<b>Admin:</b> $admin
<b>Utenti:</b> $utente", $menu);
}

//Bot
if($chatID < 0 && $start_with_command){
$cmd = $start_with_command[comand];
if(($c_admin == 'slash' || $c_admin == 'all') && $cmd == '/' && $isadmin)dm($chatID, $msgid);
if($c_admin == 'all' && ($cmd == '#' || $cmd == '!' || $cmd == '.') && $isadmin)dm($chatID, $msgid);
if(($c_utente == 'slash' || $c_utente == 'all') && $cmd == '/' && !$isadmin)dm($chatID, $msgid);
if($_utente == 'all' && ($cmd == '#' || $cmd == '!' || $cmd == '.') && !$isadmin)dm($chatID, $msgid);
}



#--------------

if($cbdata == 'silenzio'){
if($silenziostato == '1'){
$tasto = 'Disattiva';
$stato = 'Attivo';
}else{
$tasto = 'Attiva';
$stato = 'Spento';
}
$menu[] = menu("{ $tasto | silenziostato$silenziostato}",true);
emt("<b>Silenzio Globale</b>
Cancella i messaggi degli utenti a modalità attiva
<b>Stato:</b> $stato",$menu);
}

if(substr($cbdata,0,13)=='silenziostato'){
$cbdata = str_replace('silenziostato','',$cbdata);
if($cbdata == '1'){
$tasto = 'Attiva';
$stato = 'Spento';
update($gtab, "set silenziostato='0' where chat_id='$chatID'");
}else{
$tasto = 'Disattiva';
$stato = 'Attivo';
update($gtab, "set silenziostato='1' where chat_id='$chatID'");
}
$menu[] = menu("{ $tasto | silenziostato$scbdata}",true);
emt("<b>Silenzio Globale</b>
Cancella i messaggi degli utenti a modalità attiva
<b>Stato:</b> $stato",$menu);
}

if($silenziostato && !$isadmin && $ismedia)dm($chatID, $msgid);




#--------------

if($cbdata == 'servizio'){
$menu[] = menu('{Entrata | centratainfo}{Acceso | centrataon}{Spento | centratoff}');
$menu[] = menu('{Uscita | cuscitainfo}{Acceso | cuscitaon}{Spento cuscitaoff}');
$menu[] = menu('{Pin | cpininfo}{Acceso | cpinon}{Spento | cpinoff}');
$menu[] = menu('{ProPic | cpropicinfo}{Acceso | cpropicon}{Spento | cpropicoff}');
$menu[] = menu('{Titolo | ctitleinfo}{Acceso | ctitleon}{Spento | ctitleoff}',true);
if($entrata)$e = 'Attivo'; else $e = 'Spento';
if($uscita)$u = 'Attivo'; else $u = 'Spento';
if($pin)$f = 'Attivo'; else $f = 'Spento';
if($propic)$p = 'Attivo'; else $p = 'Spento';
if($ctitle)$t = 'Attivo'; else $t = 'Spento';
emt("<b>Messaggi di Servizio</b>
Scegli che messaggi di servizio cancellare
Entrata <code>$e</code>
Uscita <code>$u</code>
Fissato <code>$f</code>
ProPic <code>$p</code>
Titolo <code>$t</code>",$menu);
}

if(substr($msg,0,8)=='centrata'){
$cbdata = str_replace('centrata','',$cbdata);
if($cbdata == 'info')cb_reply('Cancella le notifiche di entrata di un utente',true);
elseif($cbdata == 'on'){
$stato = 'Attivo';
update($gtab, "set centrata='1' where chat_id='$chatID'");
}elseif($cbdata == 'off'){
$stato = 'Spento';
update($gtab,"set centrata='0' where chat_id='$chatID'");
}
if($uscita)$u = 'Attivo'; else $u = 'Spento';
if($pin)$f = 'Attivo'; else $f = 'Spento';
if($propic)$p = 'Attivo'; else $p = 'Spento';
if($ctitle)$t = 'Attivo'; else $t = 'Spento';
emt("<b>Messaggi di Servizio</b>
Scegli che messaggi di servizio cancellare
Entrata <code>$stato</code>
Uscita <code>$u</code>
Fissato <code>$f</code>
ProPic <code>$p</code>
Titolo <code>$t</code>",$menu);
}


if(substr($msg,0,7)=='cuscita'){
$cbdata = str_replace('cuscita','',$cbdata);
if($cbdata == 'info')cb_reply('Cancella le notifiche di uscita di un utente',true);
elseif($cbdata == 'on'){
$stato = 'Attivo';
update($gtab, "set cuscita='1' where chat_id='$chatID'");
}elseif($cbdata == 'off'){
$stato = 'Spento';
update($gtab,"set cuscita='0' where chat_id='$chatID'");
}
if($entrata)$e = 'Attivo'; else $e = 'Spento';
if($pin)$f = 'Attivo'; else $f = 'Spento';
if($propic)$p = 'Attivo'; else $p = 'Spento';
if($ctitle)$t = 'Attivo'; else $t = 'Spento';
emt("<b>Messaggi di Servizio</b>
Scegli che messaggi di servizio cancellare
Entrata <code>$e</code>
Uscita <code>$stato</code>
Fissato <code>$f</code>
ProPic <code>$p</code>
Titolo <code>$t</code>",$menu);
}

if(substr($msg,0,4)=='cpin'){
$cbdata = str_replace('cpin','',$cbdata);
if($cbdata == 'info')cb_reply('Cancella la notifica del messaggio fissato',true);
elseif($cbdata == 'on'){
$stato = 'Attivo';
update($gtab, "set cpin='1' where chat_id='$chatID'");
}elseif($cbdata == 'off'){
$stato = 'Spento';
update($gtab,"set cpin='0' where chat_id='$chatID'");
}
if($entrata)$e = 'Attivo'; else $e = 'Spento';
if($uscita)$u = 'Attivo'; else $u = 'Spento';
if($propic)$p = 'Attivo'; else $p = 'Spento';
if($ctitle)$t = 'Attivo'; else $t = 'Spento';
emt("<b>Messaggi di Servizio</b>
Scegli che messaggi di servizio cancellare
Entrata <code>$e</code>
Uscita <code>$u</code>
Fissato <code>$stato</code>
ProPic <code>$p</code>
Titolo <code>$t</code>",$menu);
}

if(substr($msg,0,7)=='cpropic'){
$cbdata = str_replace('cpropic','',$cbdata);
if($cbdata == 'info')cb_reply('Cancella la notifica di cambio foto',true);
elseif($cbdata == 'on'){
$stato = 'Attivo';
update($gtab, "set cpropic='1' where chat_id='$chatID'");
}elseif($cbdata == 'off'){
$stato = 'Spento';
update($gtab,"set cpropic='0' where chat_id='$chatID'");
}
if($entrata)$e = 'Attivo'; else $e = 'Spento';
if($uscita)$u = 'Attivo'; else $u = 'Spento';
if($pin)$f = 'Attivo'; else $f = 'Spento';
if($ctitle)$t = 'Attivo'; else $t = 'Spento';
emt("<b>Messaggi di Servizio</b>
Scegli che messaggi di servizio cancellare
Entrata <code>$e</code>
Uscita <code>$u</code>
Fissato <code>$f</code>
ProPic <code>$stato</code>
Titolo <code>$t</code>",$menu);
}

if(substr($msg,0,6)=='ctitle'){
$cbdata = str_replace('ctitle','',$cbdata);
if($cbdata == 'info')cb_reply('Cancella la notifica di cambio titolo',true);
elseif($cbdata == 'on'){
$stato = 'Attivo';
update($gtab, "set ctitle='1' where chat_id='$chatID'");
}elseif($cbdata == 'off'){
$stato = 'Spento';
update($gtab,"set ctitle='0' where chat_id='$chatID'");
}
if($entrata)$e = 'Attivo'; else $e = 'Spento';
if($uscita)$u = 'Attivo'; else $u = 'Spento';
if($pin)$f = 'Attivo'; else $f = 'Spento';
if($propic)$p = 'Attivo'; else $p = 'Spento';
emt("<b>Messaggi di Servizio</b>
Scegli che messaggi di servizio cancellare
Entrata <code>$e</code>
Uscita <code>$u</code>
Fissato <code>$f</code>
ProPic <code>$p</code>
Titolo <code>$stato</code>",$menu);
}

if($update[message][new_chat_member] && $entrata)dm($chatID, $msgid);
if($update[message][left_chat_member] && $uscita)dm($chatID, $msgid);
if($update[message][pinned_message] && $pin)dm($chatID, $msgid);
