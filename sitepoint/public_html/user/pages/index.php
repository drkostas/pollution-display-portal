<!DOCTYPE html>
<html lang="en">
<?php
	error_reporting(E_ERROR | E_PARSE);
    session_start();
    session_regenerate_id();
    if(!isset($_SESSION['userName']))      // if there is no valid session
    {
         header("Location: ../../index.php?message=Lathos kodikos");
      
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rupoi";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    }     
    function deleterow() 
   {
       ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost",  "root",  ""))or die("cannot connect");   
       ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . "rupoi"))or die("cannot select DB");
       $kodikos=$_GET['delete'];
       $sql1 = "DELETE FROM stathmos WHERE kodikos='$kodikos'";
       $sql2 = "DELETE FROM ripos WHERE kodikos='$kodikos'";
       $sql3 = "DELETE FROM daily WHERE kodikos='$kodikos'";
       $result1 = mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
       $result2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql2);
       $result3 = mysqli_query($GLOBALS["___mysqli_ston"], $sql3);
   } 
    
   
   function uploadcsv()
    {
        // echo "<br><br><br>Post:<br>";
        // echo $_POST['csv']['name'];
        // echo $_POST['StationpositionX'];

        $target_file = pathinfo($_FILES[$_POST['csv']['name']]);
        $newname = "csv.".txt; 
        $target_dir = '../../../files/csv/'.$newname;
        move_uploaded_file( $_FILES['csv']['tmp_name'], $target_dir);
        
        $con = mysqli_init();
        mysqli_options($con, MYSQLI_OPT_LOCAL_INFILE, 1);
        $link = mysqli_real_connect($con,"localhost", "root", "","rupoi")or die("cannot connect");
        
        $kodikos =  $_POST['Stationcode'];
        $onoma =  $_POST['Stationname'];
        $ripos =  $_POST['ripos'];
        $geogr_mikos =  $_POST['StationpositionX'];
        $geogr_platos =  $_POST['StationpositionY'];
        
            $import1 = "INSERT INTO stathmos VALUES ('$kodikos', '$onoma', '$geogr_mikos','$geogr_platos');";
            
            if(!mysqli_query($con, $import1))
        {
            echo "ERROR: Could not able to execute  first $import1. " . mysqli_error($con);
        }
            $import2 = "INSERT INTO ripos VALUES ('$kodikos', '$ripos');";
            if(!mysqli_query($con, $import2))
        {
            echo "ERROR: Could not able to execute second $import2. " . mysqli_error($con);
        }
            
            $import3 = "
                        LOAD DATA LOCAL INFILE '".$target_dir."'
                        INTO TABLE daily FIELDS TERMINATED BY ',' 
                        OPTIONALLY ENCLOSED BY '\"'
                        LINES TERMINATED BY '\r\n'
                        (@date,t00,t01,t02,t03,t04,t05,t06,t07,t08,t09,t10,t11,t12,t13,t14,t15,t16,t17,t18,t19,t20,t21,t22,t23)
                        SET imerominia = STR_TO_DATE(@date, '%d-%m-%Y'),
                        kodikos = '$kodikos',
                        eidos_ripou = '$ripos';
                        ";

                        if(!mysqli_query($con, $import3))
        {
            echo "ERROR: Could not able to execute third $import3. " . mysqli_error($con);
        }
        for ($r=0; $r <10 ; $r++) { 
          $import4 = "UPDATE daily  SET t0".$r."=0 WHERE t0".$r."=-9999;";
          if(!mysqli_query($con, $import4))
          {
            echo "ERROR: Could not able to execute loop1 $import4. " . mysqli_error($con);
          }
          $import5 = "UPDATE daily  SET t1".$r."=0 WHERE t0".$r."=-9999;";
          if(!mysqli_query($con, $import5))
          {
            echo "ERROR: Could not able to execute loop2 $import5. " . mysqli_error($con);
          }
        }

        $import6 = "UPDATE daily  SET t20=0 WHERE t20=-9999;";
         if(!mysqli_query($con, $import6))
        {
            echo "ERROR: Could not able to execute 6 $import6. " . mysqli_error($con);
        }

        $import7 = "UPDATE daily  SET t21=0 WHERE t21=-9999;";
         if(!mysqli_query($con, $import7))
        {
            echo "ERROR: Could not able to execute 7 $import7. " . mysqli_error($con);
        }
        $import9 = "UPDATE daily  SET t22=0 WHERE t22=-9999;";
         if(!mysqli_query($con, $import8))
        {
            echo "ERROR: Could not able to execute 8 $import8. " . mysqli_error($con);
        }
        $import9 = "UPDATE daily  SET t23=0 WHERE t23=-9999;";
         if(!mysqli_query($con, $import9))
        {
            echo "ERROR: Could not able to execute 9 $import9. " . mysqli_error($con);
        }
  			// $import4 = "UPDATE daily  SET t00=0 WHERE t00=-9999;UPDATE daily  SET t01=0 WHERE t01=-9999;UPDATE daily  SET t02=0 WHERE t02=-9999;UPDATE daily  SET t03=0 WHERE t03=-9999;UPDATE daily  SET t04=0 WHERE t04=-9999;UPDATE daily  SET t05=0 WHERE$import4 = "UPDATE daily  SET t00=0 WHERE t00=-9999; t05=-9999;UPDATE daily  SET t06=0 WHERE t06=-9999;UPDATE daily  SET t07=0 WHERE t07=-9999;UPDATE daily  SET t08=0 WHERE t08=-9999;UPDATE daily  SET t09=0 WHERE t09=-9999;UPDATE daily  SET t10=0 WHERE t10=-9999;UPDATE daily  SET t11=0 WHERE t11=-9999;UPDATE daily  SET t12=0 WHERE t12=-9999;UPDATE daily  SET t13=0 WHERE t13=-9999;UPDATE daily  SET t14=0 WHERE t14=-9999;UPDATE daily  SET t15=0 WHERE t15=-9999;UPDATE daily  SET t16=0 WHERE t16=-9999;UPDATE daily  SET t17=0 WHERE t17=-9999;UPDATE daily  SET t18=0 WHERE t18=-9999;UPDATE daily  SET t19=0 WHERE t19=-9999;UPDATE daily  SET t20=0 WHERE t20=-9999;UPDATE daily  SET t21=0 WHERE t21=-9999;UPDATE daily  SET t22=0 WHERE t22=-9999;UPDATE daily  SET t23=0 WHERE t23=-9999;";
        if(!mysqli_query($con, $import4))
        {
            echo "ERROR: Could not able to execute fourth $import4. " . mysqli_error($con);
        }
			
			mysqli_close($con);  
            // unlink($target_dir);
            // header("Location: index.php");  
    }
            
        

   if (isset($_GET['delete']))
   {
       deleterow();
   }

   if (isset($_GET['upload']))
   {
       uploadcsv();
   }
