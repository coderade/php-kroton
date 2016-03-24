<?php 
require_once "authentication.php";
require_once "connection.php";

$op = "new";
	if (isset($_GET["op"]))
	{
		$op = "open";
	}
	elseif (isset ($_POST["op"]))
	{
		$op = $_POST["op"];
	}
	
	if (isset($_POST["delete"])) 
	{
		$id = $_POST ["id"];
		$sql = "delete from vehicle where id = $id";
		$result = mysql_query ($sql, $conn);
		
		if ($result)
		{
			header ("location: listVehicle.php");
			exit;
		}
		else $message = "Wasn't possible to delete.";
	}
	else 
	{
		if ($op== "new")
		{
			$op== "register";
			$name = "";
			$type = 1;
		}
		
		elseif ($op== "register")
		{
			$name= trim ($S_POST["name"]);
			$type= $_POST["type"];
			if ($name="")
			{
				$message ="The name can't be blank!";
			}
			else
			{
				$sql = "insert into vehicle (name,type) values ('$name', '$type')";
				$result = mysql_query ($sql, $conn);
				if($result)
				{		
					header ("location:listVehicle.php");
				}
				else $message= "Wasn't possible to register. Check the data!";
			}
		}
		elseif ($op= "open")
		{
			$op = "update";
			$id = $_GET["id"];
			$sql = "select name, type from vehicle where id = $id";
			$result = mysql_query ($sql, $conn);
			$row = mysql_fetch_assoc($result);
			extract ($row); // The table name field is extracted to the variable $name.
		}
		elseif($op = "update")
		{
			$id = $_POST ["id"];
			$name = trim ($_POST["name"]);
			$type = $_POST ["type"];
			if ($name == "")
			{
			$message = "The name can't be blank!";
			}
			else
			{
			$sql = "update vehicle set name = '$name', type= $type ";
			$result =mysql_query ($sql, $conn);
				if($result)
				{
				header ("location: listVehicle.php")	;
				}
				else $message = "Wans't possible to update. check the data!";
			}
		}
	}
?>

<html>
<head>
	<title> Register - Vehicles</title>
</head>
<body>
	<p> Vehicle Register </p>
	<font color= "red"> <?php if (isset ($message)) echo $message;?> </font>
	<form name= "fvehicle" method= "post" action= "vehicle.php">
		<label> Name </label> <br>
		<input name="name" type= "text" value="<?php echo $name; ?>" size= "45" maxlength= "45"> <br>
		<label> Type </label> <br>
		<select name= "type" size=1>
			<option value="1" <?php if ($type==1) echo " selected"; ?>> Basic </option>
			<option value="2" <?php if ($type==2) echo " selected"; ?>> Basic with optionals </option>
		</select><br>
			<?php if ($op != "register" )
		{ 	?>
				<input type="checkbox" name="delete" value= "delete"> Delete <br>
			<?php 
		} 	?>
			<?php if ($op == "update" )
		{ 	?>
				<input type = "hidden" name="id" value="<?php echo $id?>">
			<?php
		}	?>
				<input type = "hidden" name="op" value="<?php echo $op?>">
				<input type = "submit" value= "send">
				<a href="javascript:void(null);"
			onclick="location.href='listVehicle.php';"> Back </a>
				
		</form>
</body>
</html>