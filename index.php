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



	for($i=0; $i < 1; $i++) {            

		$row = $result->fetch_assoc(); 

		// var_dump($row); 

		$success= mysqli_select_db($db, 'digihitch_wordpress'); 

		$author = $row['informant']; 
		// echo $author; 
		$query = "select ID from wp_users where display_name='".$author."'"; 
		echo $query; 

		echo "<br><br><br>"; 
		$wpID = $db->query($query); 

		var_dump($wpID); 

			for($i=0; $i< $wpID->num_rows; $i++) {

				$wpIDRow = $wpID->fetch_assoc(); 

				$wpIDNumber = $wpIDRow['ID']; 

			}
	}
}

$result->free(); 
$db->close(); 



?>