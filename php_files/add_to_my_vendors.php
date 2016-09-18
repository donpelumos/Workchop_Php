<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$vendorId = strip_tags(trim($_GET['vendor_id']));
		
		$query2 = $db->prepare("select * from user_vendors where vendor_id='$vendorId'");
		$query2->execute();
		$result2 = $query2->fetchAll();
		
		foreach($result2 as $value){
			if(strripos($value[0],"==") > 1){
				$joinedUser = $value[0] . "==" . strip_tags(trim($_GET['user_id']));
			}
			else{
				$joinedUser = strip_tags(trim($_GET['user_id']));
			}
			//print_r($joinedUser);
			//echo "<br>";
			$initial = explode("==",$joinedUser);
			//print_r($initial);
			//echo "<br>";
			$final = array_unique($initial);
			//print_r($final);
			//echo "<br>";
			$finalJoinedUser = implode("==",$final);
			//print_r($finalJoinedUser);
			//echo "<br>";
			$newQuery = $db->prepare("update user_vendors set user_id='$finalJoinedUser' where vendor_id='$vendorId'");
			$newQuery->execute();			
		}
		echo "done";
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>