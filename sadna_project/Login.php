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
			   $_SESSION['username']= $name;
			    header("Location: /sadna_project/index.php");
               die();
			   
		   }
	  }		  
?>
   <div class="container panel col-4">
  <form role="form" method="post" >
   
  
  <!-- Username input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" name="user" class="form-control" />
					<?php echo  $errName ;?>
                </div>
              
                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" />
					<?php echo  $errPass ;?>
                </div>
              
                <!-- Submit button -->
                <input type="submit" name="submit" class="btn red-button btn-primary btn-block mb-4" value="Sign in"/>
              
                <!-- Register buttons -->
                <div class="text-center">
                  <p>Not a member? <a href="#!">Sign Up</a></p>
                </div>
   
   
   </form>
   
   </div>
</body>
</html> 
