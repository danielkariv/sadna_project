<html lang="en">
<head>
</head>
<body>
<?php 
   include 'header.php';
?>
<div class="container panel">
<ul class="list-group">
<?php

   if (isset ($_GET['searchtype']) &&$_GET["searchtype"]== "Users")
   {
      $search_text = $_GET['searchthis'];
      echo '<h1>Users found for query: "'.$search_text.'"</h1>';
     $sql = "SELECT DISTINCT *
               FROM MyNetflixList.Users
               WHERE Username LIKE '%". $search_text ."%';";
			   
			   
      
      $result = $conn->query($sql);
      if ($result->num_rows == 1){
         $row = $result->fetch_assoc();
         header("Status: 301 Moved Permanently");
         $getsvar="?Username=".$row['Username'];
         header("Location: /sadna_project/UserList.php" . $getsvar );  
      }
      else if ($result->num_rows > 0){
         while($row = $result->fetch_assoc()){
            if (!isset($row)){
               continue;
            }
            $data_username = $row['Username'];
            $accountName = $row['AccountName'];
            $registerDate = $row['RegisterDate'];
            $lastOnline = $row['LastOnline'];
            echo "<li class='list-group-item'>
                     <a href='UserList.php?Username=".$data_username ."'>
                     <div class='row'>
                        <div class='col'>". $accountName. '('.$data_username.')' ."</div>
                     </div>
                     </a>
                  </li>";
         }
      } else{
         echo "Couldn't find users with given query: ".$search_text;
      }
   }
   
    if (isset ($_GET['searchtype']) &&$_GET["searchtype"]== "Netflix")
   {
      $search_text = $_GET['searchthis'];
      echo '<h1>Shows found for query: "'.$search_text.'"</h1>';
    /*  $sql = "SELECT * 
               FROM MyNetflixList.Shows 
               WHERE MATCH (Title, Description) 
               AGAINST ('" . $search_text . "')
               ORDER BY Title ASC;";
      */
	  $sql = "SELECT * 
               FROM MyNetflixList.Shows 
               WHERE Title  LIKE '%". $search_text ."%'
               ORDER BY Title ASC;";
      $result = $conn->query($sql);
      if ($result->num_rows == 1){
         $row = $result->fetch_assoc();
         header("Status: 301 Moved Permanently");
         $getsvar="?Id=".$row['Id'];
         header("Location: /sadna_project/Show.php" . $getsvar );  
      }
      else if ($result->num_rows > 0){
         while($row = $result->fetch_assoc()){
            if (!isset($row)){
               continue;
            }
            $id = $row['Id'];
            $poster = ($row['Poster'] == NULL || $row['Poster'] == 'N/A')? "public/no-poster.png" : $row['Poster'];
            $title = $row['Title'];
            echo "<li class='list-group-item'>
                     <a href='Show.php?Id=".$id."'>
                     <div class='row'>
                        <div class='col-2'>
                           <img class='img-fluid' src='". $poster. "' alt='". "Poster for". $title."'>
                        </div>
                        <div class='col'>". $title ."</div>
                     </div>
                     </a>
                  </li>";
         }
      } else{
         echo "Couldn't find shows with given query: ".$search_text;
      }
   }
   ?>
   </ul>
</div>
</body>
</html>