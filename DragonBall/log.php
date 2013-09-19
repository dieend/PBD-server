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
if (isset($_REQUEST['wifi']))
{
	$param['wifi'] = $_REQUEST['wifi'];
}
if (isset($_REQUEST['bssid']))
{
	$param['bssid'] = $_REQUEST['bssid'];
}
if (isset($_REQUEST['file']))
{
	$param['file'] = 'true';
}

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
	$values .= ',NULL';
}

// LOG RESPONSE
if (isset($response_data) && $response_data!=='') {
	$table_name .= ", `response`";
	$values .= ',"'.addslashes($response_data).'"';
} else {
	$table_name .= ", `response`";
	$values .= ',NULL';
}

// LOG IP_ADDRESS
$table_name .= ", `ip_address`";
$values .= ',"'.$_SERVER['REMOTE_ADDR'].'"';
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$table_name .= ", `ip_address_forwarded`";
	$values .= ',"'.$_SERVER['HTTP_X_FORWARDED_FOR'].'"';
} else {
	$table_name .= ", `ip_address_forwarded`";
	$values .= ',NULL';
}

$sql = 'INSERT INTO `log` ('.$table_name.') VALUES ('.$values.')';
$exec = $dbh->exec($sql);
