<?php  

     include 'header.php';
    if (isset ($_GET['Id']))
    {
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
 
   ?>
    <!-- container for content-->
        <div class="container panel">
            <div class="row">
                <div class="col-4 d-flex justify-content-center ">
                    <img class="img-fluid" src=<?php echo '"'.$poster.'"'?> alt="...">
                </div>
                <div class="col-8">
                    <h1><?php echo $title?></h1>
                    <h3><?php echo ($isMovie)? 'Movie':'TV Show';?>, Filmed at <?php echo ($country != NULL)?$country:'Unknown Location'?></h3>
                    <h3>Rated: <?php echo $rating?>, Duration: <?php echo $duration?>, Released <?php echo $releaseYear?></h3>
                    <h3>Description:</h3>
                    <p><?php echo $description?></p>
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
                                    //echo "Test" . $row['Title'];
                                    echo "<li class='list-group-item'>
                                        <div class='container'>
                                            <h4>Review by <a>". $row['Username']."</a>, written at ". $row['Date'].".</h4>
                                            <h4>Rating: ". $row['Rating'] ."/5" . "</h4>
                                            <p>
                                                ". $row['Message']."
                                            </p>
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
