<?php  


     include 'header.php';
	 $useronline="";
    if (isset ($_SESSION['username']))
	{ 
       $useronline = $_SESSION['username'];
	}
    if (isset ($_GET['Id']))
    {
		    $errReVIEW="";
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
        $sql = "SELECT DISTINCT *
                FROM MyNetflixList.Shows as s
                WHERE Id = '". $_GET['Id'] ."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $showId = $row['Id'];
            $isMovie = $row['isMovie'];
            $country = $row['CountryID'];
            if ($country != NULL){
                $sql = "SELECT DISTINCT *
                FROM MyNetflixList.Countries
                WHERE Id = '". $country ."';";
                $result = $conn->query($sql);
                $country = $result->fetch_assoc()['Name'];
            }
            $title = $row['Title'];
            $releaseYear = $row['ReleaseYear'];
            $rating = $row['Rating'];
            $duration = $row['Duration'];
            $description = $row['Description'];
            $poster = ($row['Poster'] == NULL)? "public/no-poster.png" : $row['Poster'];
			
			if (isset ($_POST['submit']))
        {
		   if (isset($_POST['mytextarea'])  && !empty($_POST['mytextarea']))
          {
               $review =$_POST['mytextarea'];
			   $rating=$_POST['rating'];
			    $sql2 = "INSERT INTO mynetflixlist.reviews (ShowID, Username, Message,Date,Rating )
                    VALUES (".$_GET['Id'].",'".$_SESSION['username']."','".$review."', now(),". $rating.");";
					// $result2 = $conn->query($sql2);	
                     try {
                if ($conn->query($sql2) === TRUE) 
				{
                   // echo "New record created successfully";
                   // header("Location: /sadna_project/index.php");
                       $t=5;
                   // $conn->close();
                        header("Status: 301 Moved Permanently");
                       header("Location: /sadna_project/Show.php?Id=".$_GET['Id']);  
                   
                } 
				
				else {
                    $errReVIEW = "You already posted your review!" ;
                }
            }
            catch(Exception $e){
               $errReVIEW = "You already posted your review!"  ;
            }					 
          }
		  
       }
            
        } else{
            header("Status: 301 Moved Permanently");
            header("Location: /sadna_project/index.php");  
            exit;
            // echo "empty";
            // TODO: it crash in some cases, like 'Showname=The Women' for the show "The Women's Balcony".
            //      Switch to showID instead of showname. we can place them in the links.
        }

       // $conn->close(); 

    } else{
        header("Status: 301 Moved Permanently");
        header("Location: /sadna_project/index.php");  
        exit;
    }
?>

