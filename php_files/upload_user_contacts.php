<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query2 = $db->prepare("select * from user_contacts where user_id=:id2 and contact_number=:contact_number2");
		$query2->bindParam(':id2',$id2);
		$query2->bindParam(':contact_number2',$contact_number2);
		
		$id2 = strip_tags(trim($_GET['user_id']));
		$contact_number2 = strip_tags(trim($_GET['contact_number'])); 
		
		$query2->execute();
		$result2 = $query2->fetchAll();
		//print_r($result);
		if($query2->rowCount() == 0){
			$query = $db->prepare("INSERT INTO user_contacts(user_id, contact_name, contact_number, unique_id)
				VALUES (:user_id, :contact_name, :contact_number, :unique_id)");
			$query->bindParam(':user_id',$user_id);
			$query->bindParam(':contact_name',$contact_name);
			$query->bindParam(':contact_number',$contact_number);
			$query->bindParam(':unique_id',$unique_id);
			
			$user_id = strip_tags(trim($_GET['user_id'])); 
			$contact_name = strip_tags(trim($_GET['contact_name']));  
			$contact_number = strip_tags(trim($_GET['contact_number'])); 
			$unique_id = md5(time().strip_tags(trim($_GET['user_id'])).strip_tags(trim($_GET['contact_number'])).strip_tags(trim($_GET['contact_name']))); 
			
			$query->execute();
		}
		else{
			
		}

		echo "done--".$user_id;
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>