<?php 
 $usStates = array(
  'AL' => 'Alabama',
  'AK' => 'Alaska',
  'AZ' => 'Arizona',
  'AR' => 'Arkansas',
  'CA' => 'California',
  'CO' => 'Colorado',
  'CT' => 'Connecticut',
  'DE' => 'Delaware',
  'FL' => 'Florida',
  'GA' => 'Georgia',
  'HI' => 'Hawaii',
  'ID' => 'Idaho',
  'IL' => 'Illinois',
  'IN' => 'Indiana',
  'IA' => 'Iowa',
  'KS' => 'Kansas',
  'KY' => 'Kentucky',
  'LA' => 'Louisiana',
  'ME' => 'Maine',
  'MD' => 'Maryland',
  'MA' => 'Massachusetts',
  'MI' => 'Michigan',
  'MN' => 'Minnesota',
  'MS' => 'Mississippi',
  'MO' => 'Missouri',
  'MT' => 'Montana',
  'NE' => 'Nebraska',
  'NV' => 'Nevada',
  'NH' => 'New Hampshire',
  'NJ' => 'New Jersey',
  'NM' => 'New Mexico',
  'NY' => 'New York',
  'NC' => 'North Carolina',
  'ND' => 'North Dakota',
  'OH' => 'Ohio',
  'OK' => 'Oklahoma',
  'OR' => 'Oregon',
  'PA' => 'Pennsylvania',
  'RI' => 'Rhode Island',
  'SC' => 'South Carolina',
  'SD' => 'South Dakota',
  'TN' => 'Tennessee',
  'TX' => 'Texas',
  'UT' => 'Utah',
  'VT' => 'Vermont',
  'VA' => 'Virginia',
  'WA' => 'Washington',
  'WV' => 'West Virginia',
  'WI' => 'Wisconsin',
  'WY' => 'Wyoming',
);



// Loads All venue IDs for all upcoming events accross the country
 function loadUpcomingMetroArea($usStates,$APIKey,$con) { 
 reset($usStates); //iterare through states
 $MetroArray = array(); //declares array to store metro areas
 
 while (list($key, $value) = each($usStates)) {
    // echo" This Is The State: ", $value, "<br>";
 	$MetroAreadIDs = "http://api.songkick.com/api/3.0/search/locations.json?query=$value&apikey=$APIKey"; // get the metro area results for the particular state
 	$MetroResponse = file_get_contents($MetroAreadIDs); 
 	$json_metro =  json_decode($MetroResponse,true);
 	$totalEntries= $json_metro['resultsPage']['totalEntries']; //set total number of entries for the state
 
	
	
 	for($i=0; $i<=$totalEntries; $i++) {
 		$metroID = $json_metro['resultsPage']['results']['location'][$i]['metroArea']['id']; // return a list of venue id's from that state
		
 		
 		//fwrite($f, $metroID.PHP_EOL); // write to a file
		
		$array[i]['state'] = $value;
		$array[i]['id'] = $metroID;
		$stateID = join("_",$array[i]);  //create unique ID
		$StateInsert = $array[i]['state'];
		$IDInsert= $array[i]['id'];	
		
		
		//NEED TO DEDUPE THEN INSERT INTO DB
	//	echo "This is state ID --> ", $stateID, "<p>";
	//	echo "State: ", $array[i]['state'], " - MetroID: ", $array[i]['id'], "<p>";
		
	//echo " State ID: ", $stateID, "<p>";
	//echo " State Insert: ", $StateInsert, "<p>";
	//echo " ID Insert: ", $IDInsert, "<p>";	
			
		mysqli_query($con,"INSERT INTO Metro_ID (UniquID, State, ID)
		VALUES ('$stateID', '$StateInsert','$IDInsert')");
		//echo $IDInsert;
	
	}
 }
 
} 
 





function getVenueID($metroID, $APIKey){

$Metroupcoming = "http://api.songkick.com/api/3.0/metro_areas/$metroID/calendar.json?apikey=$APIKey";
$UpcomingResponse = file_get_contents($Metroupcoming); 
$json_upcoming =json_decode($UpcomingResponse,true);
 
//NEXT STEP -> Take metro response and parse for venue and zip   
 
print_r($json_upcoming);



}

 


?>
