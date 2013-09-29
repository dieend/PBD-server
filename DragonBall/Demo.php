<?php
	include "dragon_ball_config.php";
	
	$dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
	$sql = 'SELECT id,group_name FROM `group` WHERE 1';

	// Get All Group Name
	$statement = $dbh->prepare($sql);
	$statement->execute();
	$groups = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head>
	<title>=== Demo PBD ===</title>
</head>
<body>
	<h1>=== Demo PBD ===</h1>
	<?php
		for ($i = 0; $i < 7; $i++)
		{
			echo('<select id="group'.$i.'" style="width : 100%;  margin-bottom : 9px;">');
			echo('<option value="NULLPOINTEREXCEPTION">None</option>');
			for ($j = 0; $j < count($groups); $j++)
			{
				echo('<option value="'.$groups[$j]['id'].'">'.$groups[$j]['group_name'].'</option>');
			}
			echo('</select><br/>');
		}
	?>
	<form id="group_form" hidden method="post" action="DemoResetChest.php">
		<input id="group_ids" type="text" name="group_ids"/>
	</form>
	<button style="float : right; width : 100px; height : 35px; margin : 10px;" onclick="submit_gan()">Submit</button>
<body>
<script>
function submit_gan()
{	
	var data = "";
	for (var i = 0; i < 7; i++)
	{
		var e = document.getElementById("group" + i)
		if (e.options[e.selectedIndex].value != "NULLPOINTEREXCEPTION")
		{
			data += e.options[e.selectedIndex].value + ",";
		}
	}
	data = data.substring(0,data.length - 1);
	
	if (data)
	{
		document.getElementById("group_ids").value = data;
		document.getElementById("group_form").submit();		
	}
	else
	{
		alert("Please select at least one group name!");
	}
}
</script>
</html>