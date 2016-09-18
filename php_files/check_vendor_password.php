<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		$query2 = $db->prepare("select * from permanent_vendors where vendor_id=:id");
		
		$query2->bindParam(':id',$vendorId);	
		$vendorId = strip_tags(trim($_GET['vendor_id']));	
		
		$query2->execute();
		$result2 = $query2->fetchAll();
		$existingPassword = $result2[0][5];
		//echo $existingPassword . "<br>";
		$checkedPassword = strip_tags(trim($_GET['password']));
		
		if(strcmp($existingPassword, md5($checkedPassword)) == 0){
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