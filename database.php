<?php

   $db_server = "localhost127.0.0.1/";
   $db_user = "root";
   $db_pass = "";
   $db_name = "emedb";
   $conn = "";

   $conn = mysqli_connect($db_server,
                         $db_user,
                         $db_pass,
                         $db_name);
    if($conn){
        echo"You are connected!";
    } 
    else{
       echo"Could not connect"; 
    }   
              
?>