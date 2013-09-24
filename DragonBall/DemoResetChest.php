<?php
// File  		:	DemoResetChest.php
// Input 		: 	group_ids[]
// Created by 	:	Samuel C.
// Created date :	22 September 2013

require_once 'dragon_ball_config.php';
require_once 'autoload.php';
if (!isset($_POST['group_ids']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `group_ids` required';
	echo (json_encode($result));
	return;
}

$group_ids = explode(',',addslashes($_POST['group_ids']));

$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

$sql = 'SELECT group_id,ball_id FROM `group_ball` WHERE ';
$count = count($group_ids);
for ($i=0;$i<$count;$i++)
{
	$sql .= 'group_id="'.$group_ids[$i].'"';
	if ($i != $count - 1)
	{
		$sql .= " OR ";
	}
}
$sql .= ' ORDER BY group_id';
echo($sql);

// Get All Group Ball
$statement = $dbh->prepare($sql);
$statement->execute();
$group_balls = $statement->fetchAll(PDO::FETCH_ASSOC);
if (count($group_balls) == 0)
{
	$result['status'] = 'failed';
	$result['description'] = 'invalid group_ids';
	echo(json_encode($result));
	return;
}

// Get Ball Info
$sql = 'SELECT * FROM `ball_info`';
$statement = $dbh->prepare($sql);
$statement->execute();
$ball_info = $statement->fetchAll(PDO::FETCH_ASSOC);
$infoCount = count($ball_info);

$geotools = new \League\Geotools\Geotools();
$minDist = 50;
$count = count($group_balls);
for ($i = 0; $i < BALL_PER_GROUP; $i++)
{
	$isValid = false;
	while (!$isValid)
	{
		$isValid = true;
		$idx = mt_rand(0, $infoCount - 1);
		for ($j = 0; $j < $i && $isValid; $j++)
		{
			$coordA   = new \League\Geotools\Coordinate\Coordinate(array($ball_info[$idx]["latitude"], $ball_info[$idx]["longitude"]));
			$coordB = $balls_coord[$j];
			$distance = $geotools->distance()->setFrom($coordA)->setTo($coordB)->flat();
			if ($distance < $minDist)
			{
				$isValid = false;
			}
		}
	}
	$coord = new \League\Geotools\Coordinate\Coordinate(array($ball_info[$idx]["latitude"], $ball_info[$idx]["longitude"]));
	$balls_coord[$i] = $coord;
	
	$balls[$i]['latitude'] = $ball_info[$idx]["latitude"];
	$balls[$i]['longitude'] = $ball_info[$idx]["longitude"];
	$balls[$i]['bssid'] = $ball_info[$idx]["bssid"];
	$balls[$i]['wifi_signal'] = $ball_info[$idx]["wifi_signal"];
}

for ($i=0; $i < $count; $i += BALL_PER_GROUP)
{
	for ($j = 0; $j < BALL_PER_GROUP; $j++)
	{
		$sql = 'UPDATE `ball` SET latitude="'.$balls[$j]['latitude'].'",longitude="'.$balls[$j]['longitude'].'",bssid="'.$balls[$j]['bssid'].'",wifi_signal="'.$balls[$j]['wifi_signal'].'",validity="1" WHERE id="'.$group_balls[$i + $j]["ball_id"].'"';
		$exec = $dbh->exec($sql);
		if ($dbh->errorCode() != "0")
		{
			$result['status'] = 'failed';
			$result['description'] = 'database error';
			echo(json_encode($result));
			return;
		}
	}
}

if ($dbh->errorCode() == "0")
{
	var_dump($balls);
	$result['status'] = 'success';
	echo (json_encode($result));
}
else
{
	$result['status'] = 'failed';
	$result['description'] = 'database error';
	echo (json_encode($result));
	return;
}