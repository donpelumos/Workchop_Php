<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$userId = strip_tags(trim($_GET['user_id']));
		$query2 = $db->prepare("select count(user_id) from user_contacts where user_id='$userId'");	
		
		$query2->execute();
		$result2 = $query2->fetchAll();
		echo $result2[0][0];
		
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>