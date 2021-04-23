<?php 
    session_start();  
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Project papertrail</title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
    <center>
    <h1>Project papertrail</h1><hr><br>
    <form action="index16.php" method="POST">
    <input  class="w3-input" type="number" name ="projectID" placeholder="Project ID">
    <br>
    <button class="w3-button w3-khaki" type="submit" name ="submit">Submit</button>
    </form>
    <br>
</center>
    

</body>
</html>