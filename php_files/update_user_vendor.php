<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query = $db->prepare("update user_vendors set vendor_name=:vendor_name, vendor_number=:vendor_number, vendor_location_category=:vendor_location_category 
		where vendor_id=:vendor_id");
		
		$query->bindParam(':vendor_id',$vendor_id);
		$query->bindParam(':vendor_name',$vendor_name);
		$query->bindParam(':vendor_number',$vendor_number);
		$query->bindParam(':vendor_location_category',$vendor_location_category);
		
		$vendor_id = strip_tags(trim($_GET['vendor_id'])); 
		$vendor_name = strip_tags(trim($_GET['vendor_name'])); 
		$vendor_number = strip_tags(trim($_GET['vendor_number'])); 
		$vendor_location_category = strip_tags(trim($_GET['vendor_location_category']));
		
		$query->execute();
		
		$query = $db->prepare("update permanent_vendors set vendor_name=:vendor_name, mobile_number=:vendor_number, location_index=:vendor_location_category 
		where vendor_id=:vendor_id");
		
		$query->bindParam(':vendor_id',$vendor_id);
		$query->bindParam(':vendor_name',$vendor_name);
		$query->bindParam(':vendor_number',$vendor_number);
		$query->bindParam(':vendor_location_category',$vendor_location_category);
		
		$vendor_id = strip_tags(trim($_GET['vendor_id'])); 
		$vendor_name = strip_tags(trim($_GET['vendor_name'])); 
		$vendor_number = strip_tags(trim($_GET['vendor_number'])); 
		$vendor_location_category = strip_tags(trim($_GET['vendor_location_category']));
		
		$query->execute();
		
		echo "done--".$user_id;
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>