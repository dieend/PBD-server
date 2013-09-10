<?php
// File  		:	GetUnachievedDragonBallCount.php
// Input 		: 	group_id
// Created by 	:	Samuel C.
// Created date :	28 agustus 2013

$isAmazing = AMAZING_MODE;

if (!isset($_GET['group_id']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `group_id` required';
	log_and_print (json_encode($result));
	return;
}

$group_id = $_GET['group_id'];

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
		log_and_print (json_encode($result));
		return;
	}

	$sql = 'SELECT COUNT(id) AS cid FROM `ball` WHERE (';
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
	$ball_count = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else
{
	$sql = 'SELECT COUNT(id) AS cid FROM `ball` WHERE validity=2';
	$statement = $dbh->prepare($sql);
	$statement->execute();
	$ball_count = $statement->fetchAll(PDO::FETCH_ASSOC);
}

$result['status'] = 'success';
if (isset($ball_count[0]))
$result['data'] = $ball_count[0]['cid'];
log_and_print (json_encode($result));
?>