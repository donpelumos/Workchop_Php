<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
		$query = $db->prepare("insert into waiting_list(id, email_address) values(:id, :email)");
		$query->bindParam(':id',$id);
		$query->bindParam(':email',$email);
		
		$id = md5(time());
		$email = strip_tags(trim($_GET['email']));
		$query->execute();
		
		echo "done";
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>