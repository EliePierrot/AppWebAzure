<?php

// Connection à la base
$connection = mysqli_connect('kikimbappe.mysql.database.azure.com','epierrot002@kikimbappe
','Lecumberry64');

if (!$connection){
	echo "Connection a mysql impossible";
	
}

// Connection à la base easytickets
$base = mysqli_select_db($connection, 'easytickets');
if (!$base){
	echo "Connection a la base impossible";
	
}



?>
