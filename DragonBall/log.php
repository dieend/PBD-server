<?php
// File  		:	log.php
// Created by 	:	Samuel C.
// Created date :	2 September 2013

$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

$sql = 'INSERT INTO `log` (`action`) VALUES ("'.$_REQUEST['action'].'")';
$exec = $dbh->exec($sql);
?>