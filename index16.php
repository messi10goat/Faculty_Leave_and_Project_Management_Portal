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
    <h1>Project papertrail</h1>
    <hr><br>


<?php



/*
    $project_idd = $_POST['projectID'];
    $sql = "SELECT * FROM papertraile p1 WHERE p1.expenditures_id IN (SELECT id FROM EXPENDITURES e1 where e1.project_id = '$project_idd') ;";
   
   
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

    $project_idd = $_POST['projectID'];
    $sql = "SELECT * FROM papertraile p1 WHERE p1.expenditures_id IN (SELECT id FROM EXPENDITURES e1 where e1.project_id = '$project_idd') ;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
?>
    <table class="w3-table w3-striped w3-bordered">
    <tr>
        <th> ID </th>
        <th> Expenditures ID </th>
        <th> TimeStamp </th>
        <th> Status ID </th> 
        <th> Action By ID </th> 
        <th> Comment </th> 
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
<br><br><hr><br>
1 ->
Filed by PI<br>
3 ->
Approved by head PI<br>
-3 ->
Rejected by head PI<br>
4 ->
Approved by Dean Sponsored Projects<br>
-4 ->
Rejected by Dean Sponsored Projects<br>
-5 ->
Rejected by system
</center>
</body>
</html>