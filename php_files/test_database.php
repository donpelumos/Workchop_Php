<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$username = 'workchop_admin';
	$password = 'workchop_12345';
	
	
	try {
		$db = new PDO($database, $username, $password); // also allows an extra parameter of configuration				
		echo("1");		
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>