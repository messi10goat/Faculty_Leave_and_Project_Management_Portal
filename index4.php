<?php 
    session_start();  
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appoint HoD</title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
    <center>
<h1>Appoint HoD </h1>
<hr> <br>
<form action="includes/appointhod.inc.php" method="POST">
    Enter the faculty Id:
    <input class="w3-input" type="number" name ="req_id" placeholder="FacultyID of new HoD">
    <br><br>
    
    <button class="w3-button w3-khaki" type="submit" name ="submit">Submit</button>
    <br><br>
</form>
</center>
</body>
</html>