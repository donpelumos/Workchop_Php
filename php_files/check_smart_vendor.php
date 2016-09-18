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
		
		$query = $db->prepare("select contact_number from user_contacts where user_id='$userId'");
		$query->execute();
		$result = $query->fetchAll();
		
		$query2 = $db->prepare("select is_vendor_smart, vendor_number from user_vendors where vendor_id='$vendorId'");	
		
		$query2->execute();
		$result2 = $query2->fetchAll();
		$isSmart = 0;
		foreach($result2 as $value){
			if($value[0] == 1){
				$isSmart = 1;
				break;
			}
			else{
				foreach($result as $key){
					//echo $value[1] . "--" . $key[0] . "<br>";
					if(explode("&&",$value[1])[0] == $key[0] || explode("&&",$value[1])[1] == $key){
						$isSmart = 0.5;
						break;
					}
				}
			}
		}
		echo $isSmart;
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>