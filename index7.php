<?php 
    session_start();  
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Add fellow</title>
<link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
    <center>
<h1>Add fellow</h1><hr><br>
<form action="includes/addfellow.inc.php" method="POST">
    <input class="w3-input" type="number" name ="req_id" placeholder="Project ID">
    <br>
<br>
    <input class="w3-input" type="radio" id="JRF" name="type1" value="1">
    <label for="JRF">JRF</label>
    <br>
    <input class="w3-input" type="radio" id="SRF" name="type1" value="2">
    <label for="SRF">SRF</label>
    <br><br>
    <input class="w3-input" type="number" name ="duration" placeholder="Duration in months">
    <br>
<br>

    <input class="w3-input" type="text" name ="reason1" placeholder="Comments">
    <br><br>
    <button class="w3-button w3-khaki" type="submit" name ="submit">Submit</button>
    <br>
</form>
</center>
</body>
</html>