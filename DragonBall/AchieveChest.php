<?php
// File  		:	AchieveChest.php
// Input 		: 	group_id, file, bssid, wifi
// Created by 	:	Samuel C.
// Created date :	31 Agustus 2013
// Modified date:	4 September 2013
//					5 September 2013

require_once 'autoload.php';

$isAmazing = AMAZING_MODE;

if (!isset($_POST['group_id']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `group_id` required';
	log_and_print (json_encode($result));
	return;
}
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
if (!isset($_FILES['file']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `file` required';
	log_and_print (json_encode($result));
	return;
}

$group_id = addslashes($_POST['group_id']);
$ball_id = addslashes($_POST['chest_id']);
$bssid = $_POST['bssid'];
$wifi = $_POST['wifi'];

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
	echo (json_encode($result));
	return;
}
else if ($ball[0]['bssid'] != $bssid)
{
	$result['status'] = 'failed';
	$result['description'] = 'invalid `bssid`';
	echo (json_encode($result));
	return;
}
else if ($isAmazing)
{
	if ($ball[0]['validity'] < 2)
	{
		$result['status'] = 'failed';
		$result['description'] = 'invalid amazing race `chest_id`';
		log_and_print (json_encode($result));
		return;
	}
	
	$sql = 'SELECT * FROM `race_ball_achiever` WHERE ball_id="'.$ball_id.'" AND group_id="'.$group_id.'"';
	$statement = $dbh->prepare($sql);
	$statement->execute();
	$achieved_ball = $statement->fetchAll(PDO::FETCH_ASSOC);
	if (count($achieved_ball) != 0)
	{
		$result['status'] = 'failed';
		$result['description'] = 'chest already acquired';
		log_and_print (json_encode($result));
		return;
	}
}

// Check Wifi Signal
if ($wifi < $ball[0]['wifi_signal'] - WIFI_ERROR)
{
	$result['status'] = 'failed';
	$result['description'] = 'wifi signal too weak';
	echo (json_encode($result));
	return;
}
else if ($wifi > $ball[0]['wifi_signal'] + WIFI_ERROR)
{
	$result['status'] = 'failed';
	$result['description'] = 'wifi signal too strong';
	echo (json_encode($result));
	return;
}

// Get Ball Coordinate
$latitudeTarget = $ball[0]['latitude'];
$longitudeTarget = $ball[0]['longitude'];

// Get Formatted Coordinate String
$exif = exif_read_data($_FILES['file']['tmp_name']);

if (!isset($exif['GPSLatitude']) || !isset($exif['GPSLongitude']))
{
	$result['status'] = 'failed';
	$result['description'] = 'no geotag data found';
	log_and_print (json_encode($result));
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

$minDist = VALID_MINIMUM_ACHIEVE_DISTANCE;
if ($distance < $minDist)
{
	if ($isAmazing)
	{
		if ($ball[0]['validity'] > 2)
		{
			$validity = $ball[0]['validity'] - 1;
		}
		else
		{
			$validity = 0;
		}
		
		$sql = 'UPDATE `ball` SET validity='.$validity.' WHERE id="'.$ball_id.'"';
		$exec = $dbh->exec($sql);

		if ($exec)
		{
			$sql = 'UPDATE `group` SET `achieved_ball_count` = `achieved_ball_count` + 1 WHERE id="'.$group_id.'"';
			$exec = $dbh->exec($sql);
			
			if ($exec)
			{
				$sql = 'INSERT INTO `race_ball_achiever` (`ball_id`,`group_id`) VALUES ("'.$ball_id.'","'.$group_id.'")';
				$exec = $dbh->exec($sql);

				if ($exec)
				{
					$result['status'] = 'success';
					log_and_print (json_encode($result));
				}
				else
				{
					$sql = 'UPDATE `group` SET `achieved_ball_count` = `achieved_ball_count` - 1 WHERE id="'.$group_id.'"';
					$exec = $dbh->exec($sql);
				
					$sql = 'UPDATE `ball` SET validity="'.$ball[0]['validity'].'" WHERE id="'.$ball_id.'"';
					$dbh->exec($sql);

					$result['status'] = 'failed';
					$result['description'] = 'database error`';
					log_and_print (json_encode($result));
					return;
				}
			}
			else
			{
				$sql = 'UPDATE `ball` SET validity="2" WHERE id="'.$ball_id.'"';
				$dbh->exec($sql);

				$result['status'] = 'failed';
				$result['description'] = 'invalid `group_id`';
				log_and_print (json_encode($result));
				return;
			}
		}
		else
		{
			$result['status'] = 'failed';
			$result['description'] = 'no chest left on this place';
			log_and_print (json_encode($result));
			return;
		}
	}
	else
	{
		$sql = 'UPDATE `ball` SET validity="0" WHERE id="'.$ball_id.'"';
		$exec = $dbh->exec($sql);

		if ($exec)
		{
			$result['status'] = 'success';
			log_and_print (json_encode($result));
		}
		else
		{
			$result['status'] = 'failed';
			$result['description'] = 'chest already acquired';
			log_and_print (json_encode($result));
			return;
		}
	}
}
else
{
	$result['status'] = 'failed';
	$result['description'] = 'chest not in a valid range';
	log_and_print (json_encode($result));
	return;
}
?>