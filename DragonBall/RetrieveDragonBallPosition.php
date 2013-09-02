<?php
// File  		:	RetrieveDragonBallPosition.php
// Input 		: 	group_id
// Created by 	:	Samuel C.
// Created date :	28 agustus 2013

if (!isset($_POST['group_id']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `group_id` required';
	echo (json_encode($result));
	return;
}

$group_id = $_POST['group_id'];

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

$result['status'] = 'success';
$result['data'] = $balls;
echo (json_encode($result));
