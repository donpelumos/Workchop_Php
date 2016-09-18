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
		
		
		$query2 = $db->prepare("insert into chats (unique_id, chat_id, chat, sender, date_time, seen, seen_vendor) values(:unique, :chat_id, :chat, 
		:sender, :date_time, 0, 1)");
		
		$query2->bindParam(':chat_id',$chatId);
		$query2->bindParam(':sender',$sender);
		$query2->bindParam(':date_time',$date_time);
		$query2->bindParam(':unique', $unique);
		$query2->bindParam(':chat', $chat);
		
		$chatId = strip_tags(trim($_GET['user_id'])) . "&&" . strip_tags(trim($_GET['vendor_id']));
		$chat = strip_tags(trim($_GET['chat']));
		$sender = strip_tags(trim($_GET['sender']));	
		$date_time = $currentDate;
		//$date_time = strip_tags(trim($_GET['date_year']))."/".strip_tags(trim($_GET['date_month']))."/".strip_tags(trim($_GET['date_day']))." ".
		//strip_tags(trim($_GET['date_hour'])).":".strip_tags(trim($_GET['date_minute'])).":".strip_tags(trim($_GET['date_second']));
		$unique = md5(time().$chatId); 
		
		$query2->execute();
		echo "done";
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>