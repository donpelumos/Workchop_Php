<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$userId = strip_tags(trim($_GET['id']));
		$query2 = $db->prepare("select vendor_name,  vendor_location_category, vendor_id,
		group_concat(vendor_number SEPARATOR '&&') from user_vendors where user_id like '%$userId%' and vendor_type=:type group by vendor_name asc");
		$query2->bindParam(':type',$type); 
		
		$id = strip_tags(trim($_GET['id']));
		$type = strip_tags(trim($_GET['type']));
		$query2->execute();
		$result2 = $query2->fetchAll();
		
		if($query2->rowCount() == 0){
			echo "none";
		}
		else{
			foreach($result2 as $value){
				echo $value[0] . "--" . $value[1] . "--" . $value[2] .  "--" . $value[3] . "----";
			}
		}		
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>