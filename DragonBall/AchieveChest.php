<?php
// File  		:	AchieveChest.php
// Input 		: 	chest_id, latitude, longitude
// Created by 	:	Samuel C.
// Created date :	31 agustus 2013

require_once 'autoload.php';
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

$geotools = new \League\Geotools\Geotools();
$coordA   = new \League\Geotools\Coordinate\Coordinate(array($latitude, $longitude));
$coordB   = new \League\Geotools\Coordinate\Coordinate(array($latitudeTarget, $longitudeTarget));
$distance = $geotools->distance()->setFrom($coordA)->setTo($coordB)->flat();

echo ($distance);
$minDist = 25;
if ($distance < $minDist)
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