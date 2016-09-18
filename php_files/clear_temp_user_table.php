<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	$db = new PDO($database, $user, $pwd);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$query = $db->prepare("delete from temporary_users where user_id=:id");
	$query->bindParam(':id',$id);

	
	$query2 = $db->prepare("delete from user_registration_codes where user_id=:id");
	$query2->bindParam(':id',$id);
	
	$id = strip_tags(trim($_GET['id']));
	
	$query->execute();
	$query2->execute();
	
	echo "deleted";
?>