<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		$query2 = $db->prepare("select chat_id from chats ");	
		$vendorId = strip_tags(trim($_GET['vendor_id']));
		$query2->execute();
		$result2 = $query2->fetchAll();
		$vendorFound = 0;
		foreach($result2 as $value){
			if(strcmp(explode("&&",$value[0])[1],$vendorId) == 0){
				$vendorFound = 1;
				//echo "USER ID FOUND <BR>";
				break;
			}
		}
		if($vendorFound == 1){
			//echo "true";
			$query2 = $db->prepare("select * from chats where chat_id like '%$vendorId%' order by date_time desc");
			$query2->execute();
			$result2 = $query2->fetchAll();
			$chatIds = array();
			$dateTimes = array();
			$userIds = array();
			foreach($result2 as $value){
				$chatIds[] = $value[1];
			}
			$uniqueChatIds = array_unique($chatIds);
			foreach($uniqueChatIds as $value){
				$userIds[] = explode("&&",$value)[0];
			}
			$chatTime = array();
			$chatCount = array();
			foreach($uniqueChatIds as $val){
				$query3 = $db->prepare("select date_time from chats where chat_id='$val' order by date_time desc");
				$query3->execute();
				$result3 = $query3->fetchAll();
				$chatTime[] = $result3[0][0];
				$query4 = $db->prepare("select count(unique_id) from chats where chat_id='$val' and seen_vendor=0 order by date_time desc");
				$query4->execute();
				$result4 = $query4->fetchAll();
				$chatCount[] = $result4[0][0];
				//echo $result3[0][0] . "--";
			}
			$i = 0;
			foreach($userIds as $value){
				//echo $value . "--";
				$query2 = $db->prepare("select * from permanent_users where user_id='$value'");
				$query2->execute();
				$result2 = $query2->fetchAll();
				foreach($result2 as $key){
					echo $value . "--" . $key[0] . " " . $key[1] . "--" . $chatTime[$i] . "--" . $chatCount[$i] . "------";
				}
				$i++;
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