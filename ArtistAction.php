 <?php 
 include 'functions.php';
 $f = fopen("file.txt", "w")or die("can't open file");
 $APIKey = thh9m4SDdUUefyIt; //Songkick API call
 

loadUpcomingEvents($usStates,$APIKey,$f);
//getVenueID($APIKey);
 // NEED TO WRITE CALLS WHICH TAKE VENUE IDS AND GET ZIP CODE
 


file_put_contents('file.txt', implode(PHP_EOL, file('file.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES))); //trims empty entries
fclose($f); 
 
 

 
?>