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
		
		$vendorId = strip_tags(trim($_GET['vendor_id']));
		$userId = strip_tags(trim($_GET['user_id']));
		
		$query2 = $db->prepare("select user_id from user_vendors where vendor_id='$vendorId'");		
		
		$query2->execute();
		$result = $query2->fetchAll();

		if($result[0][0] == $userId){
			$newId = "";
			$query2 = $db->prepare("update user_vendors set user_id='$newId' where vendor_id='$vendorId'");
			$query2->execute();
			echo "done";
		}
		else{
			$existingUserArray = explode("==",$result[0][0]);
			$i=0;
			foreach($existingUserArray as $key){
				if($key == $userId){
					unset($existingUserArray[$i]);
					$newUserArray = array();
					foreach($existingUserArray as $k){
						$newUserArray[] = $k;
					}
					$newId = implode("==",$newUserArray);
					$query2 = $db->prepare("update user_vendors set user_id='$newId' where vendor_id='$vendorId'");
					$query2->execute();
					echo "done";
					break;
				}
				$i++;
			}
		}
		
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>