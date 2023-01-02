<html lang="en">
<head>
</head>
<body>
<?php 
   
   include 'header.php';
   
    $errName="";
   $errPass="";
    if (isset($_POST['user']))
	{
  $name =$_POST['user'];
	}
 if (isset($_POST['password']))
 {
  $password= $_POST['password'];
 }
 if (isset($_POST['confpassword']))
 {
  $confpassword= $_POST['confpassword'];
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
		  if ($password != $confpassword)
		  {
			   $errPass =  $errPass . ' ' . " Password dont match" ;
		  }
		  
		   if ( !empty($name) && !empty($password) && $password != $confpassword  )
		   {
			
			    header("Location: /sadna_project/index.php");
               die();
			   
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
					<?php echo  $errName ;?>
                </div>
                
                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" name ="password"id="password" class="form-control" />
					<?php echo  $errPass ;?>
                </div>

                <!-- Account Name input -->
                 <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="password">Confirm Password</label>
                    <input type="password" name ="confpassword" id="confpassword"  class="form-control" />
                </div>
                
                <!-- Submit button -->
              <input type="submit" name="submit" class="btn red-button btn-primary btn-block mb-4" value="Sign up"/>
                
                <!-- Login buttons -->
                <div class="text-center">
                    <p>Get a member already? <a href="#!">Login</a></p>
                </div>
                </form>
        </div>
</body>
</html>