<html lang="en">
<head>
</head>
<body>
    <?php 
    if  (isset($_SESSION['username'])) {
        $sql = "SELECT DISTINCT *
        FROM MyNetflixList.ShowStatus as ss
        WHERE ShowID = '". $_GET['Id'] ."' AND Username = '". $_SESSION['username']."';";
        $result = $conn->query($sql);
        
        $isNotInList = $result->num_rows == 0;
    } 
    else {
        $isNotInList = false;
    }
   
   ?>
    <!-- container for content-->
        <div class="container panel">
            <div class="row">
                <div class="col-4 d-flex justify-content-center ">
                    <img class="img-fluid" src=<?php echo '"'.$poster.'"'?> alt="...">
                </div>
                <div class="col-8">
				    <?php if (!empty( $_SESSION['username']) && $isNotInList) echo ' <input type="submit" name="addtolist" class="btn red-button btn-primary btn-block mb-4" value="Add to List" onclick="window.location.href = \'/sadna_project/Add_to_List.php?Id='.$_GET['Id'].'\';"/>' ?>
                    <h1><?php echo $title?></h1>
                    <h3><?php echo ($isMovie)? 'Movie':'TV Show';?>, Filmed at <?php echo ($country != NULL)?$country:'Unknown Location'?></h3>
                    <h3>Rated: <?php echo $rating?>, Duration: <?php echo $duration?>, Released <?php echo $releaseYear?></h3>
                    <h3>Description:</h3>
                    <p><?php echo $description?></p>
					<?php 
                    $sql = "SELECT ShowID,AVG(Rating) as Avg FROM MyNetflixList.Reviews
                            WHERE ShowID = " .$_GET['Id'] ."
                            GROUP BY ShowID;";
                    $result = $conn->query($sql);
                    if($result->num_rows != 0){
                        $row = $result->fetch_assoc();
                        $avg = $row['Avg'];
                        echo "<h3>User's average rating: ". number_format($avg,1) ."/5 </h3>";
                    }
                    if (!empty( $_SESSION['username'])){
                        $sql = "SELECT * FROM MyNetflixList.Reviews
                                WHERE ShowID = ". $_GET['Id']." AND Username = '" . $_SESSION['username'] . "';";
                        $result = $conn->query($sql);
                        $isReviewed = $result->num_rows != 0;
                    }
                    else{
                        $isReviewed = true;
                    }
                    ?>
                    <div class="container ">
                        <form role="form" method="post"  <?php  if (empty( $_SESSION['username']) || $isReviewed) echo "hidden" ?> >
                    
                        <div class="form-outline mb-4">
                        
                        </div>
                        <div class="form-outline mb-4">
                        <label class="form-label" >Your rating:</label>
                            <select class="custom-select col-3" name="rating" id="rating">
                                        <option selected value=1>1</option>
                                        <option value=2>2</option>
                                        <option value=3>3</option>
                                        <option value=4>4</option>
                                        <option value=5>5</option>
                                    </select>
                            <br>
                            <label class="form-label" for="password">Your review:</label>
                            <br>
                            <textarea name="mytextarea" cols="50"></textarea>
                            <br>
                            
                            <?php echo  $errReVIEW ?>
                        </div>
                    
                        <!-- Submit button -->
                        <input type="submit" name="submit" class="btn red-button btn-primary btn-block mb-4" value="Enter review"/>
                    
                        <!-- Register buttons -->
                        <div class="text-center">
                        
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <h3>Cast:</h3>
                    <ul class="list-group">
                    <?php 

                      //  $servername = "localhost";
                      //  $username = "root";
                      //  $password = "";
                       // $dbname = "MyNetflixList";
                        // Create connection
                     //   $conn = new mysqli($servername, $username, $password);


                        // Check connection
                        if (mysqli_connect_error()) {
                            // TODO: redirect to 502 page? or do that it can't load anything?
                            die("Database connection failed: " . mysqli_connect_error());
                        }
                        # echo "Connected successfully";
                        // Try to query first slider data

                        $sql2 = "SELECT DISTINCT *
                                FROM MyNetflixList.Persons
                                WHERE Id = ANY
                                (SELECT DISTINCT PersonID
                                FROM MyNetflixList.Cast
                                WHERE ShowID = " . $showId. ");";

                        $result2 = $conn->query($sql2);
                        if ($result2->num_rows > 0){
                            while($row2 = $result2->fetch_assoc()){
                                //echo "Test" . $row['Title'];
                                echo "<li class='list-group-item'><a href='". "Cast.php?Id=". $row2['Id']."'>".$row2['Name']."</a></li>";

                            }
                        } else{
                            // echo "empty";
                        }

                       // $conn->close(); 

                    ?>
                    </ul>
                </div>
                <div class="col-8">
                    <h3>Reviews:</h3>
                    <ul class="list-group">
                        <?php 

                          //  $servername = "localhost";
                          //  $username = "root";
                           // $password = "";
                          //  $dbname = "MyNetflixList";
                            // Create connection
                          //  $conn = new mysqli($servername, $username, $password);


                            // Check connection
                            if (mysqli_connect_error()) {
                                // TODO: redirect to 502 page? or do that it can't load anything?
                                die("Database connection failed: " . mysqli_connect_error());
                            }
                            # echo "Connected successfully";
                            // TODO: maybe sort it by date? need reviews first to check it.
                            $sql = "SELECT DISTINCT *
                                    FROM MyNetflixList.Reviews
                                    WHERE ShowID = " . $showId. ";";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
									$deleterew="";
									if (  ($row['Username']== $useronline))
									{
										$deleterew="<a href='Delete.php?type=review&Id=".$row['ShowID']."&Before=".$row['ShowID']."'>delete </a>";
									}
                                    //echo "Test" . $row['Title'];
                                    echo "<li class='list-group-item'>
                                        <div class='container'>
										     <div class='row'>
											 <div class='col-10' >
                                            <h4>Review by <a href='UserList.php?Username=".$row['Username']."'>". $row['Username']."</a></h4>
                                            </div>
											 <div class='col-2' >
											 ".$deleterew."
											 </div>
										   </div>
										    <div class='row'>
										   <h4>Rating: ". $row['Rating'] ."/5" . "</h4>
										   </div>
										    <div class='row'>
                                            <p>
                                                ". $row['Message']."
                                            </p>
											</div>
											 <div class='row'>
											  <div class='col-10' >
                                            
                                            </div>
											  <div class='col-2' style='font-size:12px' >". $row['Date']."</div>
                                        </div>
                                        </li>";
                                }
                            } else{
                                // echo "empty";
                            }

                           // $conn->close(); 

                        ?>
                        
                    </ul>
                </div>
            </div>
        </div>
</body>
</html>
