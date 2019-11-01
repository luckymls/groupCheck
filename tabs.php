<?php

function tab_exists($tab){
return mysql_fetch_assoc(mysql_query("select * from $tab where 1=1"));
}

if(!tab_exists('utenti_bot')){

mysql_query('CREATE TABLE utenti_bot (
n INT(100) AUTO_INCREMENT PRIMARY KEY,
user_id TEXT NOT NULL,
nome TEXT NOT NULL,
cognome TEXT NOT NULL,
username TEXT NOT NULL,
msg TEXT NOT NULL,
tempo TEXT NOT NULL,
ban TEXT NOT NULL,
avvio TEXT NOT NULL,
vip TEXT NOT NULL);');

}

if(!tab_exists('utenti_gruppi')){

mysql_query('CREATE TABLE utenti_gruppi (
n INT(100) AUTO_INCREMENT PRIMARY KEY,
chat_id TEXT NOT NULL,
user_id TEXT NOT NULL,
moderatore TEXT NOT NULL,
gestore TEXT NOT NULL,
libero TEXT NOT NULL,
mutato TEXT NOT NULL,
warn TEXT NOT NULL
);');
}


if(!tab_exists('gruppi')){

mysql_query('CREATE TABLE gruppi (
n INT(100) AUTO_INCREMENT PRIMARY KEY,
chat_id TEXT NOT NULL,
titolo TEXT NOT NULL,
username TEXT NOT NULL,
linka TEXT NOT NULL,
tipo TEXT NOT NULL,
msg TEXT NOT NULL,
ban TEXT NOT NULL,
silenziostato TEXT NOT NULL,
cancadmin TEXT NOT NULL,
cancutente TEXT NOT NULL,
centrata TEXT NOT NULL,
cuscita TEXT NOT NULL,
cpin TEXT NOT NULL,
cpropic TEXT NOT NULL,
ctitle TEXT NOT NULL,
blocutenti TEXT NOT NULL,
blocbot TEXT NOT NULL,
warn TEXT NOT NULL,
warnpun TEXT NOT NULL
);');
}

if(!tab_exists('admin')){

mysql_query('CREATE TABLE admin (
n INT(100) AUTO_INCREMENT PRIMARY KEY,
chat_id TEXT NOT NULL,
user_id TEXT NOT NULL,
status TEXT NOT NULL,
);');
}

if(!tab_exists('cloni')){

mysql_query('CREATE TABLE cloni (
n INT(100) AUTO_INCREMENT PRIMARY KEY,
user_id TEXT NOT NULL,
create_from TEXT NOT NULL,
create_in TEXT NOT NULL,
token TEXT NOT NULL,
username TEXT NOT NULL,
ban TEXT NOT NULL,
);');
}
