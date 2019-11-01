<?php

//Creare variabile $impostazioni $impostazioni => privata, => gruppo {privata{'mutato' => true, 'libero' => false},gruppo{'antispam'{status => on, 'link' => 't.me'}}


function status($user, $chat){global $atab; return mysql_fetch_assoc(mysql_query("select * from $atab where user_id='$user' and chat_id='$chat'"))[status];}
function moderatore($user, $chat){global $utab; return mysql_fetch_assoc(mysql_query("select * from $utab where user_id='$user' and chat_id='$chat'"))[moderatore]; }
function gestore($user, $chat){global $utab; return mysql_fetch_assoc(mysql_query("select * from $utab where user_id='$user' and chat_id='$chat'"))[gestore]; }
function libero($user, $chat){global $utab; return mysql_fetch_assoc(mysql_query("select * from $utab where user_id='$user' and chat_id='$chat'"))[libero]; }
function warn($user, $chat){global $utab; return mysql_fetch_assoc(mysql_query("select * from $utab where user_id='$user' and chat_id='$chat'"))[warn];}
///Grp
function cancadmin(){global $gtab,$chatID; return mysql_fetch_assoc(mysql_query("select * from $gtab where chat_id='$chatID'"))[cancadmin];}
function cancutente(){global $gtab,$chatID; return mysql_fetch_assoc(mysql_query("select * from $gtab where chat_id='$chatID'"))[cancutente];}
function silenziostato(){global $gtab,$chatID; return mysql_fetch_assoc(mysql_query("select * from $gtab where chat_id='$chatID'"))[silenziostato];}
function centrata(){global $gtab,$chatID; return mysql_fetch_assoc(mysql_query("select * from $gtab where chat_id='$chatID'"))[centrata];}
function cuscita(){global $gtab,$chatID; return mysql_fetch_assoc(mysql_query("select * from $gtab where chat_id='$chatID'"))[cuscita];}
function cpin(){global $gtab,$chatID; return mysql_fetch_assoc(mysql_query("select * from $gtab where chat_id='$chatID'"))[cpin];}
function cpropic(){global $gtab,$chatID; return mysql_fetch_assoc(mysql_query("select * from $gtab where chat_id='$chatID'"))[cpropic];}
function ctitle(){global $gtab,$chatID; return mysql_fetch_assoc(mysql_query("select * from $gtab where chat_id='$chatID'"))[ctitle];}
function butenti(){global $gtab,$chatID; return mysql_fetch_assoc(mysql_query("select * from $gtab where chat_id='$chatID'"))[blocutenti];}
function bbot(){global $gtab,$chatID; return mysql_fetch_assoc(mysql_query("select * from $gtab where chat_id='$chatID'"))[blocbot];}
function warnmax(){global $gtab, $chatID; return mysql_fetch_assoc(mysql_query("select * from $gtab where chat_id='$chatID'"))[warn];}
function warnpun(){global $gtab, $chatID; return mysql_fetch_assoc(mysql_query("select * from $gtab where chat_id='$chatID'"))[warnpun];}

//Impostazioni riguardanti i gruppi

if($chatID < 0){
#Prv
$impostazioni = array(
'prv' => array(
  'status' => status($userID, $chatID),
  'moderatore' => moderatore($userID, $chatID),
  'gestore' => gestore($userID, $chatID),
  'libero' => libero($userID, $chatID),
  'warn' => warn($userID, $chatID)
),
'grp' => array(
  'canc' => array(
    'admin' => cancadmin(),
    'utente' => cancutente()
  ),
  'silenzio' => silenziostato(),
  'centrata' => centrata(),
  'cuscita' => cuscita(),
  'cpin' => cpin(),
  'cpropic' => cpropic(),
  'ctitle' => ctitle(),
  'blocco' => array(
    'utenti' => butenti(),
    'bot' => bbot()
  ),
  'warn' => warnmax(),
  'warnpun' => warnpun()
)
);

}
