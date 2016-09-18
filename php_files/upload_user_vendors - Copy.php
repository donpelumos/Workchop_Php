<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query2 = $db->prepare("select * from user_vendors where user_id=:id2 and vendor_number=:vendor_number2");
		$query2->bindParam(':id2',$id2);
		$query2->bindParam(':vendor_number2',$vendor_number2);
		
		$id2 = strip_tags(trim($_GET['user_id']));
		$vendor_number2 = strip_tags(trim($_GET['vendor_number'])); 
		
		$query2->execute();
		$result2 = $query2->fetchAll();
		//print_r($result);
		if($query2->rowCount() == 0){
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
			$vendor_type = strip_tags(trim($_GET['vendor_type'])); 
			$is_vendor_smart = strip_tags(trim($_GET['is_vendor_smart'])); 
			$vendor_location_category = strip_tags(trim($_GET['vendor_location_category'])); 
			
			/*$query6 = $db->prepare("select * from user_vendors where user_id=:id6");
			$query6->bindParam(':id6',$id6);
			
			$id6 = strip_tags(trim($_GET['user_id']));
			
			//$query6->execute();
			//$result6 = $query6->fetchAll();
			
			foreach($result6 as $value1){
				if(strcmp($value1[3],$vendor_name)==0){
					$vendor_number = $vendor_number."--".$value1[4];
					$query7 = $db->prepare("update user_vendors set vendor_number='$vendor_number' where userid='$id6'");
					//$query7->execute();
				}
				else{
				
				}
			}*/
				
			$query->execute();
			
			
			
			$query3 = $db->prepare("select * from permanent_vendors where mobile_number=:number");
			$query3->bindParam(':number',$number); 
			
			$number = strip_tags(trim($_GET['vendor_number']));
			$query3->execute();
			
			$result3 = $query3->fetchAll();
			if($query3->rowCount() == 0){
				$query4 = $db->prepare("INSERT INTO permanent_vendors(vendor_name, mobile_number, location_index, vendor_id, vendor_type, suspended_index)
					VALUES (:vendor_name, :mobile_number, :location_index, :vendor_id, :vendor_type, :suspended_index)");
					
				$query4->bindParam(':vendor_name',$vendor_name);
				$query4->bindParam(':mobile_number',$mobile_number);
				$query4->bindParam(':location_index',$location_index);
				$query4->bindParam(':vendor_id',$vendor_id);
				$query4->bindParam(':vendor_type',$vendor_type);
				$query4->bindParam(':suspended_index',$suspended_index);
				
				$vendor_name = $vendor_name;  
				$mobile_number = $vendor_number;  
				$location_index = $vendor_location_category;
				$vendor_type= $vendor_type;  
				$vendor_id = $vendor_id;
				$suspended_index = 0;
				
				$query4->execute();
			}
			else{
				
			}
		}
		else{
			
		}
		

		echo "done--".$user_id;
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>