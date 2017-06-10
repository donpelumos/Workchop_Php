<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$userId = strip_tags(trim($_GET['user_id']));
		
		$query = $db->prepare("SELECT count(user_id) FROM user_vendors WHERE user_id like '%$userId%'and vendor_type=1");
		$query->execute();
		$result = $query->fetchAll();
		
		$query2 = $db->prepare("SELECT count(user_id) FROM user_vendors WHERE user_id like '%$userId%'and vendor_type=2");
		$query2->execute();
		$result2 = $query2->fetchAll();
		
		$query3 = $db->prepare("SELECT count(user_id) FROM user_vendors WHERE user_id like '%$userId%'and vendor_type=3");
		$query3->execute();
		$result3 = $query3->fetchAll();
		
		$query4 = $db->prepare("SELECT count(user_id) FROM user_vendors WHERE user_id like '%$userId%'and vendor_type=4");
		$query4->execute();
		$result4 = $query4->fetchAll();
		
		$query5 = $db->prepare("SELECT count(user_id) FROM user_vendors WHERE user_id like '%$userId%'and vendor_type=5");
		$query5->execute();
		$result5 = $query5->fetchAll();
		
		echo $result[0][0]."--".$result2[0][0]."--".$result3[0][0]."--".$result4[0][0]."--".$result5[0][0];
			
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>