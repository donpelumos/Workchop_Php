<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$userId = strip_tags(trim($_GET['user_id']));
		$vendorId = strip_tags(trim($_GET['vendor_id']));
		$chatId = $userId . "&&" . $vendorId;
		
		$query2 = $db->prepare("update chats set seen_vendor=1 where chat_id='$chatId'");	
		$query2->execute();
		$result2 = $query2->fetchAll();
	}
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>