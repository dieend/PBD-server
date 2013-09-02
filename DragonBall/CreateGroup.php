<?php
// File  		:	CrateGroup.php
// Input 		: 	-
// Created by 	:	Samuel C.
// Created date :	28 agustus 2013

include ('dragon_ball_config.php');

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

$sql = 'INSERT INTO `group_ball` (group_id, ball_id) VALUES ("'.$group_id.'","'.$ball_id[0].'"),("'.$group_id.'","'.$ball_id[1].'"),("'.$group_id.'","'.$ball_id[2].'"),("'.$group_id.'","'.$ball_id[3].'"),("'.$group_id.'","'.$ball_id[4].'"),("'.$group_id.'","'.$ball_id[5].'"),("'.$group_id.'","'.$ball_id[6].'")';
$exec = $dbh->exec($sql);

if ($exec)
{
	for ($i = 0; $i < 7; $i++)
	{	
		$latitude = -6.887966 - (mt_rand (0, 500000) / 100000000);
		$longitude = 107.608593 + (mt_rand (0, 300000) / 100000000);
		$sql = 'INSERT INTO `ball` (id, latitude, longitude, validity) VALUES ("'.$ball_id[$i].'","'.$latitude.'","'.$longitude.'","1")';
		$exec = $dbh->exec($sql);
		if (!$exec)
		{
			$result['status'] = 'failed';
			$result['description'] = 'database error';
			echo (json_encode($result));
			return;
		}
	}

	$result['status'] = 'success';
	echo (json_encode($result));
}
else
{
	$result['status'] = 'failed';
	$result['description'] = 'database error';
	echo (json_encode($result));
}

?>