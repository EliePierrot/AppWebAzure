<?php

// Connection à la base
//$connection = mysqli_connect('kikimbappe','epierrot002','Lecumberry64');

$connection=new PDO( 'host=kikimbappe.mysql.database.azure.com;dbName=easytickets','epierrot002@kikimbappe','Lecumberry64');


if (!$connection){
	echo "Connection a mysql impossible";
	
}

// Connection à la base easytickets
$base = mysqli_select_db($connection, 'easytickets');
if (!$base){
	echo "Connection a la base impossible";
	
}



?>
