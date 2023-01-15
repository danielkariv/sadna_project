<html lang="en">
<head>
</head>
<body>

<?php 
   
   include 'header.php';
   $err= "";
   $show=True;
    if (isset ($_GET['Id']))
    {
		$sql = "SELECT DISTINCT *
                FROM MyNetflixList.Shows as s
                WHERE Id = '". $_GET['Id'] ."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
			$row = $result->fetch_assoc();
			 $title = $row['Title'];
		
             if (empty( $_SESSION['username']))
			 {
				  header("Status: 301 Moved Permanently");
               header("Location: /sadna_project/Login.php"); 
			 }

             else
			 {				 
			 if (isset ($_POST['submit']))
			 {
				  $sql2 = "INSERT INTO mynetflixlist.showstatus (  ShowID,Username ,StatusType )
                    VALUES (".$_GET['Id'].",'".$_SESSION['username']."',".$_POST['Status'].");";
					// $result2 = $conn->query($sql2);	
                     try {
                if ($conn->query($sql2) === TRUE) 
				{
                   // echo "New record created successfully";
                   // header("Location: /sadna_project/index.php");
                       $t=5;
					//   header("Status: 301 Moved Permanently");
                    header("Location: /sadna_project/UserList.php?Username=".$_SESSION['username']); 
                   // $conn->close();

                   
                } 
				
				else {
                    $errReVIEW = "You already posted" ;
					 header("Location: /sadna_project/UserList.php?Username=".$_SESSION['username']); 
                }
            }
            catch(Exception $e){
               $errReVIEW = "You already posted" ;
			    header("Location: /sadna_project/UserList.php?Username=".$_SESSION['username']); 
            }					 
			 }
			 }
        {
			
		}
		}
		else
		{
			$show= False;
		}
		
		
		
	}
   
   ?>
   <div class="container panel col-4">
  <form role="form" method="post" <?php if (!$show) echo "hidden"?> >
  
    <div class="form-outline mb-4">
        <label class="form-label" for="username">Name: </label>
        <label class="form-label" for="username"><?php echo $title ?> </label>
      
    </div>
  
    
    <div class="form-outline mb-4">
        <label class="form-label" for="Status">Status:</label>
        <select class="custom-select col-3" name="Status" id="Status">
                  <option value=0>Watching</option>
				 <option selected value=1>Completed</option>
                    <option value=2>On-Hold</option>
					 <option value=3>Dropped</option>
					  <option value=4>Plan To Watch</option>
					  
                </select>
       
    </div>
  
    <!-- Submit button -->
    <input type="submit" name="submit" class="btn red-button btn-primary btn-block mb-4" value="Add to list"/>
    <p style="color:red;"><?php echo $err;?></p>
    <!-- Register buttons -->
   
  </form>
  <form role="form" method="post" <?php if ($show) echo "hidden"?> >
     <h1>Cant find show with this ID</h1>
  </form>
</div>
   
</body>

</html>
