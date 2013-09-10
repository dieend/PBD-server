<?php
// File  		:	CheckChest.php
// Input 		: 	chest_id, bssid, wifi, latitude, longitude 
// Created by 	:	Samuel C.
// Created date :	31 Agustus 2013
// Modified date:	4 September 2013
//					5 September 2013

require_once 'autoload.php';

$isAmazing = AMAZING_MODE;

if (!isset($_POST['chest_id']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `chest_id` required';
	log_and_print (json_encode($result));
	return;
}
if (!isset($_POST['bssid']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `bssid` required';
	log_and_print (json_encode($result));
	return;
}
if (!isset($_POST['wifi']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `wifi` required';
	log_and_print (json_encode($result));
	return;
}
if (!isset($_POST['latitude']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `latitude` required';
	log_and_print (json_encode($result));
	return;
}
if (!isset($_POST['longitude']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `longitude` required';
	log_and_print (json_encode($result));
	return;
}

$ball_id = $_POST['chest_id'];
$bssid = $_POST['bssid'];
$wifi = $_POST['wifi'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

// Retrieve Ball from DB
$sql = 'SELECT * FROM `ball` WHERE id="'.$ball_id.'"';
$statement = $dbh->prepare($sql);
$statement->execute();
$ball = $statement->fetchAll(PDO::FETCH_ASSOC);
if (count($ball) == 0)
{
	$result['status'] = 'failed';
	$result['description'] = 'invalid `chest_id`';
	log_and_print (json_encode($result));
	return;
}
else if ($ball[0]['bssid'] != $bssid)
{
	$result['status'] = 'failed';
	$result['description'] = 'invalid `bssid`';
	log_and_print (json_encode($result));
	return;
}
else if ($isAmazing)
{
	if ($ball[0]['validity'] != 2)
	{
		$result['status'] = 'failed';
		$result['description'] = 'invalid amazing race `chest_id`';
		log_and_print (json_encode($result));
		return;
	}
}

if ($wifi < $ball[0]['wifi_signal'] - WIFI_ERROR)
{
	$result['status'] = 'failed';
	$result['description'] = 'wifi signal too weak';
	log_and_print (json_encode($result));
	return;
}
else if ($wifi > $ball[0]['wifi_signal'] + WIFI_ERROR)
{
	$result['status'] = 'failed';
	$result['description'] = 'wifi signal too strong';
	log_and_print (json_encode($result));
	return;
}

$latitudeTarget = $ball[0]['latitude'];
$longitudeTarget = $ball[0]['longitude'];

// Count Distance
$geotools = new \League\Geotools\Geotools();
$coordA   = new \League\Geotools\Coordinate\Coordinate(array($latitude, $longitude));
$coordB   = new \League\Geotools\Coordinate\Coordinate(array($latitudeTarget, $longitudeTarget));
$distance = $geotools->distance()->setFrom($coordA)->setTo($coordB)->flat();

$minDist = VALID_MINIMUM_ACHIEVE_DISTANCE;
if ($distance < $minDist)
{
	$result['status'] = 'success';
	log_and_print (json_encode($result));
}
else
{
	$result['status'] = 'failed';
	$result['description'] = 'chest not in a valid range';
	log_and_print (json_encode($result));
	return;
}
?>