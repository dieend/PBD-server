<?php
// File  		:	CrateGroup.php
// Input 		: 	group_name
// Created by 	:	Samuel C.
// Created date :	28 agustus 2013
// Modified date:	2 September 2013
//					4 September 2013

require_once 'autoload.php';
include ('dragon_ball_config.php');

if (!isset($_POST['group_name']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `group_name` required';
	echo (json_encode($result));
	return;
}

$group_name = $_POST['group_name'];

$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

$date = date(DATE_RFC822);
$group_id = md5($date);
$ball_id[0] = md5($date.'q');
$ball_id[1] = md5($date.'w');
$ball_id[2] = md5($date.'e');
$ball_id[3] = md5($date.'r');
$ball_id[4] = md5($date.'t');
$ball_id[5] = md5($date.'y');
$ball_id[6] = md5($date.'u');

$sql = 'INSERT INTO `group` (id, group_name) VALUES ("'.$group_id.'","'.$group_name.'")';
$exec = $dbh->exec($sql);
if (!$exec)
{
	$result['status'] = 'failed';
	$result['description'] = 'database error';
	echo (json_encode($result));
	return;
}

$sql = 'INSERT INTO `group_ball` (group_id, ball_id) VALUES ("'.$group_id.'","'.$ball_id[0].'"),("'.$group_id.'","'.$ball_id[1].'"),("'.$group_id.'","'.$ball_id[2].'"),("'.$group_id.'","'.$ball_id[3].'"),("'.$group_id.'","'.$ball_id[4].'"),("'.$group_id.'","'.$ball_id[5].'"),("'.$group_id.'","'.$ball_id[6].'")';
$exec = $dbh->exec($sql);

if (!$exec)
{
	$result['status'] = 'failed';
	$result['description'] = 'database error';
	echo (json_encode($result));
	return;
}

$sql = 'SELECT * FROM `ball_info`';
$statement = $dbh->prepare($sql);
$statement->execute();
$ball_info = $statement->fetchAll(PDO::FETCH_ASSOC);
$infoCount = count($ball_info);
$geotools = new \League\Geotools\Geotools();
$minDist = 25;

for ($i = 0; $i < 7; $i++)
{
	// $isValid = false;
	// while (!$isValid)
	// {
		// $isValid = true;
		$idx = mt_rand(0, $infoCount);
		// for ($j = 0; $j < $i && $isValid; $j++)
		// {
			// $coordA   = new \League\Geotools\Coordinate\Coordinate(array($ball_info[$idx]["latitude"], $ball_info[$idx]["longitude"]));
			// $coorB = $ball_coord[$j];
			// $distance = $geotools->distance()->setFrom($coordA)->setTo($coordB)->flat();
			// if ($distance < $minDist)
			// {
				// isValid = false;
			// }			
		// }
	// }
	
	$sql = 'INSERT INTO `ball` (id, latitude, longitude, bssid, validity) VALUES ("'.$ball_id[$i].'","'.$ball_info[$idx]["latitude"].'","'.$ball_info[$idx]["longitude"].'","'.$ball_info[$idx]["bssid"].'","1")';
	$exec = $dbh->exec($sql);
	if (!$exec)
	{
		$result['status'] = 'failed';
		$result['description'] = 'database error';
		echo (json_encode($result));
		return;
	}
	// else
	// {
		// $coord = new \League\Geotools\Coordinate\Coordinate(array($ball_info[$idx]["latitude"], $ball_info[$idx]["longitude"]));
		// $ball_coord[$i] = $coord;
	// }
}

$result['status'] = 'success';
echo (json_encode($result));
?>