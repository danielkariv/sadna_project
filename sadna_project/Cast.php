<html>
<head>
<?php
 include 'header.php';
 
   if (isset ($_GET['Id']))
    {
		//if not found
		  $found='False';
		//  $servername = "localhost";
		//  $username = "root";
		// $password = "";
		//  $dbname = "MyNetflixList";
		// Create connection
		// $conn = new mysqli($servername, $username, $password);

        // Check connection
        if (mysqli_connect_error()) {
            // TODO: redirect to 502 page? or do that it can't load anything?
            die("Database connection failed: " . mysqli_connect_error());
        }
        # echo "Connected successfully";
        // Try to query first slider data
        $sql = "SELECT *  FROM MyNetflixList.Persons WHERE ID=" .$_GET['Id'].";";
                            
        $result = $conn->query($sql);
		
		 if ($result->num_rows > 0){
			 $found='True';
            $row = $result->fetch_assoc();
			
			 $castname = $row['Name'];
            $birth = $row['BirthYear'];
            $death = $row['DeathYear'];
			$Prof= $row['Profession'];
		 }
		 else
		 {
		 }
		 		 		
	}
?>
</head>
<body>
  <div class="container panel">
    <div class="row">
	      <h1><?php echo $castname?></h1>
		  <?php if  (!empty( $birth)) {
			  echo '<br>';
			  echo '<h3>Birth: '.$birth.'</h3> ';			  
		  }	
		  if  (!empty( $death)) {
			  echo '<br>';
			  echo '<h3>Death: '.$death.'</h3> ';			  
		  }	
		  if  (!empty( $Prof)) {
			  echo '<br>';
			  echo '<h3>Profession: '.$Prof.'</h3> ';			  
		  }	
		  ?>
	</div>
	<div class="row" >
	     <h3>Works: </h3>
		 <br>
		 <ul class="list-group">
		 <?php 
		    $sql2= "SELECT DISTINCT *
              FROM MyNetflixList.Shows
              WHERE Id = ANY
                (SELECT DISTINCT ShowID
               FROM MyNetflixList.Cast
                WHERE PersonID = ".$_GET['Id'].");";
				 $result2 = $conn->query($sql2);
				 
				 for ($i=0; $i< $result2->num_rows ;$i++ )
				 {
					$row2 = $result2->fetch_assoc();
					//echo '<a href="Show.php?Id='. $row2['Id'].'"  >'.$row2['Title'].' </a>' ; 
					$title = $row2['Title'];
					$poster = ($row2['Poster'] == NULL || $row2['Poster'] == 'N/A')? "public/no-poster.png" : $row2['Poster'];
					echo "<li class='list-group-item'>
						<a href='Show.php?Id=".$row2['Id']."'>
							<div class='row'>
								<div class='col-2'>
									<img class='img-fluid' src='". $poster. "' alt='". "Poster for". $title."'>
								</div>
								<div class='col'>". $title ."</div>
							</div>
						</a>
					</li>";
				 }
		 ?>
		</ul>
	 <div>
	      
	 </div>
	</div>
  </div>
</body>

</html>
