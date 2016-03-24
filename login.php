<?php
require_once "connection.php";
session_start();

if (isset($_POST["login"]))
	{
	$login = $_POST ["login"];
	$pass = $_POST ["pass"];
		if ((trim ($login) == "") || (trim($pass)== ""))
			$message = "Login and password can't be blank!";
		else
		{
			$sql = "Select login, pass from RUser where login = '$login'";
			$result = mysql_query ($sql, $conn);
			if ($row = mysql_fetch_assoc($result))
			{
				if ($row["pass"]== $pass)
				{ //Login was sucessful. Saved the session.
					$_SESSION["login"] = $login;
					//Redirect to the page that lists the registered vehicles 
					header ("location:listVehicle.php");
				}
				else $message = "ERROR password!";	
			}	
			else $message = "User not found!";
		}
	}
?>
<html>
<head>
	<title> Rental-Login  </title>
</head>
<body>
	<p> To login, enter your username and password. </p>
	<font color= "red"><?php if (isset($message)) echo $message; ?>
	</font>
	<form name= "flogin" method= "post" action ="login.php">
		<label> Login </label> <br>
		<input name = "login" type = "text" size="12" maxlength ="12" value=""> <br>
		<label> Password</label> <br>
		<input name = "pass" type = "password" size="12" maxlength ="12" value=""> <br>
		<input name = "op" type = "hidden" value= "login">
		<input type = "submit" value = "Send" />
	</form>
</body>
</html>
	