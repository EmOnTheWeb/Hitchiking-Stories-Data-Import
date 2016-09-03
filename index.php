<?php 

$user_name = "digihitch_wp";
$password = "s7BRUt3Zdp7LwHEW";
$database = "digihitch";
$server = "localhost";

	@ $db = new mysqli($server,$user_name,$password,$database); 
	if (mysqli_connect_errno()) {

		echo 'didnt connect'; 
		exit; 

	} else {

		$query = "select author from bak_stories_organized"; 
		$result = $db->query($query); 

		$authorList = array(); 
		for($i=0; $i < $result->num_rows; $i++) {     

			$row = $result->fetch_assoc(); 

			if(!inAuthorList($row['author'], $authorList)) {

				//change database

				// mysqli_select_db($db,"digihitch_wordpress");

				//insert into db 

				// $query = "insert into wp_users(display_name) 
				// 		  VALUES ('".mysqli_real_escape_string($db, $row['author'])."')"; 

				// $db->query($query); 

				//add to author list

				array_push($authorList,$row['author']); 

			}
		}
		var_dump($authorList); 
	}

$result->free(); 

$db->close(); 


function inAuthorList($author, $authorList) {


	foreach( $authorList as $authorAlreadyStored) {

		$author = strtolower(trim($author)); 
		$authorAlreadyStored = strtolower(trim($authorAlreadyStored)); 

		echo $author; echo ':'; echo $authorAlreadyStored; echo "<br>"; 
		if($author === $authorAlreadyStored) {
			echo 'i return true'; echo "<br>"; 
			return true; 
		}
		echo 'i return false'; echo "<br>"; 
		return false; 
	}
}

?>