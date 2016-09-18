<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query2 = $db->prepare("select * from user_registration_codes where registration_code=:code order by date_time desc");
		$query2->bindParam(':code',$code); 
		
		$code = strip_tags(trim($_GET['code']));
		$query2->execute();
		$result2 = $query2->fetchAll();
		
		if($query2->rowCount() == 0){
			echo "false";
		}
		else{
			foreach($result2 as $value){
				//echo $value[0] . "--" . $value[1] . "--" . $value[2];
				echo $value[1] . "--";
				$query = $db->prepare("select * from temporary_users where user_id='$value[0]'");
				$query->execute();
				$result = $query->fetchAll();
				foreach($result as $value2){
					echo $value2[0] . "--" . $value2[1] . "--" . $value2[2] . "--" . $value2[3] . "--" . $value2[5] . "--" . $value2[6];
				}
			}
		}		
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>