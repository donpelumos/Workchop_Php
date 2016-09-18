<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query3 = $db->prepare("select * from permanent_vendors where mobile_number=:number");
		$query3->bindParam(':number',$number); 
		
		$number = strip_tags(trim($_GET['vendor_number']));
		$query3->execute();
		$result3 = $query2->fetchAll();
		if($query3->rowCount() == 0){
			
		}
		else{
			$query4 = $db->prepare("INSERT INTO permanent_vendors(surname, firstname, mobile_number, location_index, vendor_id, vendor_type,
			suspended_index, date_time)
				VALUES (:surname, :firstname, :mobile_number, :location_index, :vendor_id, :vendor_type, :suspended_index, :date_time)");
			$query4->bindParam(':surname',$surname);
			$query4->bindParam(':firstname',$firstname);
			$query4->bindParam(':mobile_number',$mobile_number);
			$query4->bindParam(':location_index',$location_index);
			$query4->bindParam(':vendor_id',$vendor_id);
			$query4->bindParam(':vendor_type',$vendor_type);
			$query4->bindParam(':suspended_index',$suspended_index);
			$query4->bindParam(':date_time',$date_time);
			
			$surname = strip_tags(trim($_GET['surname']));  
			$firstname = strip_tags(trim($_GET['firstname']));  
			$mobile_number = strip_tags(trim($_GET['mobile_number']));  
			$location_index = strip_tags(trim($_GET['location_index']));  
			$vendor_type= md5(strip_tags(trim($_GET['vendor_type'])));  
			$suspended_index = strip_tags(trim($_GET['suspended_index']));
			$date_time = strip_tags(trim($_GET['date_year']))."/".strip_tags(trim($_GET['date_month']))."/".strip_tags(trim($_GET['date_day']))." ".
			strip_tags(trim($_GET['date_hour'])).":".strip_tags(trim($_GET['date_minute'])).":".strip_tags(trim($_GET['date_second']));
		}
	}
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>