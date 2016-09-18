<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		$query2 = $db->prepare("insert into reviews (unique_id, user_id, vendor_id, review_text, review_index, date_time) 
		values(:unique, :user_id, :vendor_id, :review_text, :review_index, :date_time)");
		
		$query2->bindParam(':user_id',$userId);
		$query2->bindParam(':vendor_id',$vendorId);
		$query2->bindParam(':review_text',$reviewText);
		$query2->bindParam(':date_time',$date_time);
		$query2->bindParam(':unique', $unique);
		$query2->bindParam(':review_index', $reviewIndex);
		
		$userId = strip_tags(trim($_GET['user_id']));
		$vendorId = strip_tags(trim($_GET['vendor_id']));
		$reviewText = strip_tags(trim($_GET['review_text']));
		$reviewIndex = strip_tags(trim($_GET['review_index']));		
		$date_time = strip_tags(trim($_GET['date_year']))."/".strip_tags(trim($_GET['date_month']))."/".strip_tags(trim($_GET['date_day']))." ".
		strip_tags(trim($_GET['date_hour'])).":".strip_tags(trim($_GET['date_minute'])).":".strip_tags(trim($_GET['date_second']));
		$unique = md5(time() . $userId . $vendorId); 
		
		$query2->execute();
		echo "done";
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>