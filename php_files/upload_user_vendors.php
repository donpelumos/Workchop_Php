<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query2 = $db->prepare("select * from user_vendors");
		$query2->execute();
		$result2 = $query2->fetchAll();
		$resultSet = 0;
		
		foreach($result2 as $value){
			if(strcmp($value[4],strip_tags(trim($_GET['vendor_number']))) == 0 || strcmp(explode("&&",$value[4])[0],strip_tags(trim($_GET['vendor_number']))) == 0
				|| strcmp(explode("&&",$value[4])[1], strip_tags(trim($_GET['vendor_number'])))== 0){
				$joinedUser = $value[0] . "==" . strip_tags(trim($_GET['user_id']));
				print_r($joinedUser);
				echo "<br>";
				$initial = explode("==",$joinedUser);
				print_r($initial);
				echo "<br>";
				$final = array_unique($initial);
				print_r($final);
				echo "<br>";
				$finalJoinedUser = implode("==",$final);
				print_r($finalJoinedUser);
				echo "<br>";
				$newQuery = $db->prepare("update user_vendors set user_id='$finalJoinedUser' where vendor_number='$value[4]'");
				$newQuery->execute();
				$resultSet = 1;
			}
		}
		
		
		if($resultSet == 0){
			$query = $db->prepare("INSERT INTO user_vendors(user_id, unique_id, vendor_id, vendor_name, vendor_number, vendor_type, is_vendor_smart, 
			vendor_location_category)
				VALUES (:user_id, :unique_id, :vendor_id, :vendor_name, :vendor_number, :vendor_type, :is_vendor_smart, :vendor_location_category)");
			$query->bindParam(':user_id',$user_id);
			$query->bindParam(':unique_id',$unique_id);
			$query->bindParam(':vendor_id',$vendor_id);
			$query->bindParam(':vendor_name',$vendor_name);
			$query->bindParam(':vendor_number',$vendor_number);
			$query->bindParam(':vendor_type',$vendor_type);
			$query->bindParam(':is_vendor_smart',$is_vendor_smart);
			$query->bindParam(':vendor_location_category',$vendor_location_category);
			
			$user_id = strip_tags(trim($_GET['user_id'])); 
			$unique_id = md5(time().strip_tags(trim($_GET['user_id'])).strip_tags(trim($_GET['vendor_name'])).strip_tags(trim($_GET['vendor_number'])));
			$vendor_id = md5(time().strip_tags(trim($_GET['user_id'])).strip_tags(trim($_GET['vendor_name'])));		
			$vendor_name = strip_tags(trim($_GET['vendor_name'])); 
			$vendor_number = strip_tags(trim($_GET['vendor_number'])); 
			$vendor_number = str_replace("----","&&",$vendor_number);
			$vendor_type = strip_tags(trim($_GET['vendor_type'])); 
			$is_vendor_smart = strip_tags(trim($_GET['is_vendor_smart'])); 
			$vendor_location_category = strip_tags(trim($_GET['vendor_location_category']));
			
			$query->execute();
		}
		
		
		
		$query2 = $db->prepare("select * from permanent_vendors");
		$query2->execute();
		$result2 = $query2->fetchAll();
		$exists = 0;
		foreach($result2 as $value){
			if(strcmp($value[1],strip_tags(trim($_GET['vendor_number']))) == 0 || strcmp(explode("&&",$value[1])[0],strip_tags(trim($_GET['vendor_number']))) == 0 
				|| strcmp(explode("&&",$value[1])[1],strip_tags(trim($_GET['vendor_number']))) == 0 ){
				$exists = 1;
			}
		}
		
		if($exists == 0){
			$query4 = $db->prepare("INSERT INTO permanent_vendors(vendor_name, mobile_number, location_index, vendor_id, vendor_type, suspended_index)
				VALUES (:vendor_name, :mobile_number, :location_index, :vendor_id, :vendor_type, :suspended_index)");
				
			$query4->bindParam(':vendor_name',$vendor_name);
			$query4->bindParam(':mobile_number',$mobile_number);
			$query4->bindParam(':location_index',$location_index);
			$query4->bindParam(':vendor_id',$vendor_id);
			$query4->bindParam(':vendor_type',$vendor_type);
			$query4->bindParam(':suspended_index',$suspended_index);
			
			$user_id = strip_tags(trim($_GET['user_id'])); 
			$unique_id = md5(time().strip_tags(trim($_GET['user_id'])).strip_tags(trim($_GET['vendor_name'])).strip_tags(trim($_GET['vendor_number'])));
			$vendor_id = md5(time().strip_tags(trim($_GET['user_id'])).strip_tags(trim($_GET['vendor_name'])));		
			$vendor_name = strip_tags(trim($_GET['vendor_name'])); 
			$vendor_number = strip_tags(trim($_GET['vendor_number'])); 
			$vendor_number = str_replace("----","&&",$vendor_number);
			$vendor_type = strip_tags(trim($_GET['vendor_type'])); 
			$is_vendor_smart = strip_tags(trim($_GET['is_vendor_smart'])); 
			$vendor_location_category = strip_tags(trim($_GET['vendor_location_category']));
			
			$vendor_name = $vendor_name;  
			$mobile_number = $vendor_number;  
			$location_index = $vendor_location_category;
			$vendor_type= $vendor_type;  
			$vendor_id = $vendor_id;
			$user_id = $user_id;
			$suspended_index = 0;
			
			$query4->execute();	
			
		}
		echo "done--".$user_id;
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>