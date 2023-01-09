<?php  
    if (isset ($_GET['Username']))
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "MyNetflixList";
        // Create connection
        $conn = new mysqli($servername, $username, $password);

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
            $conn->close(); 
            header("Status: 301 Moved Permanently");
            header("Location: /sadna_project/index.php");  
            exit;
        }
        $conn->close(); 
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
    include 'header.php';
    ?>

    <div class="container">
            <h1><?php echo $accountName . "(". $data_username. ")"?></h1>
            <h4>Joined at: <?php echo $registerDate ?> , Last seen at: <?php echo $lastOnline ?></h4>
            <div class="row">
                <div class="col-5">
                    <h5>Shows List:</h5>
                    <ul class="list-group">
                        <?php  
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "MyNetflixList";
                            // Create connection
                            $conn = new mysqli($servername, $username, $password);

                            // Check connection
                            if (mysqli_connect_error()) {
                                // TODO: redirect to 502 page? or do that it can't load anything?
                                die("Database connection failed: " . mysqli_connect_error());
                            }
                            # echo "Connected successfully";
                            // Try to query first slider data
                            $sql = "SELECT DISTINCT s.Id, s.Title, s.Poster, ss.StatusType
                                    FROM MyNetflixList.ShowStatus AS ss JOIN MyNetflixList.Shows AS s
                                    ON ss.ShowID = s.Id
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
                                    echo "<li class='list-group-item'>
                                            <div class='row'>
                                                <div class='col-2'>
                                                    <img class='img-fluid' src='". $poster. "' alt='". "Poster for". $title."'>
                                                </div>
                                                <div class='col'>". $title ."</div>
                                                <div class='col-3'>
                                                    " . $status."
                                                </div>
                                            </div>
                                        </li>";
                                }
                            }
                            $conn->close(); 
                        ?>
                    </ul>
                </div>
                <div class="col-7">
                    <h5>Wall:</h5>
                    <ul class="list-group">
                    <?php  
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "MyNetflixList";
                            // Create connection
                            $conn = new mysqli($servername, $username, $password);

                            // Check connection
                            if (mysqli_connect_error()) {
                                // TODO: redirect to 502 page? or do that it can't load anything?
                                die("Database connection failed: " . mysqli_connect_error());
                            }
                            # echo "Connected successfully";
                            // Try to query first slider data
                            $sql = "SELECT DISTINCT *
                                    FROM MyNetflixList.Comments AS c
                                    WHERE c.UsernameWall LIKE 'abc'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $isShown = $row['isShown'];
                                    if ($isShown == FALSE){
                                        continue;
                                    }
                                    $username = $row['UsernamePost'];
                                    $date = $row['Date'];
                                    $message = $row['Message'];
                                    echo "<li class='list-group-item'>
                                            <div class='row'>
                                                <div class='col-3'>
                                                    <div class='col-12'>". $username."</div>
                                                    <div class='col-12'>". $date."</div>
                                                </div>
                                                <div class='col-9'>
                                                    ". $message."
                                                </div>
                                            </div>
                                        </li>";
                                }
                            }
                            $conn->close(); 
                        ?>
                    </ul>
                </div>
            </div>
        </div>
</body>
</html>