<?php 
	$database = 'mysql:dbname=workchop_main;host=localhost;';
	$user = 'workchop_admin';
	$pwd = 'workchop_12345';
	
	$db = new PDO($database, $user, $pwd);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$query = $db->prepare("select * from vendor_types order by vendor_type asc");
	$query->execute();
	$result = $query->fetchAll();
	$output = "";
	foreach($result as $value){
		$output =  $output.$value[0]. "--";
	}
	echo $output;
?>