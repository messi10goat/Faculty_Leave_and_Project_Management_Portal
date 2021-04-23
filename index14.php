<?php 
    session_start();  
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Your expenditure requests</title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
    <center>
<h1>Your expenditure requests</h1><hr><br>

<?php
/*
    $sql = "SELECT * FROM expenditures e2, status2 s2 WHERE e2.faculty_id = $_SESSION[faculty_id] AND s2.id = e2.status1;";
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

    $sql = "SELECT e2.id, e2.project_id, e2.amount, e2.doa, e2.reason, s2.name FROM expenditures e2, status2 s2 WHERE e2.faculty_id = $_SESSION[faculty_id] AND s2.id = e2.status1;"; 
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
?>
<table class="w3-table w3-striped w3-bordered">
<tr>
    <th> Expenditure ID </th>
    <th> Project ID </th>
    <th> Amount </th>
    <th> Date of Application </th>
    <th> Reason </th> 
    <th> Status </th> 
    
    
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