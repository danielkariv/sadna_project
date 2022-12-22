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
			   
		   }
	  }		  
?>
   <div class="container">
  <form role="form" method="post" >
   <div class="row">
   <div class="col-2">
     User Name
	 </div>
<div class="col-9">
<input type="text"  id="inputUser" name="user" placeholder="Username">
          <?php echo $errName; ?>
   </div>
   </div>
   <div class="row">
   <div class="col-2">
   Password
   </div>
<div class="col-9">
<input type="password"  id="inputPassword" name="password" placeholder="Password">
          <?php echo $errPass; ?>
   </div>
   </div>
   <div class="row">
   <div class="offset-2 col-9">
<input type="submit" value="Log in" name="submit" class="btn btn-primary"/>
   </div>
   </div>
   
   </form>
   
   </div>
</body>
</html> 
