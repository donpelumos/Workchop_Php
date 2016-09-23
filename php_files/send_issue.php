<?php
	$fromPage = getEnv("HTTP_REFERER");
	//echo $fromPage;
	
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	$mode = strip_tags(trim($_GET['mode']));
	$issueSubject = strip_tags(trim($_GET['subject']));
	$issueBody = strip_tags(trim($_GET['issue']));
	
	if($mode == 1){
		$id = strip_tags(trim($_GET['id']));
				
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query2 = $db->prepare("select firstname, surname, mobile_number, email_address from permanent_users where user_id=:id");
		$query2->bindParam(':id',$id);
		$query2->execute();
		$result2 = $query2->fetchAll();
		//echo($result2[0][0]);
		$fullName = $result2[0][0]." ".$result2[0][1];
		$email = $result2[0][3];
		$number = $result2[0][2];
		
		if(strlen($email) >8){
			$to = "$email";
			$subject = "issue Received";
			$txt = "Hello,\r\n\r\n" . "Your issue or complaint has been received and would be resolved as soon as possible. Sorry for any inconviniences." . "\r\n\r\nBest Regards.\r\n\r\nWorkchop Team.";
			$headers = "From: support@workchopapp.com" . "\r\n";
			mail($to,$subject,$txt,$headers);
		}
		
		$to2 = "support@workchopapp.com";
		$subject2 = "Issue From User - ".$fullName;
		$txt2 = "New Issue from user with details below,\r\n\r\n" . "Full Name - ".$fullName."\r\nEmail Address - ". $email."\r\nPhone Number - ".$number."\r\nissue Subject - "
		.$issueSubject. "\r\nIssue Body - ".$issueBody;
		$headers2 = "From: Workchop User" . "\r\n";
		mail($to2,$subject2,$txt2,$headers2);
		
		echo "done";	
	}
	else if($mode == 2){
		$id = strip_tags(trim($_GET['id']));
				
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query2 = $db->prepare("select vendor_name, mobile_number, email_address from permanent_vendors where vendor_id=:id");
		$query2->bindParam(':id',$id);
		$query2->execute();
		$result2 = $query2->fetchAll();
		//echo($result2[0][0]);
		$fullName = $result2[0][0];
		$email = $result2[0][2];
		$number = $result2[0][1];
		
		if(strlen($email) >8){
			$to = "$email";
			$subject = "Issue Received";
			$txt = "Hello,\r\n\r\n" . "Your issue or complaint has been received and would be resolved as soon as possible. Sorry for any inconviniences." . "\r\n\r\nBest Regards.\r\n\r\nWorkchop Team.";
			$headers = "From: support@workchopapp.com" . "\r\n";
			mail($to,$subject,$txt,$headers);
		}
		
		$to2 = "support@workchopapp.com";
		$subject2 = "Issue From Vendor - ".$fullName;
		$txt2 = "New issue from user with details below,\r\n\r\n" . "Full Name - ".$fullName."\r\nEmail Address - ". $email."\r\nPhone Number - ".$number."\r\nIssue Subject - "
		.$issueSubject. "\r\nIssue Body - ".$issueBody;
		$headers2 = "From: Workchop Vendor" . "\r\n";
		mail($to2,$subject2,$txt2,$headers2);
		
		echo "done";	
	}
		
	
?>