<?php
// File  		:	CrateGroup.php
// Input 		: 	group_name
// Created by 	:	Samuel C.
// Created date :	28 agustus 2013
// Modified date:	2 September 2013
//					4 September 2013

require_once 'autoload.php';

if (!isset($_POST['group_name']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `group_name` required';
	log_and_print (json_encode($result));
	return;
}

$group_name = $_POST['group_name'];

$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

$date = date(DATE_RFC822);
$group_id = md5($date);
for ($i = 0; $i < BALL_PER_GROUP; $i++) {
	$ball_id[$i] = md5($date.chr($i+64));
}

$sql = 'INSERT INTO `group` (id, group_name) VALUES ("'.$group_id.'","'.$group_name.'")';
$exec = $dbh->exec($sql);
if (!$exec)
{
	$result['status'] = 'failed';
	$result['description'] = 'database error';
	log_and_print (json_encode($result));
	return;
}
$sql = 'INSERT INTO `group_ball` (group_id, ball_id) VALUES ';
for ($i=0; $i<BALL_PER_GROUP; $i++) {
	if ($i>0) $sql .= ',';
	$sql .= '("'.$group_id.'","'.$ball_id[$i].'")';
}
$exec = $dbh->exec($sql);

if (!$exec)
{
	$result['status'] = 'failed';
	$result['description'] = 'database error';
	log_and_print (json_encode($result));
	return;
}

$sql = 'SELECT * FROM `ball_info`';
$statement = $dbh->prepare($sql);
$statement->execute();
$ball_info = $statement->fetchAll(PDO::FETCH_ASSOC);
$infoCount = count($ball_info);
$geotools = new \League\Geotools\Geotools();
$minDist = 25;

for ($i = 0; $i < BALL_PER_GROUP; $i++)
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
		log_and_print (json_encode($result));
		return;
	}
	// else
	// {
		// $coord = new \League\Geotools\Coordinate\Coordinate(array($ball_info[$idx]["latitude"], $ball_info[$idx]["longitude"]));
		// $ball_coord[$i] = $coord;
	// }
}

$result['status'] = 'success';
log_and_print (json_encode($result));
