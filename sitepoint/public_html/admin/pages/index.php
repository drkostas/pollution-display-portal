<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    session_regenerate_id();
    if(!isset($_SESSION['userName']))      // if there is no valid session
    {
         header("Location: ../../index.php?message=Lathos kodikos");      
    }    
?>    
<head>
    <meta charset="utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../user/assets/css/userstyle.css">
    <link rel="stylesheet" type="text/css" href="../../user/assets/js/userscript.css">
    <script type="text/javascript" src="../../../assets/js/Script.js"></script>
    <script type="text/javascript" src="../assets/js/adminscript.js"></script>
    <title>Greek Pollution</title>
</head>
<body>
    <div> 
        <?php $name = $_SESSION["userName"]; ?>
        <h3>
            <span id="whom">Hello </span> 
            <span id="person"><?php echo $name; ?></span>
        </h3>
        <button id="adminlogout" onclick="showindex()">Sign Out</button>
    </div>
    <h2>Total Number of requests for each type</h2>
    <div id="progstations"></div>            
</body>

</html>