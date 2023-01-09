<html lang="en">
<head>
</head>
<body>
<?php 
   
   include 'header.php';
   
   if (isset ($_GET['searchtype']) &&$_GET["searchtype"]== "Users")
   {
	    header("Status: 301 Moved Permanently");
		  $getsvar="?Username=".$_GET['searchthis'];
		 header("Location: /sadna_project/UserList.php" . $getsvar );  
		 exit;
   }
   
    if (isset ($_GET['searchtype']) &&$_GET["searchtype"]== "Netflix")
   {
	    header("Status: 301 Moved Permanently");
		  $getsvar="?Id=".$_GET['searchthis'];
		 header("Location: /sadna_project/Show.php" . $getsvar );  
		 exit;
   }
	   
   
   ?>
</body>
</html>