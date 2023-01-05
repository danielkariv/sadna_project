<?php
   //session_destroy();
   //$_SESSION['username'] ="";
   session_start();
   session_destroy();
   header("Location: /sadna_project/index.php");
   die();
?>
