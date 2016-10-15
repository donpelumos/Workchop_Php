<?php
	date_default_timezone_set('Africa/Lagos');
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	$currentDate = date("Y-m-d H:i:s");
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
		$query = $db->prepare("insert into waiting_list(id, email_address, date_time) values(:id, :email, :date)");
		$query->bindParam(':id',$id);
		$query->bindParam(':email',$email);
		$query->bindParam(':date',$currentDate);
		
		$id = md5(time());
		$email = strip_tags(trim($_GET['email']));
		$query->execute();
		
		echo "done--".$id;
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>