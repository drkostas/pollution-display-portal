<?php
    $apikey = $_GET['apikey'];
    
    // Create connection
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'programmerlogin'); 
     define('DB_USER','root'); 
     define('DB_PASSWORD',''); 
     $con=($GLOBALS["___mysqli_ston"] = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD)) or die("Failed to connect to mysql: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))); 
     $db=((bool)mysqli_query($con, "USE " . constant('DB_NAME'))) or die("Failed to connect to mysql: " . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))); 
    // Check connection
    if ($con->connect_error) 
    {
    die("Connection failed: " . $con->connect_error);
    }     
    $query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM userName where apikey = '$apikey'")  or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
   if(mysqli_num_rows($query)>0)
   {
   $row = mysqli_fetch_array($query) or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
   
      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "rupoi";
      
      // Start XML file, create parent node
      
      $dom = new DOMDocument("1.0");
      $rupoi = $dom->createElement("Rupoi");
      $rupoi = $dom->appendChild($rupoi);
      
      
      
      if (($_GET['req']==1))
      {
        $q = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE statistics SET req1count = req1count + 1 WHERE api ='$apikey'")  or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
        // Opens a connection to a mysql server
      
      $connection=($GLOBALS["___mysqli_ston"] = mysqli_connect($servername,  $username,  $password));
      if (!$connection) {  die('Not connected : ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));}
      
      // Set the active mysql database
      
      $db_selected = ((bool)mysqli_query( $connection, "USE " . $database));
      if (!$db_selected) 
      {
        die ('Can\'t use db : ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
      }
        $query = "SELECT s.onoma,s.kodikos,s.geogr_mikos,s.geogr_platos FROM daily d INNER JOIN stathmos s ON s.kodikos = d.kodikos WHERE 1 group by s.kodikos";
        // $query = 'SELECT s.onoma, s.kodikos, s.geogr_platos, s.geogr_mikos, d.imerominia, d.eidos_ripou, (d.t00+ d.t01+ d.t02+ d.t03+ d.t04+ d.t05+ d.t06+ d.t07+ d.t08+ d.t09+ d.t10+ d.t11+ d.t12+ d.t13+ d.t14+ d.t15+ d.t16+ d.t17+ d.t18+ d.t19+ d.t20+ d.t21+ d.t22+ d.t23)/24 AS mesitimi  FROM daily d INNER JOIN stathmos s ON s.kodikos = d.kodikos WHERE s.kodikos ="'.$kodikos.'" AND d.eidos_ripou="'.$ripos.'" AND d.imerominia BETWEEN "'.$fromdate. '"AND "'.$todate .'" group by d.imerominia, d.eidos_ripou';
        
        $result = mysqli_query($GLOBALS["___mysqli_ston"], $query);
        if (!$result) 
        {
          die('Invalid query: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
        }
        
        
        header("Content-type: text/xml");
        
        // Iterate through the rows, adding XML nodes for each
        
        while ($row = @mysqli_fetch_assoc($result))
        {
          // ADD TO XML DOCUMENT NODE
            $stathmos = $dom->createElement("stathmos");
            $stathmos = $rupoi->appendChild($stathmos);
            foreach ($row as $fieldname => $fieldvalue) 
            {
                $child = $dom->createElement($fieldname);
                $child = $stathmos->appendChild($child);
                $value = $dom->createTextNode($fieldvalue);
                $value = $child->appendChild($value);
            }
        }
      
    }
    elseif(($_GET['req']==2))
    { 
       $q = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE statistics SET req2count = req2count + 1 WHERE api ='$apikey'")  or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
      // Opens a connection to a mysql server
      
      $connection=($GLOBALS["___mysqli_ston"] = mysqli_connect($servername,  $username,  $password));
      if (!$connection) {  die('Not connected : ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));}
      
      // Set the active mysql database
      
      $db_selected = ((bool)mysqli_query( $connection, "USE " . $database));
      if (!$db_selected) 
      {
        die ('Can\'t use db : ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
      }
      $ripos = $_GET['ripos'];
      $date = $_GET['date'];
      $time = $_GET['time'];
      if(isset($_GET['kodikos']))
      {
        $kodikos = $_GET['kodikos'];
        $query = 'SELECT s.onoma, s.kodikos, s.geogr_platos, s.geogr_mikos, d.imerominia, d.eidos_ripou, d.t' . $time . ' AS mesitimi FROM daily d INNER JOIN stathmos s ON s.kodikos = d.kodikos WHERE s.kodikos="' . $kodikos . '" AND d.imerominia="' . $date . '" AND d.eidos_ripou="' . $ripos . '" group by d.eidos_ripou, d.imerominia';
        $result = mysqli_query($GLOBALS["___mysqli_ston"], $query);
        if (!$result) 
        {
          die('Invalid query: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
        }
      }
      else
      {
        $query = 'SELECT s.onoma, s.kodikos, s.geogr_platos, s.geogr_mikos, d.imerominia, d.eidos_ripou, d.t' . $time . ' AS mesitimi FROM daily d INNER JOIN stathmos s ON s.kodikos = d.kodikos WHERE  d.imerominia="' . $date . '" AND d.eidos_ripou="' . $ripos . '" group by s.kodikos, d.imerominia';
        $result = mysqli_query($GLOBALS["___mysqli_ston"], $query);
        if (!$result) 
        {
          die('Invalid query: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
        }
      }
      
      header("Content-type: text/xml");
       // Iterate through the rows, adding XML nodes for each
        
      while ($row = @mysqli_fetch_assoc($result))
      {
        // ADD TO XML DOCUMENT NODE
          $stathmos = $dom->createElement("stathmos");
          $stathmos = $rupoi->appendChild($stathmos);
          foreach ($row as $fieldname => $fieldvalue) 
          {
              $child = $dom->createElement($fieldname);
              $child = $stathmos->appendChild($child);
              $value = $dom->createTextNode($fieldvalue);
              $value = $child->appendChild($value);
          }
      }
      
      
    }
    elseif(($_GET['req']==3))
    { 
       $q = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE statistics SET req3count = req3count + 1 WHERE api ='$apikey'")  or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
      // Opens a connection to a mysql server
      
      $connection=($GLOBALS["___mysqli_ston"] = mysqli_connect($servername,  $username,  $password));
      if (!$connection) {  die('Not connected : ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));}
      
      // Set the active mysql database
      
      $db_selected = ((bool)mysqli_query( $connection, "USE " . $database));
      if (!$db_selected) 
      {
        die ('Can\'t use db : ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
      }
      $ripos = $_GET['ripos'];
      $fromdate = $_GET['fromdate'];
      $todate = $_GET['todate'];
      if(isset($_GET['kodikos']))
      {
        $kodikos = $_GET['kodikos'];
        $query = 'SELECT new.onoma,new.kodikos,new.geogr_platos,new.geogr_mikos,new.eidos_ripou,AVG(new.mesitimi) AS meshtimh,(SELECT new.imerominia FROM (SELECT s.onoma, s.kodikos, s.geogr_platos, s.geogr_mikos, d.imerominia, d.eidos_ripou ,(d.t00+ d.t01+ d.t02+ d.t03+ d.t04+ d.t05+ d.t06+ d.t07+ d.t08+ d.t09+ d.t10+ d.t11+ d.t12+ d.t13+ d.t14+ d.t15+ d.t16+ d.t17+ d.t18+ d.t19+ d.t20+ d.t21+ d.t22+ d.t23)/24 AS mesitimi FROM daily d INNER JOIN stathmos s ON s.kodikos = d.kodikos WHERE s.kodikos ="'.$kodikos.'" AND d.eidos_ripou="'.$ripos.'" AND d.imerominia BETWEEN "'.$fromdate. '"AND "'.$todate .'" group by s.kodikos, d.imerominia) AS new WHERE 1 ORDER BY new.imerominia LIMIT 1) as first,(SELECT new.imerominia FROM (SELECT s.onoma, s.kodikos, s.geogr_platos, s.geogr_mikos, d.imerominia, d.eidos_ripou ,(d.t00+ d.t01+ d.t02+ d.t03+ d.t04+ d.t05+ d.t06+ d.t07+ d.t08+ d.t09+ d.t10+ d.t11+ d.t12+ d.t13+ d.t14+ d.t15+ d.t16+ d.t17+ d.t18+ d.t19+ d.t20+ d.t21+ d.t22+ d.t23)/24 AS mesitimi FROM daily d INNER JOIN stathmos s ON s.kodikos = d.kodikos WHERE s.kodikos ="'.$kodikos.'" AND d.eidos_ripou="'.$ripos.'" AND d.imerominia BETWEEN "'.$fromdate. '"AND "'.$todate .'" group by s.kodikos, d.imerominia) AS new WHERE 1 ORDER BY new.imerominia DESC LIMIT 1) as last FROM (SELECT s.onoma, s.kodikos, s.geogr_platos, s.geogr_mikos, d.imerominia, d.eidos_ripou , (d.t00+ d.t01+ d.t02+ d.t03+ d.t04+ d.t05+ d.t06+ d.t07+ d.t08+ d.t09+ d.t10+ d.t11+ d.t12+ d.t13+ d.t14+ d.t15+ d.t16+ d.t17+ d.t18+ d.t19+ d.t20+ d.t21+ d.t22+ d.t23)/24 AS mesitimi FROM daily d INNER JOIN stathmos s ON s.kodikos = d.kodikos WHERE s.kodikos ="'.$kodikos.'" AND d.eidos_ripou="'.$ripos.'" AND d.imerominia BETWEEN "'.$fromdate. '"AND "'.$todate .'" group by s.kodikos, d.imerominia) AS new WHERE 1 group by new.kodikos';
        $result = mysqli_query($GLOBALS["___mysqli_ston"], $query);
        if (!$result) 
        {
          die('Invalid query: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
        }
      }
      else
      {
        $query = 'SELECT new.onoma,new.kodikos,new.geogr_platos,new.geogr_mikos,new.eidos_ripou,AVG(new.mesitimi) AS meshtimh,(SELECT new.imerominia FROM (SELECT s.onoma, s.kodikos, s.geogr_platos, s.geogr_mikos, d.imerominia, d.eidos_ripou ,(d.t00+ d.t01+ d.t02+ d.t03+ d.t04+ d.t05+ d.t06+ d.t07+ d.t08+ d.t09+ d.t10+ d.t11+ d.t12+ d.t13+ d.t14+ d.t15+ d.t16+ d.t17+ d.t18+ d.t19+ d.t20+ d.t21+ d.t22+ d.t23)/24 AS mesitimi FROM daily d INNER JOIN stathmos s ON s.kodikos = d.kodikos WHERE d.eidos_ripou="'.$ripos.'" AND d.imerominia BETWEEN "'.$fromdate. '"AND "'.$todate .'" group by s.kodikos, d.imerominia) AS new WHERE 1 ORDER BY new.imerominia LIMIT 1) as first,(SELECT new.imerominia FROM (SELECT s.onoma, s.kodikos, s.geogr_platos, s.geogr_mikos, d.imerominia, d.eidos_ripou ,(d.t00+ d.t01+ d.t02+ d.t03+ d.t04+ d.t05+ d.t06+ d.t07+ d.t08+ d.t09+ d.t10+ d.t11+ d.t12+ d.t13+ d.t14+ d.t15+ d.t16+ d.t17+ d.t18+ d.t19+ d.t20+ d.t21+ d.t22+ d.t23)/24 AS mesitimi FROM daily d INNER JOIN stathmos s ON s.kodikos = d.kodikos WHERE d.eidos_ripou="'.$ripos.'" AND d.imerominia BETWEEN "'.$fromdate. '"AND "'.$todate .'" group by s.kodikos, d.imerominia) AS new WHERE 1 ORDER BY new.imerominia DESC LIMIT 1) as last FROM (SELECT s.onoma, s.kodikos, s.geogr_platos, s.geogr_mikos, d.imerominia, d.eidos_ripou ,(d.t00+ d.t01+ d.t02+ d.t03+ d.t04+ d.t05+ d.t06+ d.t07+ d.t08+ d.t09+ d.t10+ d.t11+ d.t12+ d.t13+ d.t14+ d.t15+ d.t16+ d.t17+ d.t18+ d.t19+ d.t20+ d.t21+ d.t22+ d.t23)/24 AS mesitimi FROM daily d INNER JOIN stathmos s ON s.kodikos = d.kodikos WHERE d.eidos_ripou="'.$ripos.'" AND d.imerominia BETWEEN "'.$fromdate. '"AND "'.$todate .'" group by s.kodikos, d.imerominia) AS new WHERE 1 group by new.kodikos;';
        $result = mysqli_query($GLOBALS["___mysqli_ston"], $query);
        if (!$result) 
        {
          die('Invalid query: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
        }
      }
      
      header("Content-type: text/xml");
       // Iterate through the rows, adding XML nodes for each
        
      while ($row = @mysqli_fetch_assoc($result))
      {
        // ADD TO XML DOCUMENT NODE
          $stathmos = $dom->createElement("stathmos");
          $stathmos = $rupoi->appendChild($stathmos);
          foreach ($row as $fieldname => $fieldvalue) 
          {
              $child = $dom->createElement($fieldname);
              $child = $stathmos->appendChild($child);
              $value = $dom->createTextNode($fieldvalue);
              $value = $child->appendChild($value);
          }
      }
      
      
    }
    //min max indexes for dates
    elseif(($_GET['req']==4))
    { 
       $q = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE statistics SET req4count = req4count + 1 WHERE api ='$apikey'")  or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
      // Opens a connection to a mysql server
      
      $connection=($GLOBALS["___mysqli_ston"] = mysqli_connect($servername,  $username,  $password));
      if (!$connection) {  die('Not connected : ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));}
      
      // Set the active mysql database
      
      $db_selected = ((bool)mysqli_query( $connection, "USE " . $database));
      if (!$db_selected) 
      {
        die ('Can\'t use db : ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
      }
      
      if(isset($_GET['kodikos']))
      {
        $kodikos = $_GET['kodikos'];
        $query = "SELECT(SELECT d.imerominia FROM daily d INNER JOIN stathmos s on s.kodikos = d.kodikos WHERE s.kodikos='".$kodikos."' ORDER BY d.imerominia LIMIT 1) as 'first', (SELECT d.imerominia FROM daily d INNER JOIN stathmos s on s.kodikos = d.kodikos WHERE s.kodikos='".$kodikos."' ORDER BY d.imerominia DESC LIMIT 1) as 'last';";
        $result = mysqli_query($GLOBALS["___mysqli_ston"], $query);
        if (!$result) 
        {
          die('Invalid query: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
        }
      }
      else
      {
        $query = "SELECT(SELECT d.imerominia FROM daily d INNER JOIN stathmos s on s.kodikos = d.kodikos ORDER BY d.imerominia LIMIT 1) as 'first', (SELECT d.imerominia FROM daily d INNER JOIN stathmos s on s.kodikos = d.kodikos ORDER BY d.imerominia DESC LIMIT 1) as 'last';";
        $result = mysqli_query($GLOBALS["___mysqli_ston"], $query);
        if (!$result) 
        {
          die('Invalid query: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
        }
      }
      
      header("Content-type: text/xml");
       // Iterate through the rows, adding XML nodes for each
        
      while ($row = @mysqli_fetch_assoc($result))
      {
        // ADD TO XML DOCUMENT NODE
          $stathmos = $dom->createElement("stathmos");
          $stathmos = $rupoi->appendChild($stathmos);
          foreach ($row as $fieldname => $fieldvalue) 
          {
              $child = $dom->createElement($fieldname);
              $child = $stathmos->appendChild($child);
              $value = $dom->createTextNode($fieldvalue);
              $value = $child->appendChild($value);
          }
      }
      
      
    }
     //diathesimoi ripoi
    elseif(($_GET['req']==5))
    { 
      
       $q = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE statistics SET req5count = req5count + 1 WHERE api ='$apikey'")  or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
      // Opens a connection to a mysql server
      
      $connection=($GLOBALS["___mysqli_ston"] = mysqli_connect($servername,  $username,  $password));
      if (!$connection) {  die('Not connected : ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));}
      
      // Set the active mysql database
      
      $db_selected = ((bool)mysqli_query( $connection, "USE " . $database));
      if (!$db_selected) 
      {
        die ('Can\'t use db : ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
      }
	  if(isset($_GET['fromdate'])&&isset($_GET['todate']))
		  {
			$fromdate = $_GET['fromdate'];
			$todate = $_GET['todate'];
		  if(isset($_GET['kodikos']))
			  {
				$kodikos = $_GET['kodikos'];
				$query = "SELECT DISTINCT eidos_ripou FROM (SELECT kodikos,eidos_ripou, min(imerominia) as min_imerominia, max(imerominia) as max_imerominia FROM daily WHERE kodikos = '".$kodikos."' GROUP BY eidos_ripou) as a WHERE a.max_imerominia >='".$fromdate."' AND a.max_imerominia <='".$todate."' AND a.min_imerominia >='".$fromdate."' AND a.min_imerominia <='".$todate."'";
				$result = mysqli_query($GLOBALS["___mysqli_ston"], $query);
				if (!$result) 
				{
				  die('Invalid query: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
				}
			  }
			  else
			  {
				$query = "SELECT DISTINCT eidos_ripou FROM (SELECT eidos_ripou, min(imerominia) as min_imerominia, max(imerominia) as max_imerominia FROM daily GROUP BY eidos_ripou) as a WHERE a.max_imerominia >='".$fromdate."' AND a.max_imerominia <='".$todate."' AND a.min_imerominia >='".$fromdate."' AND a.min_imerominia <='".$todate."'";
				$result = mysqli_query($GLOBALS["___mysqli_ston"], $query);
				if (!$result) 
				{
				  die('Invalid query: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
				}
			  }
		  }
	 
	
      
      header("Content-type: text/xml");
       // Iterate through the rows, adding XML nodes for each
        
      while ($row = @mysqli_fetch_assoc($result))
      {
        // ADD TO XML DOCUMENT NODE
          $stathmos = $dom->createElement("stathmos");
          $stathmos = $rupoi->appendChild($stathmos);
          foreach ($row as $fieldname => $fieldvalue) 
          {
              $child = $dom->createElement($fieldname);
              $child = $stathmos->appendChild($child);
              $value = $dom->createTextNode($fieldvalue);
              $value = $child->appendChild($value);
          }
      }
      
      
    }
      
    echo $dom->saveXML();
    }
  else
  {
    echo "Please get an api key";
  }
?>