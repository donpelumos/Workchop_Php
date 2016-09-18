<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$userId = strip_tags(trim($_GET['user_id']));
		$vendorId = strip_tags(trim($_GET['vendor_id']));
		
		$query2 = $db->prepare("select user_id from user_vendors where vendor_id='$vendorId' and user_id like '%$userId%'");
		$query2->execute();
		$result2 = $query2->fetchAll();
		$resultSet = 0;
		if($query2->rowCount() > 0){
			echo "true";
		}
		else{
			echo "false";
		}
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>