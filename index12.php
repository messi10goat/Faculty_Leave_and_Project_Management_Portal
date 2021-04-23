<?php 
    session_start();
    include_once 'includes/dbh.inc.php';   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Previously Applied Leaves</title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
<center>
<h1>Previously Applied Leaves</h1><br><hr>

<?php
/*
    $sql = "SELECT l.id, l.from_day, l.to_day, s.name as Current_status, l.applied_time, l.faculty_comment, l.hod_comment, l.dean_comment, l.director_comment, l.system_comment  FROM leaves l,status1 s WHERE l.faculty_id = $_SESSION[faculty_id] AND l.status_id = s.id;";
    //$sql1 = "SELECT * FROM leaves;";
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


    $sql = "SELECT l.id, l.from_day, l.to_day, s.name as Current_status, l.applied_time, l.faculty_comment, l.hod_comment, l.dean_comment, l.director_comment, l.system_comment  FROM leaves l,status1 s WHERE l.faculty_id = $_SESSION[faculty_id] AND l.status_id = s.id;";
    //$sql1 = "SELECT * FROM leaves;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    ?>
    <table class="w3-table w3-striped w3-bordered">
    <tr>
        <th> Leave ID </th>
        <th> Start Date </th>
        <th> End Sate </th>
        <th> Current Status </th> 
        <th> Applied Timestamp </th> 
        <th> Faculty Comment </th>
        <th> HOD Comment </th>
        <th> Dean Comment </th>
        <th> Director Comment </th>
        <th> System Comment </th> 
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
</center>
</body>
</html>