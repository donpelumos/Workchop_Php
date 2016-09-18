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
		
		$query4 = $db->prepare("select * from permanent_users where user_id=:user_id");
		$query4->bindParam(':user_id',$userId);
		$userId = strip_tags(trim($_GET['user_id'])); 
		$query4->execute();	
		$result4 = $query4->fetchAll();
		$userPoints = $result4[0][9];
		echo $userPoints;
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>