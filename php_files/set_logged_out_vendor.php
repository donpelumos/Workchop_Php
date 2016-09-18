<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$vendorId = strip_tags(trim($_GET['vendor_id']));
		$query = $db->prepare("update permanent_vendors set logged_in=0 where vendor_id='$vendorId'");
		
		$query->execute();
		echo "done";
			
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>