?>

    
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="../assets/css/userstyle.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script type="text/javascript" src="../../../assets/js/Script.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyDVWuhEEScGPSrcnDu4DQp30OCAmJoyMsQ"></script>
        <script type="text/javascript" src="../assets/js/userscript.js">
    </script>
        <title>Greek Pollution</title>
        
    </head>
    
    
<body>
  <div id="adminwrapper">
      <div>
        <h3><span id="whom">Hi </span> <span id="person"><?php echo $_SESSION["userName"]; ?></span></h3>
        <button id="adminlogout" onclick="showindex()">Log Out</button>
      </div>
      <br>
       <h2>Total Requests for each type</h2>
    <div id="adstations"></div> 
    <br>
    <h2>Stations' Info</h2>
    <div id="stationslist">
               
            <?php
                $sql = "SELECT kodikos, onoma, geogr_mikos, geogr_platos FROM stathmos";
                $result = $conn->query($sql);
            
                if ($result->num_rows > 0) 
                {
                 echo "<table><tr><th>Kodikos</th><th>Onoma stathmou</th><th>Topothesia</th></tr>";
                 // output data of each row
                 $counter=0;
                while($row = $result->fetch_assoc()) 
                {
                $counter= $counter+1;
                 echo "<tr><td>" . $row["kodikos"]. "</td><td>" . $row["onoma"]. "</td><td>" . $row["geogr_mikos"]. ", " . $row["geogr_platos"].' ' ;
                 ?>&nbsp;<button  class="stationbutton" id="erasebt" ><a href="index.php?delete=<?php echo $row["kodikos"]; ?>"> X  </a></button><br><?php
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
           
            <h4 id="csvuploadborder">Upload File In Database</h4>
            
            <div id="uploadcsvdiv">
                 <h4 id="mapborder">Press on the Map to get Lat,Lng automatically.</h4>
                <div id="dvMap" style="width: 300px; height: 300px;"></div>
                <form action="index.php?upload=1" method='POST' enctype="multipart/form-data" id="uploadcsvform">
                    Select Pollutant Type:<br>
                    <select id="lista" name="ripos">
                        <option value="CO">CO</option>
                        <option value="NO">NO</option>
                        <option value="NO2">NO2</option>
                        <option value="SO2">SO2</option>
                        <option value="O3">O3</option>
                    </select><br>
                    Station Name<br><input type="text" name="Stationname" class="inputs"><br>
                    Station Code<br><input type="text" name="Stationcode" class="inputs"><br>
                    Station position (X,Y)<br>
                    <input class="inputs" id="csvposx" type="text" name="StationpositionX">&nbsp;<input class="inputs" id="csvposy" type="text" name="StationpositionY"><br>
                    Select a file to upload:<br>
                    <input class="inputs" type="file"  name="csv" id="upload"/><br>
                    <input class="inputs" type="submit" value="Submit" id="submitcsv"/>
                </form>
               
            </div>
    </div>
  </div>

</body>
</html>