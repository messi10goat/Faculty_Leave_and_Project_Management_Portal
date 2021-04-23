<?php 
    session_start();  
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Projects you are a part of</title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
    <center>
<h1>Projects you are a part of</h1><hr><br>

<?php

/*
    $sql = "SELECT * FROM personell_project p1, project p2 WHERE p2.id = p1.project_id AND p1.faculty_id = $_SESSION[faculty_id];";
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

    $sql = "SELECT p2.id, p2.name, p2.budget, p2.agency, p2.duration_in_months, p2.budget_remaining, p2.action_by_id FROM personell_project p1, project p2 WHERE p2.id = p1.project_id AND p1.faculty_id = $_SESSION[faculty_id];";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    ?>
    <table class="w3-table w3-striped w3-bordered">
    <tr>
        <th> Project ID </th>
        <th> Project Name </th>
        <th> Budget </th>
        <th> Funding Agency </th> 
        <th> Duration (In Months) </th> 
        <th> Budget Remaining </th>
        <th> Head Project Incharge ID </th>
        
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
    <br><hr>
    <br>
<h1> Some Actions: </h1><br>
    <!-- apply for expenditures'-->
    <form action="index7.php" method="POST">
    <button class="w3-button w3-khaki" type="submit" name ="submit">Add Fellow</button>
    </form>
    <br>

    <!-- add more PI's -->
    <form action="index6.php" method="POST">
    <button class="w3-button w3-khaki" type="submit" name ="submit">Add more PIs</button>
    </form>
    <br>

    <!-- act on expenditure requests -->
    <form action="index8.php" method="POST">
    <button class="w3-button w3-khaki" type="submit" name ="submit">Act on expenditure requests</button>
    </form>
    <br>

    <!-- Your expenditure requests -->
    <form action="index14.php" method="POST">
    <button  class="w3-button w3-khaki" type="submit" name ="submit">Your expenditure requests</button>
    </form>
    <br>

    <!-- View papertrail for Project: -->
    <form action="index15.php" method="POST">
    <button  class="w3-button w3-khaki" type="submit" name ="submit">Project Papertrails</button>
    </form>
    <br>

</center>
</body>
</html>