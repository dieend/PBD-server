<?php
// File  		:	AchieveChest.php
// Input 		: 	chest_id, latitude, longitude
// Created by 	:	Samuel C.
// Created date :	31 agustus 2013

include ('dragon_ball_config.php');

if (!isset($_POST['chest_id']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `chest_id` required';
	echo (json_encode($result));
	return;
}
if (!isset($_POST['latitude']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `latitude` required';
	echo (json_encode($result));
	return;
}
if (!isset($_POST['longitude']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `longitude` required';
	echo (json_encode($result));
	return;
}

$ball_id = $_POST['chest_id'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

$sql = 'SELECT * FROM `ball` WHERE id="'.$ball_id.'"';
$statement = $dbh->prepare($sql);
$statement->execute();
$ball = $statement->fetchAll(PDO::FETCH_ASSOC);
if (count($ball) == 0)
{
	$result['status'] = 'failed';
	$result['description'] = 'invalid ball_id';
	echo (json_encode($result));
	return;
} 

$latitudeTarget = $ball[0]['latitude'];
$longitudeTarget = $ball[0]['longitude'];

$earthRadius = 3958.75;
$dLat = deg2rad($latitudeTarget - $latitude);
$dLng = deg2rad($longitudeTarget - $longitude);
$a = sin($dLat/2) * sin($dLat/2) + 
	cos(deg2rad($latitude)) * cos(deg2rad($latitudeTarget)) * 
	sin($dLng/2) *sin($dLng/2);
$c = 2 * atan2(sqrt($a), sqrt(1-$a));
$mileDist = $earthRadius * $c;

$meterConversion = 1609;
$dist = $mileDist * $meterConversion;

$minDist = 25;
if ($dist < $minDist)
{
	$sql = 'UPDATE `ball` SET validity="0" WHERE id="'.$ball_id.'"';
	$exec = $dbh->exec($sql);

	if ($exec)
	{
		$result['status'] = 'success';
		echo (json_encode($result));
	}
	else
	{
		$result['status'] = 'failed';
		$result['description'] = 'chest already acquired';
		echo (json_encode($result));
	}
}
else
{
	$result['status'] = 'failed';
	$result['description'] = 'chest not in a valid range';
	echo (json_encode($result));
}
?>