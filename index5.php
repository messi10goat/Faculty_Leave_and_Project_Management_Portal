<?php 
    session_start();  
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply Project</title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
    <center>
<h1>Apply Project</h1>
<hr><br>
<form action="includes/applyproject.inc.php" method="POST">
    <input class="w3-input" type="text" name ="project_name" placeholder="ProjectName">
    <br><br>
    <input class="w3-input" type="number" name ="total_budget" placeholder="TotalBudget">
    <br><br>
    <input class="w3-input" type="text" name ="funding_agency" placeholder="Funding Agency">
    <br><br>
    <input class="w3-input" type="number" name ="duration" placeholder="Duration">
    <br><br>
    <input class="w3-input" type="number" name ="jrf_pay" placeholder="JRF Salary">
    <br><br>
    <input class="w3-input" type="number" name ="srf_pay" placeholder="SRF Salary">
    <br><br>
    <button class="w3-button w3-khaki" type="submit" name ="submit">Submit</button>
    <br><br>
</form>
<center>
</body>
</html>