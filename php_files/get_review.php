<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$vendorId = strip_tags(trim($_GET['vendor_id']));
		$query2 = $db->prepare("select * from reviews where vendor_id='$vendorId'  order by review_index desc");	
		$query2->execute();
		$result2 = $query2->fetchAll();
		
		foreach($result2 as $value){
			$query = $db->prepare("select surname, firstname, points from permanent_users where user_id='$value[1]'");
			$query->execute();
			$result = $query->fetchAll();
			foreach($result as $key){
				echo $key[0] . "--" . $key[1] . "--" . $value[3] . "--" . $value[4] . "--" . $key[2] . "--" . $value[5] . "------";
			}
		}		
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>