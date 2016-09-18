<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query2 = $db->prepare("update user_vendors set vendor_name=:surname, vendor_type=:type, vendor_number=:mobile_number, 
		vendor_location_category=:location_index where vendor_id=:id");
		$query2->bindParam(':id',$vendorId);
		$query2->bindParam(':surname',$surname);
		$query2->bindParam(':type',$type);
		$query2->bindParam(':mobile_number',$mobile_number);
		$query2->bindParam(':location_index',$location_index);
		
		$vendorId = strip_tags(trim($_GET['vendor_id']));	
		$surname = strip_tags(trim($_GET['surname']));	
		$type = strip_tags(trim($_GET['type']));	
		$mobile_number = strip_tags(trim($_GET['mobile_number']));	
		$email_address = strip_tags(trim($_GET['email_address']));	
		$location_index = strip_tags(trim($_GET['location_index']));
		
		$query2->execute();
		
		
		$query2 = $db->prepare("update permanent_vendors set vendor_name=:surname, vendor_type=:type, 
		mobile_number=:mobile_number, email_address=:email_address, location_index=:location_index where vendor_id=:id");
		
		$query2->bindParam(':id',$vendorId);
		$query2->bindParam(':surname',$surname);
		$query2->bindParam(':type',$type);
		$query2->bindParam(':mobile_number',$mobile_number);
		$query2->bindParam(':email_address',$email_address);
		$query2->bindParam(':location_index',$location_index);
		
		$vendorId = strip_tags(trim($_GET['vendor_id']));	
		$surname = strip_tags(trim($_GET['surname']));	
		$type = strip_tags(trim($_GET['type']));	
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