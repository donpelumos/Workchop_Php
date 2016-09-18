<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query = $db->prepare("select * from vendor_registration_codes where vendor_id=:id order by date_time asc");
		//$query = $db->prepare("select * from user_registration_codes");
		$query->bindParam(':id',$id);
		
		$id = strip_tags(trim($_GET['id']));
		$query->execute();
		$result = $query->fetchAll();
		//print_r($result);
		//echo $query->rowCount();
		foreach($result as $value){
			echo $value[1];
			//echo "<br>" . $value[0] ." ".$value[1]." ".$value[2];
		}
		
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>