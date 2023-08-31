<?php

$button = $_GET ['submit'];
$search = $_GET ['search'];	

$con=mysqli_connect("localhost","root","","cs_sims");

	$sql ="SELECT * FROM research_tb WHERE MATCH(title) AGAINST ('%" . $search . "%')";
	
	$run = mysqli_query($con,$sql);
	$foundnum = mysqli_num_rows($run);
	
	if ($foundnum==0){
		echo "We were unable to find a thing with a search term of '<b>$search</b>'.";
	}
	else{
		echo "<h1><strong> $foundnum Results Found for \"" . $search ."\"</strong></h1>";
		
		$sql = "SELECT * FROM research_tb WHERE MATCH(title) AGAINST ('%" . $search . "%')";
		$getquery = mysqli_query($con, $sql);
		
		while($runrows = mysqli_fetch_array($getquery)){
			
			echo "<h5 class ='card-title'>". $runrows["title"] ."</h5>";
		}
	}
	
	mysqli_close($con);
	
?>


	
	