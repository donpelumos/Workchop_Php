<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$number = strip_tags(trim($_GET['mobile_number'])); 
		$vendorName = strip_tags(trim($_GET['name']));  
		$vendorType = strip_tags(trim($_GET['type'])); 
		$pwwd = md5(strip_tags(trim($_GET['password']))); 	
		$email = strip_tags(trim($_GET['email_address']));	
		$id = strip_tags(trim($_GET['vendor_id']));		
			
		$query = $db->prepare("select * from permanent_vendors where mobile_number like '%$number%'");
		$query->execute();
		$result = $query->fetchAll();
		
		//echo $result[0][3];
		if($query->rowCount() > 0){
			$query2 = $db->prepare("update permanent_vendors set vendor_name='$vendorName', vendor_type='$vendorType', password='$pwwd', vendor_id='$id', 
			email_address='$email' where mobile_number like '%$number%'");
			$query2->execute();
			
			$query2 = $db->prepare("update user_vendors set vendor_name='$vendorName', vendor_type='$vendorType', is_vendor_smart=1, vendor_id='$id'
			where vendor_number like '%$number%'");
			$query2->execute();
			
			$oldVendorId = $result[0][3];
			$query3 = $db->prepare("update reviews set vendor_id='$id' where vendor_id='$oldVendorId'");
			$query3->execute();
			
			echo "done--".$result[0][3];
		}
		else{
			$query = $db->prepare("INSERT INTO permanent_vendors (vendor_name, vendor_type, mobile_number, email_address, location_index, vendor_id, password, suspended_index, date_time)
				VALUES (:name, :type, :mobile_number, :email, :location_index, :vendor_id, :password, :suspended_index, :date_time)");
			$query->bindParam(':name',$name);
			$query->bindParam(':type',$type);
			$query->bindParam(':mobile_number',$mobile_number);
			$query->bindParam(':email',$email);
			$query->bindParam(':location_index',$location_index);
			$query->bindParam(':vendor_id',$vendor_id);
			$query->bindParam(':password',$password);
			$query->bindParam(':suspended_index',$suspended_index);
			$query->bindParam(':date_time',$date_time);
			
			$name = strip_tags(trim($_GET['name']));  
			$type = strip_tags(trim($_GET['type']));  
			$mobile_number = strip_tags(trim($_GET['mobile_number']));  
			$email = strip_tags(trim($_GET['email_address']));
			$location_index = strip_tags(trim($_GET['location_index']));  
			$vendor_id = strip_tags(trim($_GET['vendor_id']));
			$password = md5(strip_tags(trim($_GET['password'])));  
			$suspended_index = strip_tags(trim($_GET['suspended_index']));
			$date_time = strip_tags(trim($_GET['date_year']))."/".strip_tags(trim($_GET['date_month']))."/".strip_tags(trim($_GET['date_day']))." ".
			strip_tags(trim($_GET['date_hour'])).":".strip_tags(trim($_GET['date_minute'])).":".strip_tags(trim($_GET['date_second']));
			
			$query->execute();
			
			$query = $db->prepare("INSERT INTO user_vendors( unique_id, vendor_id, vendor_name, vendor_number, vendor_type, is_vendor_smart, 
			vendor_location_category)
				VALUES ( :unique_id, :vendor_id, :vendor_name, :vendor_number, :vendor_type, :is_vendor_smart, :vendor_location_category)");
			$query->bindParam(':unique_id',$unique_id);
			$query->bindParam(':vendor_id',$vendor_id);
			$query->bindParam(':vendor_name',$vendor_name);
			$query->bindParam(':vendor_number',$vendor_number);
			$query->bindParam(':vendor_type',$vendor_type);
			$query->bindParam(':is_vendor_smart',$is_vendor_smart);
			$query->bindParam(':vendor_location_category',$vendor_location_category);
			
			$unique_id = md5(time().strip_tags(trim($_GET['name'])).strip_tags(trim($_GET['mobile_number'])));
			$vendor_name = strip_tags(trim($_GET['name'])); 
			$vendor_number = strip_tags(trim($_GET['mobile_number'])); 
			$vendor_type = strip_tags(trim($_GET['type'])); 
			$is_vendor_smart = "1"; 
			$vendor_location_category = strip_tags(trim($_GET['location_index'])); 
			
			$query->execute();
			echo "done--".$vendor_id;

		}
		
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>