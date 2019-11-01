<?php

// menu("{testo | ah}{ciao | si}");

$pmenu[] = menu('{Blocco Entrate | blocentrate}');
$pmenu[] = menu('{Cancellazione Messaggi | cancmessaggi}');
$pmenu[] = menu('{Ammonizioni | pammonizioni}');

if($msg == '/impostazioni' && $isadmin){
sm("Scegli una delle impostazioni da modificare!",$pmenu);
}elseif($cbdata == 'pmenu' && $isadmin){
emt("Scegli una delle impostazioni da modificare!",$pmenu);
}

?>
