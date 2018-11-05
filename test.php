<?php
require_once 'Database.php';
require_once 'ProLang.php';
require_once 'util.php';

$database=new Database("pro_lang.txt");
$database->delete('4');
//$database->read();
//$database->add(new ProLang(3, "c++", "ぐぇん","12","12","5","12"));
