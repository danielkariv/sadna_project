<?php  
session_start();
 $search_kind = "Users";
 
  if (isset ($_GET['commit']))
  {
	  if (isset ($_GET['search']) && !empty($_GET['search']) )
	  {
		  header("Status: 301 Moved Permanently");
		  $getsvar="?searchthis=".$_GET['search']."&searchtype=".$_GET['searchkind'];
		 header("Location: /sadna_project/search.php" . $getsvar );  
		 exit;
	  }
  }
 

?>

<html lang="en" data-bs-theme="dark">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>My Netflix List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="templates\stylesheet.css" rel="stylesheet">
  
</head>
<body>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<nav class="navbar">
       <div class="col-4">
                <a class="navbar-brand" href="/sadna_project/">My Netflix List</a>
            </div>
		<div class="col-4">
                <form class="form-inline" style="margin:0px"  accept-charset="UTF-8" method="get">
                    <div class="input-group flex-fill">
                        <input  name="search" id="search" value="" placeholder="" class="form-control" aria-label="Search this site">
                        <div class="input-group-append">
                            <input type="submit" name="commit" value="Search" class="btn red-button btn-primary" >
                        </div>
                    </div>
					<input type="radio" name="searchkind"
                    <?php if (isset($search_kind) && $search_kind=="Users") echo "checked";?>
                         value="Users">Users
               <input type="radio" name="searchkind"
                <?php if (isset($search_kind) && $search_kind=="Netflix") echo "checked";?>
                        value="Netflix">Netflix
                </form>
            </div>	
	  <div class="col-4 d-flex justify-content-end">
	         <?php 
               if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                  echo 'Hello '  ;
				  echo $_SESSION['username'];
				    echo '<a href="/sadna_project/Logout.php"  >log out </a>' ;  
                   } 
			    else
				{ 
					//echo 'Hello guest';
					//echo '<br>';
					//echo '<a href="/sadna_project/Login.php"  >log in </a>' ;
					//echo '<br>';
					//echo '<a href="/sadna_project/Register.php"  > sigh up </a>';
					echo  '<button type="button" class="btn red-button btn-primary" onclick="window.location.href=\'/sadna_project/Login.php\';" >Login</button>';
                    echo  '<button type="button" class="btn btn-secondary" onclick="window.location.href=\'/sadna_project/Register.php\';"  >Sign-up</button>';
					
				}
			 ?>
	  </div>
   
   </div>
</nav>
 <script href="https://unpkg.com/@popperjs/core@2"></script>
        <script href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
