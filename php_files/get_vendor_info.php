<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$vendorId = strip_tags(trim($_GET['vendor_id']));
		
		$query = $db->prepare("select vendor_name, mobile_number, email_address, location_index, vendor_type from permanent_vendors where vendor_id='$vendorId'");
		$query->execute();
		$result = $query->fetchAll();
		echo $result[0][0] . "--" . $result[0][1] . "--" . $result[0][2] . "--" . $result[0][3] . "--" . $result[0][4]; 
	}
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>