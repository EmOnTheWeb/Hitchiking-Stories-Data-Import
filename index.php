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
	$index = 0; 
		foreach($contentArray as $content) {
			$index++; 
			$query = "insert into wp_posts (post_content) values 
					('".$content."')"; 

			$success = $db->query($query); 

			if($success) {

				echo 'success'; 
			} else {

				echo 'number'.$index.'did not insert'; echo "</br>"; 
				echo $content; 
				echo "...</br>"; 
			}

		}
	$db->close(); 

?>