<?php
// File  		:	RetrieveChest.phpPosition.php
// Input 		: 	group_id
// Created by 	:	Samuel C.
// Created date :	28 agustus 2013

include ('dragon_ball_config.php');

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

$sql = 'SELECT id,latitude,longitude,bssid FROM `ball` WHERE (';
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

$count = count($balls);
for ($i = 0; $i < $count; $i++)
{
	$balls_converted[$i]['id'] = $balls[$i]['id'];
	$balls_converted[$i]['bssid'] = $balls[$i]['bssid'];

	$latitudeTarget = $balls[$i]['latitude'];
	$longitudeTarget = $balls[$i]['longitude'];
	
	$earthRadius = 3958.75;
	$dLat = deg2rad($latitudeTarget - $latitude);
	$dLng = deg2rad($longitudeTarget - $longitude);

	$a = sin($dLat/2) * sin($dLat/2) + 
		cos(deg2rad($latitude)) * cos(deg2rad($latitudeTarget)) * 
		sin($dLng/2) *sin($dLng/2);
	$c = 2 * atan2(sqrt($a), sqrt(1-$a));
	$mileDist = $earthRadius * $c;	
	$meterConversion = 1609;
	$distance = $mileDist * $meterConversion;

	$a = sin(0) * sin(0) + 
		cos(deg2rad($latitude)) * cos(deg2rad($latitudeTarget)) * 
		sin($dLng/2) *sin($dLng/2);
	$HDist = 2 * atan2(sqrt($a), sqrt(1-$a));

	$a = sin($dLat/2) * sin($dLat/2) + 
		cos(deg2rad($latitude)) * cos(deg2rad($latitudeTarget)) * 
		sin(0) *sin(0);
	$c = 2 * atan2(sqrt($a), sqrt(1-$a));
	$mileDist = $earthRadius * $c;
	$meterConversion = 1609;
	$VDist = $mileDist * $meterConversion;
		
	$degree = rad2deg(atan2($VDist,$HDist));
		
	$balls_converted[$i]['distance'] = $distance;
	$balls_converted[$i]['degree'] = $degree;
}

$result['status'] = 'success';
$result['data'] = $balls_converted;
echo (json_encode($result));
?>