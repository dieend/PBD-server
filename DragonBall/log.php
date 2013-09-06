<?php
// File  		:	log.php
// Created by 	:	Samuel C.
// Created date :	2 September 2013
// Modified date:	4 September 2013

if (isset($_REQUEST['group_id']))
{
	$param['group_id'] = $_REQUEST['group_id'];
}
if (isset($_REQUEST['group_name']))
{
	$param['group_name'] = $_REQUEST['group_name'];
}
if (isset($_REQUEST['chest_id']))
{
	$param['chest_id'] = $_REQUEST['chest_id'];
}
if (isset($_REQUEST['latitude']))
{
	$param['latitude'] = $_REQUEST['latitude'];
}
if (isset($_REQUEST['longitude']))
{
	$param['longitude'] = $_REQUEST['longitude'];
}

$ip_remote = $_SERVER['REMOTE_ADDR'];
isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $ip_forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'];

$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

// LOG ACTION
$table_name = "`action`";
$values = "\"$_REQUEST[action]\"";

// LOG PARAM
if (isset($param)) {
	$table_name .= ", `param`";
	$values .= ',"'.addslashes(json_encode($param)).'"';
} else {
	$table_name .= ", `param`";
	$values .= ',"'."NULL".'"';
}

// LOG RESPONSE
if (isset($response_data)) {
	$table_name .= ", `response`";
	$values .= ',"'.addslashes($response_data).'"';
}

if (isset($param))
{
	$sql = 'INSERT INTO `log` (`action`,`param`, `response`) VALUES ("'.$_REQUEST['action'].'","'.addslashes(json_encode($param)).'")';
}
else
{
	$sql = 'INSERT INTO `log` (`action`,`param`) VALUES ("'.$_REQUEST['action'].'",NULL)';
}
$exec = $dbh->exec($sql);
?>