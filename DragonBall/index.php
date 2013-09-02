<?php

include ('dragon_ball_config.php');

if (!isset($_REQUEST['action']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `action` required';
	echo (json_encode($result));
	return;
}
// do logging here, from where, requestnya apa

switch ($_REQUEST['action']) {
	case "reset":
		include ("ResetDragonBall.php");
		break;
	case "retrieve":
		include ("RetrieveDragonBallPosition.php");
		break;
	case "create":
		include ("CreateGroup.php");
		break;
	case "number":
		include ("GetUnachievedDragonBallCount.php");
		break;
	case "acquire":
		include ("AchieveDragonBall.php");
		break;
}
