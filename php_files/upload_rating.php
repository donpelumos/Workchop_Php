<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		$query2 = $db->prepare("insert into ratings (unique_id, user_id, rating, date_time) values(:unique, :user_id, :rating, :date_time)");
		
		$query2->bindParam(':user_id',$userId);
		$query2->bindParam(':rating',$rating);
		$query2->bindParam(':date_time',$date_time);
		$query2->bindParam(':unique', $unique);
		
		$userId = strip_tags(trim($_GET['user_id']));	
		$rating = strip_tags(trim($_GET['rating']));		
		$date_time = strip_tags(trim($_GET['date_year']))."/".strip_tags(trim($_GET['date_month']))."/".strip_tags(trim($_GET['date_day']))." ".
		strip_tags(trim($_GET['date_hour'])).":".strip_tags(trim($_GET['date_minute'])).":".strip_tags(trim($_GET['date_second']));
		$unique = md5(time().$subject); 
		
		$query2->execute();
		echo "done";
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>