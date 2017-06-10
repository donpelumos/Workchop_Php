<?php
	date_default_timezone_set('Africa/Lagos');
	$currentDate = date("Y-m-d H:i:s");
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query = $db->prepare("select count(unique_id) from reviews where vendor_id=:vendor_id");
		$query->bindParam(':vendor_id',$vendorId);
		$vendorId = strip_tags(trim($_GET['vendor_id'])); 
		$query->execute();	
		$result = $query->fetchAll(); 
		$userCount = $result[0][0];
		
		$query2 = $db->prepare("select avg(review_index) from reviews where vendor_id=:vendor_id");
		$query2->bindParam(':vendor_id',$vendorId);
		$vendorId = strip_tags(trim($_GET['vendor_id'])); 
		$query2->execute();	
		$result2 = $query2->fetchAll();
		$average = $result2[0][0]; 
		echo $userCount."------".number_format($average,1,".",",");
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>