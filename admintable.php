<?php
    session_start();
    session_regenerate_id();
    if(!isset($_SESSION['userName']))      // if there is no valid session
    {
         header("Location: index.php");
      
    }
    $name = $_SESSION["userName"];         
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
    $sql = "SELECT sum(req1count), sum(req2count), sum(req3count), sum(req4count), sum(req5count)  FROM statistics ";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) 
    {
     echo "<table><tr><th>Αίτηση συνόλου σταθμών</th><th>Αίτηση Απόλυτης τιμής ρύπου</th><th>Αίτηση μέσης τιμής ρύπανσης</th><th>Αίτηση min-max ημερομηνίας</th><th>Αίτηση διαθέσιμων ρύπων</th></tr>";
     // output data of each row
     $counter=0;
    while($row = $result->fetch_assoc()) 
    {
    $counter= $counter+1;
     echo "<tr><td>" . $row["sum(req1count)"]. "</td><td>" . $row["sum(req2count)"]. "</td><td>" . $row["sum(req3count)"]."</td><td>". $row["sum(req4count)"]."</td><td>". $row["sum(req5count)"] ;
     
     echo"</td></tr>";
     
    
    }
    echo "</table>";
    }
    
    else 
    {
      echo "0 results";
    }
    echo "<h2>Top 10 APIs με τις περισσότερες αιτήσεις</h2>";
    
    $sql2 = "SELECT s.api, s.req1count+s.req2count+s.req3count+s.req4count+s.req5count AS sinolo , u.userName FROM statistics s INNER JOIN userName u ON u.apikey=s.api ORDER BY sinolo DESC LIMIT 10";
    $result2 = $conn->query($sql2);
    
    if ($result2->num_rows > 0) 
    {
     echo "<table><tr><th>APIkey</th><th>Username</th><th>Σύνολο αιτήσεων</th></tr>";
     // output data of each row
     $counter=0;
    while($row = $result2->fetch_assoc()) 
    {
    $counter= $counter+1;
     echo "<tr><td>" . $row["api"]. "</td><td>" . $row["userName"]. "</td><td>" . $row["sinolo"] ;
     
     echo"</td></tr>";
     
    
    }
    echo "</table>";
    }
    
    else 
    {
      echo "0 results";
    }
    
    $sql3 = "SELECT count(distinct api) FROM statistics ";
    $result3 = $conn->query($sql3);
    $row = $result3->fetch_assoc();
    echo "Αριθμός api keys που έχουν εκδοθεί: " . $row["count(distinct api)"];
    $conn->close();
            ?>