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

	for($i=0; $i < 3 ; $i++) {              //$result->num_rows

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

		//parse out date 
		$findDate = 'time|'; 
		$datePos = strpos($wholeContent, $findDate); 
		$contentStartOfDate = substr($wholeContent, $datePos+5); 
		$endofDate = strpos($contentStartOfDate, '|'); 

		$date = substr($contentStartOfDate, 0, $endofDate); 

		//get content
		$findTextStart = 'hometext|'; 
		$textStartPos = strpos($wholeContent, $findTextStart); 
		$contentStartOfText = substr($wholeContent, $textStartPos + 9); 

		$findEndOfText = 'comments'; 
		$positionEndOfText = strpos($contentStartOfText, $findEndOfText); 
		$contentUpToEnd = substr($contentStartOfText, 0, $positionEndOfText); 

		//clean up content 

		$cleanContent = str_replace('|', '', $contentUpToEnd); 
		$cleanContent = str_replace('bodytext','',$cleanContent); 



		echo "<br><br>..........................................................................<br><br><br><br><br>";  

		echo $cleanContent; 
		
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