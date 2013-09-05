<?php
// File  		:	AchieveChest.php
// Input 		: 	group_id, file, bssid
// Created by 	:	Samuel C.
// Created date :	31 Agustus 2013
// Modified date:	4 September 2013
//					5 September 2013

require_once 'autoload.php';
include ('dragon_ball_config.php');
include ('config_reader.php');

$isAmazing = read_amazing();

if (!isset($_POST['group_id']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `group_id` required';
	echo (json_encode($result));
	return;
}
if (!isset($_POST['chest_id']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `chest_id` required';
	echo (json_encode($result));
	return;
}
if (!isset($_POST['bssid']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `bssid` required';
	echo (json_encode($result));
	return;
}
if (!isset($_POST['wifi']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `wifi` required';
	echo (json_encode($result));
	return;
}
if (!isset($_FILES['file']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `file` required';
	echo (json_encode($result));
	return;
}

$group_id = $_POST['group_id'];
$ball_id = $_POST['chest_id'];
$bssid = $_POST['bssid'];
$wifi = $_POST['wifi'];

if (intval($wifi) < 10)
{
	$result['status'] = 'failed';
	$result['description'] = 'wifi signal too low';
	echo (json_encode($result));
	return;
}

$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

// Retrieve Ball from DB
$sql = 'SELECT * FROM `ball` WHERE id="'.$ball_id.'" AND bssid="'.$bssid.'"';
$statement = $dbh->prepare($sql);
$statement->execute();
$ball = $statement->fetchAll(PDO::FETCH_ASSOC);
if (count($ball) == 0)
{
	$result['status'] = 'failed';
	$result['description'] = 'invalid `chest_id` or `bssid`';
	echo (json_encode($result));
	return;
}
else if ($isAmazing)
{
	if ($ball[0]['validity'] != 2)
	{
		$result['status'] = 'failed';
		$result['description'] = 'invalid amazing race `chest_id`';
		echo (json_encode($result));
		return;
	}
}

$latitudeTarget = $ball[0]['latitude'];
$longitudeTarget = $ball[0]['longitude'];

// Get Formatted Coordinate String
$exif = exif_read_data($_FILES['file']['tmp_name']);

if (!isset($exif['GPSLatitude']) || !isset($exif['GPSLongitude']))
{
	$result['status'] = 'failed';
	$result['description'] = 'no geotag data found';
	echo (json_encode($result));
	return;
}
$degree = explode('/',$exif['GPSLatitude'][0]);
$degree = $degree[0] / $degree[1];
$minute = explode('/',$exif['GPSLatitude'][1]);
$minute = $minute[0] / $minute[1];
$second = explode('/',$exif['GPSLatitude'][2]);
$second = $second[0] / $second[1];
if ($degree > 0) { 
	$direction = 'N'; }
else { 
	$direction = 'S'; 
	$degree = abs($degree);
}
$latitude = $degree.'°'.$minute.'\''.$second.'"'.$direction;

$degree = explode('/',$exif['GPSLongitude'][0]);
$degree = $degree[0] / $degree[1];
$minute = explode('/',$exif['GPSLongitude'][1]);
$minute = $minute[0] / $minute[1];
$second = explode('/',$exif['GPSLongitude'][2]);
$second = $second[0] / $second[1];
if ($degree > 0) { 
	$direction = 'E'; }
else { 
	$direction = 'W'; 
	$degree = abs($degree);
}
$longitude = $degree.'°'.$minute.'\''.$second.'"'.$direction;
$sourceCoord = $latitude.', '.$longitude;

// Count Distance
$geotools = new \League\Geotools\Geotools();
$coordA   = new \League\Geotools\Coordinate\Coordinate($sourceCoord);
$coordB   = new \League\Geotools\Coordinate\Coordinate(array($latitudeTarget, $longitudeTarget));
$distance = $geotools->distance()->setFrom($coordA)->setTo($coordB)->flat();

$minDist = 25;
if ($distance < $minDist)
{
	$sql = 'UPDATE `ball` SET validity="0" WHERE id="'.$ball_id.'"';
	$exec = $dbh->exec($sql);

	if ($exec)
	{
		if ($isAmazing)
		{
			$sql = 'UPDATE `group` SET `achieved_ball_count` = `achieved_ball_count` + 1 WHERE id="'.$group_id.'"';
			$exec = $dbh->exec($sql);
			
			if ($exec)
			{
				$result['status'] = 'success';
				echo (json_encode($result));
			}
			else
			{
				$sql = 'UPDATE `ball` SET validity="2" WHERE id="'.$ball_id.'"';
				$dbh->exec($sql);
	
				$result['status'] = 'failed';
				$result['description'] = 'invalid `group_id`';
				echo (json_encode($result));
				return;
			}
		}
		else
		{
			$result['status'] = 'success';
			echo (json_encode($result));
		}
	}
	else
	{
		$result['status'] = 'failed';
		$result['description'] = 'chest already acquired';
		echo (json_encode($result));
		return;
	}
}
else
{
	$result['status'] = 'failed';
	$result['description'] = 'chest not in a valid range';
	echo (json_encode($result));
	return;
}
?>