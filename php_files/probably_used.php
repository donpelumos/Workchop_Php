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
		
		$query = $db->prepare("select date_time from vendors_probably_used where user_id=:user_id and probability=0 order by date_time desc");
		$query->bindParam(':user_id',$userId);
		$userId = strip_tags(trim($_GET['user_id'])); 
		$query->execute();	
		
		$result = $query->fetchAll();
		if(count($result) > 0){
			if (abs((strtotime($currentDate) - strtotime($result[0][0]))/(3600*24))> 20){
				$query4 = $db->prepare("INSERT INTO vendors_probably_used(unique_id, vendor_id, user_id, date_time, probability)
					VALUES (:unique_id, :vendor_id, :user_id, :date_time, 0)");
				
				$query4->bindParam(':user_id',$userId);
				$query4->bindParam(':vendor_id',$vendorId);
				$query4->bindParam(':unique_id',$uniqueId);
				$query4->bindParam(':date_time',$currentDate);
			
				$userId = strip_tags(trim($_GET['user_id'])); 
				$vendorId = strip_tags(trim($_GET['vendor_id']));
				$uniqueId = md5(time().strip_tags(trim($_GET['user_id'])).strip_tags(trim($_GET['vendor_id'])));
				$query4->execute();	
				//echo "done--".$userId;
			}
		}
		else{
			$query4 = $db->prepare("INSERT INTO vendors_probably_used(unique_id, vendor_id, user_id, date_time, probability)
				VALUES (:unique_id, :vendor_id, :user_id, :date_time, 0)");
				
			$query4->bindParam(':user_id',$userId);
			$query4->bindParam(':vendor_id',$vendorId);
			$query4->bindParam(':unique_id',$uniqueId);
			$query4->bindParam(':date_time',$currentDate);
			
			$userId = strip_tags(trim($_GET['user_id'])); 
			$vendorId = strip_tags(trim($_GET['vendor_id']));
			$uniqueId = md5(time().strip_tags(trim($_GET['user_id'])).strip_tags(trim($_GET['vendor_id'])));
			$query4->execute();	
			//echo "done--".$userId;
		}
		
		echo "done--".$userId;
		
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>