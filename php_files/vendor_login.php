<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query = $db->prepare("select * from permanent_vendors where email_address=:email and password=:password");
		$query->bindParam(':email',$email);
		$query->bindParam(':password',$password);
		
		$email = strip_tags(trim($_GET['email']));
		$password = md5(strip_tags(trim($_GET['password'])));
		$query->execute();
		$result = $query->fetchAll();
		
		if($query->rowCount() == 0){
			$email = strip_tags(trim($_GET['email']));
			$query2= $db->prepare("select * from permanent_vendors where mobile_number like '%$email%' and password=:password");
			$query2->bindParam(':password',$password);
			
			$password = md5(strip_tags(trim($_GET['password'])));
			$query2->execute();
			$result2 = $query2->fetchAll();
			if($query2->rowCount() == 0){
				echo "false";
			}			
			else{
				foreach($result2 as $value2){
					if($value2[9] == 1){
						echo "logged--".$value2[0] . "--" . $value2[1] . "--" . $value2[2] . "--" . $value2[3] . "--" . $value2[4] . "--" . $value2[8];
					}
					else{
						echo $value2[0] . "--" . $value2[1] . "--" . $value2[2] . "--" . $value2[3] . "--" . $value2[4] . "--" . $value2[8];
					}
				}
			}
		}
		else{
			foreach($result as $value){
				if($value2[9] == 1){
					echo "logged--".$value[0] . "--" . $value[1] . "--" . $value[2] . "--" . $value[3] . "--" . $value[4] . "--" . $value[8];
				}
				else{
					echo $value[0] . "--" . $value[1] . "--" . $value[2] . "--" . $value[3] . "--" . $value[4] . "--" . $value[8];
				}
			}
		}		
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>