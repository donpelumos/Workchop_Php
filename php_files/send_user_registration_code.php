<?php
	$fromPage = getEnv("HTTP_REFERER");
	//echo $fromPage;
	
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	if(empty($_GET['mode'])){
	
	}
	else
	{
		//echo "working";
		if($_GET['mode'] == 1)
		{
			$db = new PDO($database, $user, $pwd);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = $db->prepare("insert into user_registration_codes(user_id, registration_code, date_time)
				values (:id, :code, :date_time)");
			$query->bindParam(':id',$id);
			$query->bindParam(':code',$code);
			$query->bindParam(':date_time', $date_time);
			
			$id = strip_tags(trim($_GET['id']));
			$date_time = strip_tags(trim($_GET['date_year']))."/".strip_tags(trim($_GET['date_month']))."/".strip_tags(trim($_GET['date_day']))." ".
				strip_tags(trim($_GET['date_hour'])).":".strip_tags(trim($_GET['date_minute'])).":".strip_tags(trim($_GET['date_second']));
			$code = strip_tags(trim($_GET['code']));
			$query->execute();
			
			$query2 = $db->prepare("select email_address from temporary_users where user_id=:id");
			$query2->bindParam(':id',$id);
			$query2->execute();
			$result2 = $query2->fetchAll();
			echo($result2[0][0]);
			
			$email = $result2[0][0];
			$to = "$email";
			$subject = "Workchop Registration Code";
			$txt = "Hello, " . " \r\n\r\nYour registration code is " . $code .".\r\n\r\nRegards.\r\n\r\nWorkchop Team.";
			$headers = "From: workchop@workchopapp.com" . "\r\n";
			
			mail($to,$subject,$txt,$headers);
			echo "done";
		}
		else if($_GET['mode'] == 2){
			$db = new PDO($database, $user, $pwd);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = $db->prepare("insert into user_registration_codes(user_id, registration_code, date_time)
				values (:id, :code, :date_time)");
			$query->bindParam(':id',$id);
			$query->bindParam(':code',$code);
			$query->bindParam(':date_time', $date_time);
			
			$id = strip_tags(trim($_GET['id']));
			$date_time = strip_tags(trim($_GET['date_year']))."/".strip_tags(trim($_GET['date_month']))."/".strip_tags(trim($_GET['date_day']))." ".
				strip_tags(trim($_GET['date_hour'])).":".strip_tags(trim($_GET['date_minute'])).":".strip_tags(trim($_GET['date_second']));
			$code = strip_tags(trim($_GET['code']));
			$query->execute();
			echo "done";
		}
	}	
		
	
?>