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
		
		$userId = strip_tags(trim($_GET['user_id']));
		$used = strip_tags(trim($_GET['used']));
		$vendorId = strip_tags(trim($_GET['vendor_id']));
		$dateTime = strip_tags(trim($_GET['date_time']));
		if($used == 1){
			$query4 = $db->prepare("update vendors_probably_used set probability='$used' where user_id='$userId' and vendor_id='$vendorId' and date_time='$dateTime'");
			$query4->execute();	
			echo "done";
		}
		else if($used == 2){
			$query4 = $db->prepare("delete from vendors_probably_used where user_id='$userId' and vendor_id='$vendorId' and probability=0");
			$query4->execute();	
			echo "done";
		}
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>