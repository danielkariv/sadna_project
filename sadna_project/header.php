<?php  
session_start();
?>

<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="container">
   <div class="row">
      <div class="col-8">
	        My Netfix list
	  </div>
	  <div class="col-4">
	         <?php 
               if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                  echo 'Hello '  ;
				  echo $_SESSION['username'];
                   } 
			    else
				{
					echo 'Hello guest';
					echo '<br>';
					echo '<a href="/sadna_project/Login.php"  >log in </a>' ;
					echo '<br>';
					echo '<a href="/sadna_project/Register.php"  > sigh up </a>';
				}
			 ?>
	  </div>
   
   </div>
</div>

</body>
</html> 
