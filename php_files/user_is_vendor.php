<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$mode = strip_tags(trim($_GET['mode']));
		$phoneNo = strip_tags(trim($_GET['phone_no']));
		
		if($mode == 1){
			$query = $db->prepare("select * from permanent_vendors where mobile_number='$phoneNo'");
			$query->execute();
			$result = $query->fetchAll();
			if($query->rowCount() > 0){
				$id = $result[0][3];
				$query2 = $db->prepare("SELECT seen_vendor from chats where chat_id like '%$id%' and seen_vendor = 0");
				$query2->execute();
				$result2 = $query->fetchAll();
				if($query2->rowCount() > 0){
					echo $query2->rowCount();
				}
				else{
					echo "false";
				}
			}
			else{
				echo "false";
			}	
		}
		else if($mode == 2){
			$query = $db->prepare("select * from permanent_users where mobile_number='$phoneNo'");
			$query->execute();
			$result = $query->fetchAll();
			if($query->rowCount() > 0){
				$id = $result[0][5];
				$query2 = $db->prepare("SELECT seen from chats where chat_id like '%$id%' and seen = 0");
				$query2->execute();
				$result2 = $query->fetchAll();
				if($query2->rowCount() > 0){
					echo $query2->rowCount();
				}
				else{
					echo "false";
				}
			}
			else{
				echo "false";
			}		
		}
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>