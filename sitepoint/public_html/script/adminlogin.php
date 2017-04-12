<?php
 define('DB_HOST', 'localhost');
 define('DB_NAME', 'programmerlogin');
 define('DB_USER','root');
 define('DB_PASSWORD','');
 $con=($GLOBALS["___mysqli_ston"] = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)) or die("Failed to connect to mysql: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
 $db=((bool)mysqli_query($con, "USE " . constant('DB_NAME'))) or die("Failed to connect to mysql: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
 function SignIn()
{
 session_start(); //starting the session
 $user = $_GET['mail'];
 $pass = $_GET['password'];
 if(!empty($user))
 {
     $query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM userName where userName = '$user' AND pass = '$pass'")  or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
     if(mysqli_num_rows($query)>0)
     {
     $row = mysqli_fetch_array($query) or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
     $username = $row['userName'];
     $_SESSION['userName'] = $user;
     $api = $row['apikey'];
     $_SESSION['apikey'] = $api;
     // header( 'Location: programmer.php' );
     echo "1";

     }
     else
     {
      echo "Wrong combination of username and password";

     }
 }
else
 {
  echo "You didn't enter a username";

 }
}
 SignIn();
?>