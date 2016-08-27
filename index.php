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

	$query = "select * from eu_stories"; 
	$result = $db->query($query); 

	$contentArray = array(); 
	for($i=0; $i < $result->num_rows; $i++) {

		$row = $result->fetch_assoc(); 

		//get relevant info. 
		
		$author = $row['aid']; 
		$title = $row['title']; 
		$date = $row['time']; 
		$content = $row['hometext'].$row['bodytext']; 

		array_push($contentArray,$content); 

		//for wp 
		$postType = 'post'; 
		
	}


}

	$result->free(); 

	$db->close(); 

		// var_dump($contentArray); 

	//open new connection 

	$database = "digihitch_wordpress"; 
	@ $db = new mysqli($server,$user_name,$password,$database); 

	if (mysqli_connect_errno()) {

	echo 'didnt connect'; 
	exit; 

	} else {

	echo 'yesi did connect'; 

	}

	$numContent = sizeof($contentArray);
	echo $numContent; 
		for($i=0; $i < sizeof($contentArray); $i++) {
		 echo $contentArray[$i]; 
			$query = "insert into wp_posts (post_content) values 
					('".$contentArray[$i]."')"; 

			$db->query($query); 

		}
	$db->close(); 

?>