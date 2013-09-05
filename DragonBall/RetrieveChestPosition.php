<?php
// File  		:	RetrieveChestPosition.php
// Input 		: 	group_id, latitude, longitude
// Created by 	:	Samuel C.
// Created date :	28 agustus 2013
// Modified date:	2 September 2013

require_once 'autoload.php';
include ('dragon_ball_config.php');
include ('config_reader.php');

$isAmazing = read_amazing();

if (!isset($_GET['group_id']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `group_id` required';
	echo (json_encode($result));
	return;
}
if (!isset($_GET['latitude']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `latitude` required';
	echo (json_encode($result));
	return;
}
if (!isset($_GET['longitude']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `longitude` required';
	echo (json_encode($result));
	return;
}

$group_id = $_GET['group_id'];
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];

$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

if (!$isAmazing)
{
	$sql = 'SELECT * FROM `group_ball` WHERE group_id="'.$group_id.'"';
	$statement = $dbh->prepare($sql);
	$statement->execute();
	$group = $statement->fetchAll(PDO::FETCH_ASSOC);
	if (count($group) == 0)
	{
		$result['status'] = 'failed';
		$result['description'] = 'invalid group_id';
		echo (json_encode($result));
		return;
	}

	$sql = 'SELECT id,latitude,longitude FROM `ball` WHERE (';
	$count = count($group);
	for ($i = 0; $i < $count; $i++)
	{
		$sql .= 'id="'.$group[$i]['ball_id'].'"';
		if ($i != $count - 1)
		{
			$sql .=  ' OR ';
		}
	}
	$sql .= ') AND validity="1"';
	$statement = $dbh->prepare($sql);
	$statement->execute();
	$balls = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else
{
	$sql = 'SELECT id,latitude,longitude FROM `ball` WHERE validity=2';
	$statement = $dbh->prepare($sql);
	$statement->execute();
	$balls = $statement->fetchAll(PDO::FETCH_ASSOC);
}

$count = count($balls);
$minDist = 50;
$j = 0;
$balls_converted = null;
for ($i = 0; $i < $count; $i++)
{
	$latitudeTarget = $balls[$i]['latitude'];
	$longitudeTarget = $balls[$i]['longitude'];

	$geotools = new \League\Geotools\Geotools();
	$coordA   = new \League\Geotools\Coordinate\Coordinate(array($latitude, $longitude));
	$coordB   = new \League\Geotools\Coordinate\Coordinate(array($latitudeTarget, $longitudeTarget));
	$distance = $geotools->distance()->setFrom($coordA)->setTo($coordB)->flat();
	if ($distance <= $minDist)
	{
		$degree = $geotools->point()->setFrom($coordA)->setTo($coordB)->initialBearing();
			
		$balls_converted[$j]['id'] = $balls[$i]['id'];
		$balls_converted[$j]['distance'] = $distance;
		$balls_converted[$j]['degree'] = $degree;
		$j++;
	}
}

$result['status'] = 'success';
$result['data'] = $balls_converted;
echo (json_encode($result));
?>