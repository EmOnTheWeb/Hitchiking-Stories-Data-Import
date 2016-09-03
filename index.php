<?php 

//for each row in stories table 




//get the informant, get the sid (primary key)


//select ID from digihitch_wordpress.wp_users where display_name = informant 


//insert into can stories table wp_authorID (update); 


$user_name = "digihitch_wp";
$password = "s7BRUt3Zdp7LwHEW";
$database = "digihitch";
$server = "localhost";

@ $db = new mysqli($server,$user_name,$password,$database); 

if (mysqli_connect_errno()) {

	echo 'didnt connect'; 
	exit; 

} else {

	$query = "select sid,informant from can_stories";

	$result = $db->query($query); 

	echo $result->num_rows; 

	for($i=0; $i < $result->num_rows; $i++) {            
	
		$row = $result->fetch_assoc(); 

		$author = $row['informant']; 
		$rowKey = $row['sid']; 

		// echo gettype($rowKey); 

		$success= mysqli_select_db($db, 'digihitch_wordpress'); 

		
		// echo $author; 
		$query = "select ID from wp_users where display_name='".$author."'"; 
		// echo $query; 

		// echo "<br><br><br>"; 
		$wpID = $db->query($query); 

		// var_dump($wpID); 

		$wpIDNumber = 0; 
		//get the number out of result and store it in the var 
			for($z=0; $z< $wpID->num_rows; $z++) {

				$wpIDRow = $wpID->fetch_assoc(); 

				$wpIDNumber = $wpIDRow['ID']; 
				// var_dump($wpIDNumber); 
			}
		//switch database back
		mysqli_select_db($db, 'digihitch'); 

		$query = "update can_stories set wp_authorID=".mysqli_real_escape_string($db,$wpIDNumber)." where sid=".mysqli_real_escape_string($db,$rowKey); 

		// echo $query; 


	}
}

$result->free(); 
$db->close(); 



?>