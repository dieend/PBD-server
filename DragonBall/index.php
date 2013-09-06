<?php

include ('dragon_ball_config.php');
$response_data = '';
function log_and_print($data) {
	if (LOG_RESPONSE) {
		$response_data .= $data;
	}
	echo $data;
}

if (!isset($_REQUEST['action']))
{
	$result['status'] = 'failed';
	$result['description'] = 'parameter `action` required';
	log_and_print (json_encode($result));
	return;
}

// do logging here, from where, requestnya apa
switch ($_REQUEST['action']) {
	case "reset":
		include ("ResetChest.php");
		break;
	case "retrieve":
		include ("RetrieveChestPosition.php");
		break;
	case "create":
		include ("CreateGroup.php");
		break;
	case "number":
		include ("GetUnachievedChestCount.php");
		break;
	case "acquire":
		include ("AchieveChest.php");
		break;
	default :
		$result['status'] = 'failed';
		$result['description'] = 'invalid action type';
		log_and_print (json_encode($result));
		return;
}
include ('log.php');