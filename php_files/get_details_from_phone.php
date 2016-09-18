<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$number = strip_tags(trim($_GET['phone_number']));
		$mode = strip_tags(trim($_GET['type']));
		
		if($mode == 1){
			$query = $db->prepare("select * from permanent_users where mobile_number like'%$number%'");
			$query->execute();
			$result = $query->fetchAll();
			if($query->rowCount() == 0){
				echo "false";
			}
			else if($result[0][10] == 1){
				echo "logged";
			}
			else{
				echo "true";
			}
		}
		else if($mode == 2){
			$query = $db->prepare("select * from permanent_vendors where mobile_number like'%$number%'");
			$query->execute();
			$result = $query->fetchAll();
			if($query->rowCount() == 0){
				echo "false";
			}
			else if($result[0][9] == 1){
				echo "logged";
			}
			else{
				echo "true";
			}
		}	
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>