<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		$query2 = $db->prepare("update permanent_vendors set password=:password where vendor_id=:id");
		
		$query2->bindParam(':password',$password);
		$query2->bindParam(':id',$id);
		
		$id = strip_tags(trim($_GET['vendor_id']));	
		$password = md5(strip_tags(trim($_GET['password'])));	
		
		$query2->execute();
		echo "done";
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>