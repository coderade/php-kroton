<?php require_once "authentication.php"?>
<html>
<head>
	<title> List - Vehicles  </title>
</head>
<body>
	<p> Vehicle List </p>
	<a href = "vehicle.php"> New vehicle</a>
	<a href = "exit.php"> Exit </a>
	<br><br>
	<?php
	require_once "connection.php";
	
	$sql = "select id, name, type from vehicle order by name";
	$result = mysql_query ($sql, $conn);
	$lines = mysql_num_rows ($result);
	
	if ($lines < 1)
		echo "No records were found!";
	else
	{	?>
		<table width= "300" border ="1">
			<tr>
				<th> Code </th>
				<th> Name </th>
				<th> Type </th>
				<th> Open </th>
			</tr>
			<?php while ($row = mysql_fetch_assoc ($result))
			{	extract($row); ?>
			<tr>
				<td> <?php echo $id;?> </td>
				<td> <?php echo $name;?> </td>
				<td>
				<?php
					switch ($type)
					{
					case 1:
						echo "Basic";
						break;
					case 2:
						echo "Basic with optional";
						break;
					}
				?>
				</td>
				<td><a href="vehicle.php?op=open&id=<?php echo $id;?>"> Open</a> </td>
			</tr>
			<?php 
			}
			?>
		</table>
	<?php 
	} 
	?>

</body>
</html>