<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		$query2 = $db->prepare("select * from permanent_users where user_id=:id");
		
		$query2->bindParam(':id',$userId);	
		$userId = strip_tags(trim($_GET['user_id']));	
		
		$query2->execute();
		$result2 = $query2->fetchAll();
		
		if($query2->rowCount() == 0){
			echo "none";
		}
		else{
			foreach($result2 as $value){
				echo $value[0] . "--" . $value[1] . "--" . $value[2] .  "--" . $value[3] .   "--" . $value[4];
			}
		}		
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>