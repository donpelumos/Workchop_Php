<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$email = strip_tags(trim($_GET['email_address']));
		$mode = strip_tags(trim($_GET['mode']));
		
		$query = $db->prepare("select * from permanent_users where email_address='$email'");
		
		
		$query2 = $db->prepare("select * from permanent_vendors where email_address='$email'");
		
		
		
		$query->execute();
		$query2->execute();
		$result = $query->FetchAll();
		$result2 = $query2->FetchAll();
		//print_r($result);
		if($query->rowCOunt() != 0 && $mode == 1){
			echo $query->rowCount();
			foreach($result as $value){
				//echo $value[0] . " " . $value[1] . "<br>";
			}
		}
		else if ($query2->rowCOunt() != 0 && $mode == 2){
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