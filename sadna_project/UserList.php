<?php  
 include 'header.php';
 $errCommant="";
 $useronline="";
    if (isset ($_SESSION['username']))
	{ 
       $useronline = $_SESSION['username'];
	}
    if (isset ($_GET['Username']))
    {
       // $servername = "localhost";
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
        // Try to query first slider data
        $sql = "SELECT DISTINCT *
                FROM MyNetflixList.Users
                WHERE Username = '". $_GET['Username'] ."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $data_username = $row['Username'];
            $accountName = $row['AccountName'];
            $registerDate = $row['RegisterDate'];
            $lastOnline = $row['LastOnline'];
        } else{
          //  $conn->close(); 
            header("Status: 301 Moved Permanently");
            header("Location: /sadna_project/index.php");  
            exit;
        }
       // $conn->close(); 
	   if (isset ($_POST['submit']))
        {
		   if (isset($_POST['mytextarea'])  && !empty($_POST['mytextarea']))
          {
               $review =$_POST['mytextarea'];
			  // $rating=$_POST['rating'];
			    $sql2 = "INSERT INTO mynetflixlist.comments (UsernameWall, UsernamePost, Message,Date,isShown )
                    VALUES ('".$_GET['Username']."','".$_SESSION['username']."','".$review."', now(),True);";
					// $result2 = $conn->query($sql2);	
                     try {
                if ($conn->query($sql2) === TRUE) 
				{
                   // echo "New record created successfully";
                   // header("Location: /sadna_project/index.php");
                       $t=5;
                   // $conn->close();
                      header("Status: 301 Moved Permanently");
                       header("Location: /sadna_project/UserList.php?Username=".$_GET['Username']);  
                   
                } 
				
				else {
                   $errCommant = "You already posted" ;
                }
            }
            catch(Exception $e){
              $errCommant = "You already posted" ;
            }					 
          }
		  
       }
    } 
	
	
	else{
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

    <div class="container">
            <h1><?php echo $accountName . "(". $data_username. ")"?></h1>
            <h4>Joined at: <?php echo $registerDate ?> , Last seen at: <?php echo $lastOnline ?></h4>
            <div class="row">
                <div class="col-5">
                    <h5>Shows List:</h5>
                    <ul class="list-group">
                        <?php
                            // Check connection
                            if (mysqli_connect_error()) {
                                // TODO: redirect to 502 page? or do that it can't load anything?
                                die("Database connection failed: " . mysqli_connect_error());
                            }
                            # echo "Connected successfully";
                            // Try to query first slider data
                            $sql = "SELECT DISTINCT s.Id, s.Title, s.Poster, ss.StatusType, ss.Rating
                                    FROM MyNetflixList.ShowStatus AS ss JOIN MyNetflixList.Shows as s
                                    ON s.Id = ss.ShowID
                                    WHERE Username LIKE '". $data_username. "'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $poster = ($row['Poster'] == NULL)? "public/no-poster.png" : $row['Poster'];
                                    $title = $row['Title'];
                                    switch ($row['StatusType']){
                                        case 0:
                                            $status = 'Watching';
                                            break;
                                        case 1:
                                            $status = 'Completed';
                                            break;
                                        case 2:
                                            $status = 'On-Hold';
                                            break;
                                        case 3:
                                            $status = 'Dropped';
                                            break;
                                        case 4:
                                            $status = 'Plan To Watch';
                                            break;
                                        default:
                                            $status = 'ERR: unknown status code ('. $row['StatusType'] .')';
                                    }
									$deleteshow="";
									if (($_GET['Username'] == $useronline))
									{
									$deleteshow="<a href='Delete.php?type=showitem&Id=".$row['Id']."&Before=".$_GET['Username']."'>delete </a>";
									}
                                    $avgRating = $row['Rating'];
                                    echo "<li class='list-group-item'>
                                            <div class='row'>
                                                <div class='col-2'>
                                                    <img class='img-fluid' src='". $poster. "' alt='". "Poster for". $title."'>
                                                </div>
                                                <div class='col-5'>
                                                <a href='Show.php?Id=".$row['Id']."' >". $title ."</a>";
                                                if ($avgRating != NULL) echo "<h6>Rating: ".number_format($avgRating,1)."/5</h6>";
                                    echo "  </div>
                                            <div class='col-3'>
                                                " . $status."
                                            </div>
                                            <div class='col-2'>
                                                " . $deleteshow."
                                            </div>
                                            </div>
                                        </li>";
                                }
                            }
                          //  $conn->close(); 
                        ?>
                    </ul>
                </div>
                <div class="col-7">
				
		<form role="form" method="post"  <?php  if (empty($_SESSION['username']) || $_SESSION['username'] == $_GET['Username']) echo "hidden" ?> >		
        <label class="form-label" for="password">Your Commant:</label>
		<br>
         <textarea name="mytextarea" cols="50"></textarea>
		 <br>
		 
		
          <br>
		  <?php echo  $errCommant ?>
		  <br>
		  <input type="submit" name="submit" class="btn red-button btn-primary btn-block mb-4" value="Enter Commant"/>
		  </form>
		  
		  
   
                    <h5>Wall:</h5>
                    <ul class="list-group">
                    <?php  
                           // $servername = "localhost";
                           // $username = "root";
                            //$password = "";
                           // $dbname = "MyNetflixList";
                            // Create connection
                          //  $conn = new mysqli($servername, $username, $password);

                            // Check connection
                            if (mysqli_connect_error()) {
                                // TODO: redirect to 502 page? or do that it can't load anything?
                                die("Database connection failed: " . mysqli_connect_error());
                            }
                            # echo "Connected successfully";
                            // Try to query first slider data
                         /*   $sql = "SELECT DISTINCT *
                                    FROM MyNetflixList.Comments AS c
                                    WHERE c.UsernameWall LIKE 'abc'";
									*/
								$sql3 = "SELECT  *
                                    FROM MyNetflixList.Comments WHERE UsernameWall='".$_GET['Username']."';";	
								
                            $result3 = $conn->query($sql3);
                            if ($result3->num_rows > 0){
                                while($row = $result3->fetch_assoc()){
                                    $isShown = $row['isShown'];
                                    if ($isShown == FALSE){
                                        continue;
                                    }
                                    $username = $row['UsernamePost'];
                                    $date = $row['Date'];
                                    $message = $row['Message'];
									$idcommant=$row['Id'];
									$deletecommant="";
									if (($_GET['Username'] == $useronline) ||  ($username== $useronline))
									{
										$deletecommant="<a href='Delete.php?type=commant&Id=".$idcommant."&Before=".$_GET['Username']."'>delete </a>";
									}
                                    echo "<li class='list-group-item'>
                                            <div class='row'>
                                                <div class='col-3'>
                                                    <div class='col-12'><a href='UserList.php?Username=".$username."'>". $username."</a></div>
                                                    <div class='col-12' style='font-size:12px' >". $date."</div>
                                                </div>
                                                <div class='col-8'>
                                                    ". $message."
                                                </div>
												<div class='col-1'>
                                                    ". $deletecommant."
                                                </div>
                                            </div>
                                        </li>";
                                }
                            }
                          //  $conn->close(); 
                        ?>
                    </ul>
                </div>
            </div>
        </div>
</body>
</html>