<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$number = strip_tags(trim($_GET['phone_number']));
		$mode = strip_tags(trim($_GET['mode']));
		
		$query = $db->prepare("select * from permanent_users where mobile_number like'%$number%'");
		
		
		$query2 = $db->prepare("select * from permanent_vendors where mobile_number like '%$number%'");
				
		
		$query->execute();
		$query2->execute();
		$result = $query->fetchAll();
		$result2 = $query2->fetchAll();
		$vId = $result2[0][3];
		//echo $vId;
		$query3 = $db->prepare("select * from user_vendors where vendor_id='$vId'");
		$query3->execute();
		$result3 = $query3->fetchAll();
		//print_r($result);
		if($query->rowCount() != 0 && $mode == 1){
			echo $query->rowCount();
			foreach($result as $value){
				//echo $value[0] . " " . $value[1] . "<br>";
			}
		}
		else if ($query2->rowCount() != 0 && $mode == 2 && $result3[0][6] == 1){
			echo $query2->rowCount();
			foreach($result2 as $value){
				//echo $value[0] . " " . $value[1] . "<br>";
			}
		}
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>