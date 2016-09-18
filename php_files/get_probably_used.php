<?php
	date_default_timezone_set('Africa/Lagos');
	$currentDate = date("Y-m-d H:i:s");
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query4 = $db->prepare("select * from vendors_probably_used where user_id=:user_id and probability=0");
		$query4->bindParam(':user_id',$userId);
		$userId = strip_tags(trim($_GET['user_id'])); 
		$query4->execute();	
		
		$result4 = $query4->fetchAll();
		
		if($query4->rowCount() > 0){
			foreach($result4 as $k){
				$vendorId = $k[1];
				$query = $db->prepare("select vendor_name from permanent_vendors where vendor_id='$vendorId'");
				$query->execute();
				$result = $query->fetchAll();
				echo $userId . "--" . $vendorId . "--" . $result[0][0] . "--" . $k[3] . "------";
			}
		}
		else{
			echo "false";
		}
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>