<?php 
    session_start();  
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add PI</title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
<center>
<h2>Projects you're a head of</h2><hr>
<?php

/*
    $sql = "SELECT * FROM project p WHERE p.action_by_id = $_SESSION[faculty_id];";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);


    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            foreach($row as $value){
                echo $value."...........";
            }
            echo "<br>";
        }
    }
    */

    
    $sql = "SELECT * FROM project p WHERE p.action_by_id = $_SESSION[faculty_id];";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
?>
    <table class="w3-table w3-striped w3-bordered">
    <tr>
        <th> Project ID </th>
        <th> Project Name </th>
        <th> Budget </th>
        <th> Start Time </th> 
        <th> Funding Agency </th> 
        <th> Time Duration (Months) </th>
        <th> Budget Remaining </th>
        <th> Head Project Incharge ID </th>
        <th> JRF Salary </th>
        <th> SRF Salary </th> 
    </tr>
<?php
    if($resultCheck > 0)
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
            ?>
            <tr>
            <?php
            foreach($row as $value) 
            {
                ?>
                <td><?php echo $value;?></td>
                <?php
            }
            ?>
            </tr>
            <?php
        }
    }
    ?>
    
    </table>
    <?php



?>
<br><hr><br>

<h1>Add PI</h1>
<br><br>
<form action="includes/addpi.inc.php" method="POST">
    <input class="w3-input" type="number" name ="req_id" placeholder="Faculty ID">
    <br><br>
    Select the position:
    
    <input class="w3-input" type="radio" id="BudgetHead" name="pi_position" value="2">
    <label for="BudgetHead">Budget Head</label>
    <br>
    <input class="w3-input" type="radio" id="NormalPI" name="pi_position" value="3">
    <label for="NormalPI">Normal PI</label>
    <br><br>
    <input class="w3-input" type="number" name ="req_project_id" placeholder="Project ID">
    <br><br>
    <button  class="w3-button w3-khaki" type="submit" name ="submit">Submit</button>
    <br>
</form>
<br><br>
</center>
</body>
</html>