<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = mysql_connect ($dbhost, $dbuser, $dbpass)
		or die ('Sorry, it was not possible to connect!');
$dbname = 'rental';
mysql_select_db ($dbname);
?>
