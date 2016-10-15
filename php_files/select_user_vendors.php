<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//"SELECT vendor_name, group_concat(vendor_number SEPARATOR ',') FROM user_vendors GROUP BY vendor_name;"
		
		$userId = strip_tags(trim($_GET['id']));
		$query = $db->prepare("SELECT vendor_name,  vendor_location_category, vendor_id,
		group_concat(vendor_number SEPARATOR '&&') FROM user_vendors where user_id like '%$userId%' and vendor_type=:vendor_type GROUP BY vendor_name");
		
		$query->bindParam(':vendor_type',$vendor_type);
		
		$id = strip_tags(trim($_GET['id']));
		$vendor_type = strip_tags(trim($_GET['vendor_type']));
		$query->execute();
		$result = $query->fetchAll();
		//print_r($result);
		if($query->rowCount()==0){
			echo "none";
		}
		else{
			foreach($result as $value){
				echo $value[0] . "--" . $value[1] . "--" . $value[2] .  "--" . $value[3] . "----";
				//echo "<br>" . $value[0] ." ".$value[1]." ".$value[2];
			}
		}
		
		
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>