<?php
// File  		:	ResetChest.php
// Input 		: 	group_id
// Created by 	:	Samuel C.
// Created date :	28 agustus 2013
// Modified date:	2 September 2013

$isAmazing = AMAZING_MODE;

if ($isAmazing)
{
	$result['status'] = 'failed';
	$result['description'] = 'cannot reset chest in amazing race';
	log_and_print (json_encode($result));
	return;
}

if (!isset($_POST['group_id']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `group_id` required';
	log_and_print (json_encode($result));
	return;
}

$group_id = addslashes($_POST['group_id']);

$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);

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

$sql = 'UPDATE `ball` SET validity="1" WHERE ';
$count = count($group);
for ($i = 0; $i < $count; $i++)
{
	$sql .= 'id="'.$group[$i]['ball_id'].'"';
	if ($i != $count - 1)
	{
		$sql .=  ' OR ';
	}
}
$exec = $dbh->exec($sql);

if ($dbh->errorCode() == SQLITE_OK)
{
	$result['status'] = 'success';
	log_and_print (json_encode($result));
}
else
{
	$result['status'] = 'failed';
	$result['description'] = 'database error';
	log_and_print (json_encode($result));
	return;
}
?>