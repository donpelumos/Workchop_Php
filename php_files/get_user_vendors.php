<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$userId = strip_tags(trim($_GET['user_id']));
		
		$query = $db->prepare("select vendor_name, vendor_id from user_vendors where user_id like '%$userId%'");
		$query->execute();
		$result = $query->fetchAll();
		
		foreach($result as $value){
			echo $value[0] . "--" . $value[1] . "------";
		}
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>