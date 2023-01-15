<?php

  include_once "header.php";
  
  $useronline="";
  $moveto="Location: /sadna_project/";
  if (isset($_SESSION['username']))
  {
	   $useronline=$_SESSION['username'];
  }
  
  if (isset($_GET['type']))
  {
  if ($_GET['type'] =='commant')
  {
	  //Cheking if the user can delete.
	      
	   if (isset($_GET['Id']))
	   {
		    $sql="SELECT  *  FROM MyNetflixList.Comments WHERE Id=".$_GET['Id'].";";
			  $result = $conn->query($sql);
                            if ($result->num_rows > 0){
								$row = $result->fetch_assoc();
								
			   if ($row['UsernameWall']== $_SESSION['username'] || $row['UsernamePost']== $_SESSION['username'])
			   {
		     $sql2 = "DELETE FROM MyNetflixList.Comments WHERE Id=".$_GET['Id'].";";
					// $result2 = $conn->query($sql2);	
                     try {
                if ($conn->query($sql2) === TRUE) 
				{
                   // echo "New record created successfully";
                   // header("Location: /sadna_project/index.php");
                       $t=5;
					//   header("Status: 301 Moved Permanently");
				
                   $moveto= "Location: /sadna_project/UserList.php?Username=".$_GET['Before']; 
                   // $conn->close();

                   
                } 
				
				else {
                        
					  $moveto="Location: /sadna_project/UserList.php?Username=".$_GET['Before']; 
                }
            }
            catch(Exception $e){
               $errReVIEW = "You already posted" ;
			 
			   $moveto="Location: /sadna_project/UserList.php?Username=".$_GET['Before']; 
            }
			   }
							}			
	   }
  }
  
  if ($_GET['type'] =='showitem')
  {
	   if (isset($_GET['Id']))
	   {
		      $sql="DELETE FROM MyNetflixList.ShowStatus WHERE ShowID=".$_GET['Id']." AND Username='".$useronline."' ;";
			    try {
                if ($conn->query($sql) === TRUE) 
				{
                   // echo "New record created successfully";
                   // header("Location: /sadna_project/index.php");
                       $t=5;
					//   header("Status: 301 Moved Permanently");
				
                   $moveto="Location: /sadna_project/UserList.php?Username=".$_GET['Before']; 
                   // $conn->close();

                   
                } 
				
				else {
                        
					 $moveto="Location: /sadna_project/UserList.php?Username=".$_GET['Before']; 
                }
            }
            catch(Exception $e){
               $errReVIEW = "You already posted"  ;
			
			    $moveto="Location: /sadna_project/UserList.php?Username=".$_GET['Before']; 
            }
			  
	   }
  }
  if ($_GET['type'] =='review')
  {
	   if (isset($_GET['Id']))
	   {
		      $sql="DELETE FROM MyNetflixList.Reviews WHERE ShowID=".$_GET['Id']." AND Username='".$useronline."' ;";
			    try {
                if ($conn->query($sql) === TRUE) 
				{
                   // echo "New record created successfully";
                   // header("Location: /sadna_project/index.php");
                       $t=5;
					//   header("Status: 301 Moved Permanently");
					
                  $moveto="Location: /sadna_project/Show.php?Id=".$_GET['Before']; 
                   // $conn->close();

                   
                } 
				
				else {
                        
					 $moveto="Location: /sadna_project/Show.php?Id=".$_GET['Before']; 
                }
            }
            catch(Exception $e){
               $errReVIEW = "You already posted" ;
			 
			    $moveto="Location: /sadna_project/Show.php?Id=".$_GET['Before']; 
            }
			  
	   }
  }
  }
  
    header("Status: 301 Moved Permanently");
			     header($moveto); 


?>