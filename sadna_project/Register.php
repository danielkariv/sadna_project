<html lang="en">
<head>
</head>
<body>
<?php 
   
   include 'header.php';

    $errName="";
    $errPass="";
    $errName = "";
    $errRegister ="";
    if (isset($_POST['user']))
    {
    $username =$_POST['user'];
    }
    if (isset($_POST['password']))
    {
    $password= $_POST['password'];
    }
    if (isset($_POST['confpassword']))
    {
    $confpassword= $_POST['confpassword'];
    }
    if (isset($_POST['accountName']))
    {
        $accountName= $_POST['accountName'];
    }
    if (isset ($_POST['submit']))
    {
        if ($username =="")
        {
            $errName = "Enter username";
        }
        if ($password =="")
        {
            $errPass= "Enter password" ;
        }
        if ($password != $confpassword)
        {
            $errPass =  $errPass . ' ' . " Password dont match" ;
        }
        if ($accountName == "")
        {
            $errName = "Enter Account Name";
        }
       
        if ( !empty($username) && !empty($password) && $password == $confpassword && !empty($accountName) )
        {
            // We got username and password, try to login.

          //  $db_servername = "localhost";
          //  $db_username = "root";
           // $db_password = "";
           // $dbname = "MyNetflixList";
            // Create connection
          //  $conn = new mysqli($db_servername, $db_username, $db_password, $dbname);


            // Check connection
            if (mysqli_connect_error()) {
                // TODO: redirect to 502 page? or do that it can't load anything?
                die("Database connection failed: " . mysqli_connect_error());
            }
            # echo "Connected successfully";
            // Try to query first slider data

            $sql = "INSERT INTO MyNetflixList.Users (Username, Password, AccountName, RegisterDate, LastOnline)
                    VALUES ('". $conn ->real_escape_string($username)."','". $conn ->real_escape_string($password) ."','". $conn ->real_escape_string($accountName) . "', now(),now());";
				//echo $sql;

            try {
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                    header("Location: /sadna_project/index.php");

                   // $conn->close();

                    die();
                } else {
                    $errRegister = "Failed to register, Error:" . $conn->error;
                }
            }
            catch(Exception $e){
                $errRegister = "Failed to register, username already taken.";
            }
            //$conn->close();
        }
    }
   
   
?>

<!-- container for content-->
        <div class="container panel col-4">
            <form role="form" method="post" >
                <!-- Username input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" name="user"id="user" class="form-control" />
					<p style="color:red;"><?php echo  $errName ;?></p>
                </div>
                
                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" name ="password"id="password" class="form-control" />
					<p style="color:red;"><?php echo  $errPass ;?></p>
                </div>

                
                 <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="confpassword">Confirm Password</label>
                    <input type="password" name ="confpassword" id="confpassword"  class="form-control" />
                </div>

                <!-- Account Name input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="accountName">Account Name</label>
                    <input type="text" name ="accountName" id="accountName"  class="form-control" />
                    <p style="color:red;"><?php echo  $errName ;?></p>
                </div>
                <!-- Submit button -->
              <input type="submit" name="submit" class="btn red-button btn-primary btn-block mb-4" value="Sign up"/>
              <p style="color:red;"><?php echo $errRegister?></p>
                <!-- Login buttons -->
                <div class="text-center">
                    <p>Get a member already? <a href="Login.php">Login</a></p>
                </div>
                </form>
        </div>
</body>
</html>
