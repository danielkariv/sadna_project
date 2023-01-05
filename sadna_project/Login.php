<html lang="en">
<head>
</head>
<body>

<?php 
   
   include 'header.php';
  $errName="";
  $errPass="";
  $errLogin="";
  if (isset($_POST['user']))
  {
    $name =$_POST['user'];
  }
  if (isset($_POST['password']))
  {
    $password= $_POST['password'];
  }
  if (isset ($_POST['submit']))
  {
    if ($name =="")
    {
      $errName = "Enter username";
    }
    if ($password =="")
    {
      $errPass= "Enter password" ;
    }
    if ( !empty($name) && !empty($password) )
    {
      // We got username and password, try to login.
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
              WHERE Username = '". $_POST['user'] ."' AND Password = '". $_POST['password'] ."';";
      $result = $conn->query($sql);
      if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['username']= $row['Username'];
        $_SESSION['accountName']= $row['AccountName'];
        $conn->close(); 
        header("Location: /sadna_project/index.php");
        die();
      }
      else{
        $errLogin = "Failed to login, check you username/password.";
      }
    }
    
  }		  
?>
<div class="container panel col-4">
  <form role="form" method="post" >
  <!-- Username input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="username">Username</label>
        <input type="text" id="username" name="user" class="form-control" />
        <p style="color:red;"><?php echo  $errName ;?></p>
    </div>
  
    <!-- Password input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" />
        <p style="color:red;"><?php echo  $errPass ;?></p>
    </div>
  
    <!-- Submit button -->
    <input type="submit" name="submit" class="btn red-button btn-primary btn-block mb-4" value="Sign in"/>
    <p style="color:red;"><?php echo $errLogin;?></p>
    <!-- Register buttons -->
    <div class="text-center">
      <p>Not a member? <a href="#!">Sign Up</a></p>
    </div>
  </form>
</div>
</body>
</html> 
