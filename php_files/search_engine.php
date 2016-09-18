<?php
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	//phpinfo();
	
	try {
		$db = new PDO($database, $user, $pwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$userId = strip_tags(trim($_GET['user_id']));
		$vendorType = strip_tags(trim($_GET['vendor_type']));
		$locationIndex = strip_tags(trim($_GET['location_index']));
		
		$reviewCount = 0;  $contactCount = 0;  $contactOfContactCount = 0;
		$reviews = array(); $contacts = array(); $contactOfContacts = array();
		$foundIds = array(); $foundVendors = array();

		
		$query = $db->prepare("select * from user_contacts where user_id='$userId'");
		$query->execute();
		$result = $query->fetchAll();
		foreach($result as $value){
			//echo $value[1] . "---" . $value[2] ."<br>";
			$query2 = $db->prepare("select * from permanent_users where mobile_number='$value[2]'");	
			//echo "selecting all where mobile number is ".$value[2]."<br>";
			$query2->execute();
			$result2 = $query2->fetchAll();
				
			foreach($result2 as $value2){
				//echo $value2[0] . "----" . $value2[1] . "----" . $value2[2] . "<br>" ;
				$foundIds[] = $value2[5];
				/*$query3 = $db->prepare("select * from user_vendors where user_id like '%$value2[5]%' and vendor_location_category='$locationIndex' and 
				vendor_type='$vendorType'");	
				$query3->execute();
				$result3 = $query3->fetchAll();			
				foreach($result3 as $value3){
					$contacts[] = $value[1];
					$foundVendors[] = $value3[2] . "---" . $value3[3];
				}*/
			}
		}
		
		$query3 = $db->prepare("select * from user_vendors where vendor_location_category='$locationIndex' and vendor_type='$vendorType'");
		$query3->execute();
		$result3 = $query3->fetchAll();
		//echo "found ".$query3->rowCount()."<br>";
		
		$finalArray = array();
		foreach($result3 as $value3){
			//echo $k . "<br>";
			//$final = array();
			$xxx = $db->prepare("select avg(review_index) from reviews where vendor_id='$value3[2]'");
			$xxx->execute();
			$yyy = $xxx->fetchAll();
			$ttt = $yyy[0][0];
			if($yyy[0][0] == null){
				$ttt = 0;
			}
			//echo $value3[3] . "&&&" . $value3[2] . "&&&" . $ttt . "======" ;
			$fav = $value3[3] . "&&&" . $value3[2] . "&&&" . $ttt . "======" ;
			foreach($foundIds as $k){
				if(strripos($value3[0],$k) != null || strcmp($value3[0],$k) == 0){
					//$final[] = $k;
					//echo $k . "------";
					$fav = $fav . $k . "------";
					
					$queryz = $db->prepare("select * from permanent_users where user_id='$k'");
					$queryz->execute();
					$resultz = $queryz->fetchAll();
					//$resultz[0][0] . "------" . $resultz[0][1] . "------";

					
					$foundIdsb = array(); 
					$queryb = $db->prepare("select * from user_contacts where user_id='$k'");
					$queryb->execute();
					$resultb = $queryb->fetchAll();
					foreach($resultb as $valueb){
						$query2b = $db->prepare("select * from permanent_users where mobile_number='$valueb[2]'");
						$query2b->execute();
						$result2b = $query2b->fetchAll();
						foreach($result2b as $value2b){
							$foundIdsb[] = $value2b[5];
						}
					}
					//echo "founds ". count($foundIdsb);
					$finalb = array();
					foreach($foundIdsb as $kb){
						if(strripos($value3[0],$kb) != null){
							//echo "serching for ".$kb . " in ".$value3b[0];
							$finalb[] = $kb;
							
							//echo $kb;
						}
					}
					//echo count($finalb) . "==";
					$fav = $fav . count($finalb) . "==";
				}
			}
			//echo "|-|-|";
			$fav = $fav . "|-|-|";
			//echo "<br><br>"."VALUE - ". $fav  . "<br><br>";
			$finalArray[] = $fav;
			//echo count($finalArray) . "<br>";
			//$fav = "";
		}
		
		$contactNames = array(); $contactIds = array(); $contactOfContactNames = array(); $contactOfContactsCount=array();
		$finalRows = array(); $points = array(); $fullySorted = array();
		foreach($finalArray as $a){
			//echo "<br>" . count(explode("==",explode("======",explode("|-|-|",$a)[0]) [1])) . "<br>";
			$x = explode("==",explode("======",explode("|-|-|",$a)[0])[1]);
			$cocCount = 0;
			$coCount = 0;
			$cocText = "";
			$preText = "Used by ";
			foreach($x as $y){
				if($y != null){
					//echo $y . "--<br>";
					if($y != null){
						$r = explode("------", $y)[0];
						$queryA = $db->prepare("select surname, firstname from permanent_users where user_id='$r'");
						$queryA->execute();
						$resultA = $queryA->fetchAll();
						$preText= $preText .  $resultA[0][0] . " " . $resultA[0][1] . ", ";
					}
					$coCount = $coCount + count($y);
					$cocCount = $cocCount + explode("------", $y)[1];
					$specificCount = explode("------", $y)[1];
					$r = explode("------", $y)[0];
					$queryB = $db->prepare("select surname, firstname from permanent_users where user_id='$r'");
					$queryB->execute();
					$resultB = $queryB->fetchAll();
					if(explode("------",$y)[1] > 0){
						$cocText = $cocText . "Used by ". $specificCount . " of " . $resultB[0][0]. " " . $resultB[0][1]."'s contacts, ";
					}
					else{
						$cocText = $cocText . " ";
					}
				}
			}
			
			$partA = "Used by ".$coCount." contacts and ".$cocCount." contact of contacts. ";
			$partB = $preText.$cocText."";
			if ($coCount == 0){
				$partA = ""; $partB = "";
			}
			else{
				//echo $partA . " " . $partB;
			}
			$review = explode("&&&",explode("======",explode("|-|-|",$a)[0])[0])[2];
			$point = (3*$review)+(5*$coCount)+(4*$cocCount);
			$vendorId = explode("&&&",explode("======",explode("|-|-|",$a)[0])[0])[1];
			$row = explode("&&&",explode("======",explode("|-|-|",$a)[0])[0])[0]. "----" . $vendorId . "----" . $review . "----" .
			 $coCount . "----" . $cocCount . "----" . $partA . " " . "----" . $partB. " " . "----" . $point;
			//echo $row;
			$points[] = $point;
			$sortedPoints = $points;
			$finalRows[] = $row;
			//echo "<br>";
			
			
			
		}
		if($sortedPoints != null){
			rsort($sortedPoints);
		}
		for($i=0; $i< count($sortedPoints); $i++){
			//echo $sortedPoints[$i] . "--";
			$j=0;
			foreach($points as $p){
				if($sortedPoints[$i] == $p && strripos(implode(" ",$fullySorted),$j) == null){
					$fullySorted[] = $j;
				}
				$j++;
			}
		}
		$uniqueFullySorted = array_unique($fullySorted);
		$indexer = 0;
		foreach($uniqueFullySorted as $f){
			//echo $f . "--";
			echo $finalRows[$f];
			$indexer++;
			echo "==========";
		}
	}
	catch(PDOException $e) {
		die('Could not connect to the database:<br/>' . $e);
	}
?>