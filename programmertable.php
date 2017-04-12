<?php
    session_start();
    session_regenerate_id();
    if(!isset($_SESSION['userName']))      // if there is no valid session
    {
         header("Location: main.php");
      
    }
    $name = $_SESSION["userName"];     
    $api = $_SESSION["apikey"];
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
    $sql = "SELECT req1count, req2count, req3count, req4count, req5count, api  FROM statistics WHERE api ='" .$api ."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
     echo "<table><tr><th>Αίτηση συνόλου σταθμών</th><th>Αίτηση Απόλυτης τιμής ρύπου</th><th>Αίτηση μέσης τιμής ρύπανσης</th><th>Αίτηση min-max ημερομηνίας</th><th>Αίτηση διαθέσιμων ρύπων</th></tr>";
     // output data of each row
     $counter=0;
    while($row = $result->fetch_assoc()) 
    {
    $counter= $counter+1;
     echo "<tr><td>" . $row["req1count"]. "</td><td>" . $row["req2count"]. "</td><td>" . $row["req3count"]."</td><td>". $row["req4count"]."</td><td>". $row["req5count"] ;
     
     echo"</td></tr>";
     
    
    }
    echo "</table>";
    }
    
    else 
    {
      echo "0 results";
    }

    $conn->close();
            ?>