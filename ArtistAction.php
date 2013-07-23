
	  <?php 
	  
	  
	  include 'functions.php';
	  $APIKey = thh9m4SDdUUefyIt; //Songkick API call
	  // Create connection
	  $con=mysqli_connect("localhost","root","root","Tour_Builder");

	  // Check connection
	  if (mysqli_connect_errno($con))
	    {
	    echo "Failed to connect to MySQL: " . mysqli_connect_error();
	    }
		
	 loadUpcomingMetroArea($usStates,$APIKey,$con); //loaded metro areas into DB but with duplicates
	  
	  //NEED TO WRITE CODE TO REMOVE DUPES FROM DB
	  
	  
	  getVenueID("8474", $APIKey);
	
	
	
	
	 ?>
      
