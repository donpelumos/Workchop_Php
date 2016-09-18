<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		$query2 = $db->prepare("select chat_id from chats ");	
		$userId = strip_tags(trim($_GET['user_id']));
		$vendorId = strip_tags(trim($_GET['vendor_id']));
		$chatId = $userId . "&&" . $vendorId;
		$query2->execute();
		$result2 = $query2->fetchAll();
		$vendorFound = 0;
		foreach($result2 as $value){
			if(strcmp(explode("&&",$value[0])[0],$userId) == 0  && strcmp(explode("&&",$value[0])[1],$vendorId) == 0){
				$vendorFound = 1;
				break;
			}
		}
		if($vendorFound == 1){
			//echo "true";
			$query2 = $db->prepare("select * from chats where chat_id='$chatId' order by date_time asc");
			$query2->execute();
			$result2 = $query2->fetchAll();
			foreach($result2 as $value){
				echo $value[0] . "--" .$value[1] . "--" . $value[2] . "--" . $value[3] . "--" . $value[4] . "--" . $value[5]  . "--" . $value[6]  .  "------";
			}
		}
		else{
			echo "false";
		}
		
	} 
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>