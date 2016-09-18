<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	$number = strip_tags(trim($_GET['number']));
	$password = md5(strip_tags(trim($_GET['password'])));
	$mode = strip_tags(trim($_GET['type']));
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if($mode == 1){
			$query = $db->prepare("update permanent_users set password='$password' where mobile_number='$number'");
			$query->execute();
		}
		else if($mode == 2){
			$query = $db->prepare("update permanent_vendors set password='$password' where mobile_number='$number'");
			$query->execute();
		}	
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>