<?php

if($cbdata == 'pammonizioni'){
if($warnpun == 'kick')$amm = 'Kick'; elseif($warnpun == 'ban') $amm = 'Ban';
if($warnmax == 5) $menu[] = menu("{- | pmom}{ $amm | pmoa}",true);
elseif($warnmax == 2) $menu[] = menu("{+ | pmop}{ $amm | pmoa}",true);
elseif($warnmax > 2 && $warnmax < 5) $menu[] = menu("{- | pmom}{+ | pmop}{ $amm | pmoa}",true);
emt("<b>Impostazioni Warn</b>
Warn Massimi: $warnmax
Punizione: $amm",$menu);
}

if(substr($cbdata,0,3)=='pmo'){
$cbdata = str_replace('pmo','',$cbdata);
if($cbdata == 'm'){
$now = $warnmax-1;
if($now > 1){
update($gtab, "set warn='$now' where chat_id='$chatID'");
$w = array('warn' => $now, 'pun' => $warnpun);
goto warn;
}elseif($now == 1)$w = array('warn' => 2, 'pun' => $warnpun, 'is_min' => true);

}elseif($cbdata == 'p'){
$now = $warnmax+1;
if($now < 6){
update($gtab, "set warn='$now' where chat_id='$chatID'");
$w = array('warn' => $now, 'pun' => $warnpun);
goto warn;
}elseif($now == 6) $w = array('warn' => 5, 'pun' => $warnpun, 'is_max' => true);
}elseif($cbdata == 'a'){
if($warnpun == 'kick')$now = 'ban'; else $now = 'kick';
$w = array('warn' => $warnmax, 'pun' => $now);
}
warn:
if($w[is_min]) $menu[] = menu("{+ | pmop}{ $amm | pmoa}",true);
elseif($w[is_max]) $menu[] = menu("{- | pmom}{ $amm | pmoa}",true);
elseif($w[warn] > 2 && $w[warn] < 5) $menu[] = menu("{- | pmom}{+ | pmop}{ $amm | pmoa}",true);
if($w[pun]== 'kick')$amm = 'Kick'; elseif($w[pun] == 'ban') $amm = 'Ban';
emt("<b>Impostazioni Warn</b>
Warn Massimi: $w[warn]
Punizione: $amm",$menu);
}

?>
