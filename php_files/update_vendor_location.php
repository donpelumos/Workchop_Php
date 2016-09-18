<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query = $db->prepare("update permanent_vendors set location_index=:location_index where vendor_id=:id");
		$query->bindParam(':id',$id);
		$query->bindParam(':location_index',$location_index);
		
		$id = strip_tags(trim($_GET['id']));
		$location_index = strip_tags(trim($_GET['location_index']));
		
		$query->execute();
		
		$query = $db->prepare("update user_vendors set vendor_location_category=:location_index where vendor_id=:id");
		$query->bindParam(':id',$id);
		$query->bindParam(':location_index',$location_index);
		
		$id = strip_tags(trim($_GET['id']));
		$location_index = strip_tags(trim($_GET['location_index']));
		
		$query->execute();
		
		echo "updated";
	}
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>