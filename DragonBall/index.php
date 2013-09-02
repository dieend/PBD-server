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
		include ('log.php');
		include ("ResetChest.php");
		break;
	case "retrieve":
		include ('log.php');
		include ("RetrieveChestPosition.php");
		break;
	case "create":
		include ('log.php');
		include ("CreateGroup.php");
		break;
	case "number":
		include ('log.php');
		include ("GetUnachievedChestCount.php");
		break;
	case "acquire":
		include ('log.php');
		include ("AchieveChest.php");
		break;
	default :
		$result['status'] = 'failed';
		$result['description'] = 'invalid action type';
		echo (json_encode($result));
		break;		
}
