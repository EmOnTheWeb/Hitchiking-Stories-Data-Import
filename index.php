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

	$query = "select archive from bak_stories"; 
	$result = $db->query($query); 

	for($i=0; $i < 1 ; $i++) {              //$result->num_rows

		$row = $result->fetch_assoc(); 

		var_dump($row); 

	
		$wholeContent = $row['archive'];

		//parse out author
		$findAuthor   = 'aid|';

		$authorPos = strpos($wholeContent, $findAuthor);
		$contentStartOfAuthor = substr($wholeContent,$authorPos+4); 
		$endofAuthor = strpos($contentStartOfAuthor,'|'); 

		$author = substr($contentStartOfAuthor, 0, $endofAuthor); 


		//parse out title 

		$findTitle = 'title|'; 
		$titlePos = strpos($wholeContent, $findTitle); 
		$contentStartOfTitle = substr($wholeContent, $titlePos+6); 
		$endofTitle = strpos($contentStartOfTitle, '|'); 

		$title = substr($contentStartOfTitle, 0, $endofTitle); 



		echo "<br><br>..........................................................................<br><br><br><br><br>"; 

		echo $author; echo $title; 
		
	}

}

	$result->free(); 

	$db->close(); 

		// var_dump($contentArray); 

	//open new connection 

	// $database = "digihitch_wordpress"; 
	// @ $db = new mysqli($server,$user_name,$password,$database); 

	// if (mysqli_connect_errno()) {

	// echo 'didnt connect'; 
	// exit; 

	// } else {

	// echo 'yesi did connect'; 

	// }

	// $numContent = sizeof($contentArray);
	// $index = 0; 
	// 	foreach($contentArray as $content) {
	// 		$index++; 
	// 		$query = "insert into wp_posts (post_content) values 
	// 				('".$content."')"; 

	// 		$success = $db->query($query); 

	// 		if($success) {

	// 			echo 'success'; 
	// 		} else {

	// 			echo 'number'.$index.'did not insert'; echo "</br>"; 
	// 			echo $content; 
	// 			echo "...</br>"; 
	// 		}

	// 	}
	// $db->close(); 

?>