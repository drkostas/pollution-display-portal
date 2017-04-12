<?php

 function SignUp() 
{ 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "programmerlogin";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }     
     
    $mail = $_GET['mail'];
    $pass = $_GET['password'];
    $mailsalted = $mail. "ki8Gi90JSGh8shd7";
    $apikey = md5($mailsalted);
 if(!empty($mail)) 
 { 
     
    $sql = "INSERT INTO `userName` (`apikey`, `username`, `pass`) VALUES ('$apikey', '$mail', '$pass');";
    if(!mysqli_query($conn, $sql))
        {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
    $sql2 = "INSERT INTO `statistics` (`api`) VALUES ('$apikey');";
    if(!mysqli_query($conn, $sql2))
        {
            echo "ERROR: Could not able to execute $sql2. " . mysqli_error($conn);
        }
        mysqli_close($conn);
    echo "Signup Succesfull!, Your Api Key is: ".$apikey;
 }
    else 
     { 
      echo "You didn't enter a username"; 
      
     }
}
SignUp(); 

?>
