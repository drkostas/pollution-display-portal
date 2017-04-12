<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    session_regenerate_id();
    if(!isset($_SESSION['userName']))      // if there is no valid session
    {
         header("Location: index.php");
      
    }
    
?>

    
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="adminstyle.css">
    <script type="text/javascript" src="Script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      refreshTable();
    });

    function refreshTable(){
        $('#progstations').load('programmertable.php', function(){
           setTimeout(refreshTable, 5000);
        });
    }
</script>
    <title>Project Web</title>
</head>


<body>
    <div> <h2>Σκοπος του site </h2>
	<?php $name = $_SESSION["userName"]; ?>
    <h3><span id="whom">Συνδεθήκατε ως </span> <span id="person"><?php echo $name ; ?> </span></h3>
    <button id="adminlogout" onclick="showmain()">Αποσύνδεση</button></div>
    <h2>Σύνολο αιτήσεων για κάθε είδος request.</h2>
  <div id="progstations">
               
  </div>            
</body>

</html>