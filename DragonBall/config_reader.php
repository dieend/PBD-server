<?php
function read_amazing()
{
	$file = fopen('296c91a3fe51ad54413124a99657144b.smc','r');
	if (!$file) 
	{
		$result['status'] = 'failed';
		$result['description'] = 'server configuration error';
		echo (json_encode($result));
		return;
	}

	fgets($file); // read first line
	$mode = fgets($file); // read first line

    fclose($file);
	
	return (intval($mode));
}
?>