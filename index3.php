<?php 
    session_start();  
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appoint Dean</title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
    <center>
<h1>Appoint Dean</h1>
<hr><br>
<form action="includes/appointdean.inc.php" method="POST">
    Input the facultyID: 
    <input class="w3-input" type="number" name ="req_id" placeholder="FacultyID">
    <br><br>
    Select the required position: 
    <input class="w3-input" type="radio" id="FacultyAffairs" name="dept1" value="1">
    <label for="FacultyAffairs">Faculty Affairs</label>
    <br>
    <input class="w3-input" type="radio" id="SponsoredProjects" name="dept1" value="2">
    <label for="SponsoredProjects">SponsoredProjects</label>
    <br><br>
    <button class="w3-button w3-khaki"   type="submit" name ="submit">Submit</button>
</form>
</center>
</body>
</html>