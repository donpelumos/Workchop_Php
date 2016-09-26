<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	$currentDate = date("Y-m-d H:i:s");
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$id = strip_tags(trim($_GET['id']));
				
		$query = $db->prepare("update waiting_list set gender=:gender, heard_from=:from where id='$id'");
		$query->bindParam(':gender',$gender);
		$query->bindParam(':from',$heardFrom);
		
		$gender = strip_tags(trim($_GET['gender']));
		$heardFrom = strip_tags(trim($_GET['heard_from']));
		$query->execute();
		
		echo "done--".$id;
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>