<?php
$dbase='televoto';
$servidor='localhost';
$usuario='agi';
$pass='palosanto';
$link = mysql_connect($servidor,$usuario,$pass) or die("DB Connection Error");
mysql_select_db($dbase) or die(mysqlerror()."Error: Cannot open database");
?>
