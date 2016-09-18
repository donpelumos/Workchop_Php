<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		$query2 = $db->prepare("update permanent_users set surname=:surname, firstname=:firstname, mobile_number=:mobile_number, email_address=:email_address,
		location_index=:location_index where user_id=:id");
		
		$query2->bindParam(':id',$userId);
		$query2->bindParam(':surname',$surname);
		$query2->bindParam(':firstname',$firstname);
		$query2->bindParam(':mobile_number',$mobile_number);
		$query2->bindParam(':email_address',$email_address);
		$query2->bindParam(':location_index',$location_index);
		
		$userId = strip_tags(trim($_GET['user_id']));	
		$surname = strip_tags(trim($_GET['surname']));	
		$firstname = strip_tags(trim($_GET['firstname']));	
		$mobile_number = strip_tags(trim($_GET['mobile_number']));	
		$email_address = strip_tags(trim($_GET['email_address']));	
		$location_index = strip_tags(trim($_GET['location_index']));	
		
		$query2->execute();
		echo "done";
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>