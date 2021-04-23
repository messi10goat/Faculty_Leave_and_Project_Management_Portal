<?php 
    session_start();  
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>act on expenditure requests</title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
    <center>
<h1>Act on fellow</h1><hr><br>
<form action="includes/actonfellow.inc.php" method="POST">
    <input class="w3-input" type="number" name ="req_id" placeholder="ID">
    <br><br>
    
    <input class="w3-input" type="text" name ="reason1" placeholder="Reason">
    <br><br>
    <input class="w3-input" type="radio" id="Allow" name="yes_no" value="1">
    <label for="Allow">Allow</label>
    <br>
    <input class="w3-input" type="radio" id="Decline" name="yes_no" value="0">
    <label for="Decline">Decline</label>
    <br><br>
    <button type="submit" name ="submit">Submit</button>
    <br><br>
</form>
<hr>
<h1>Pending Requests</h1>
<br>

<?php
/*
    $sql = "SELECT e1.id, p1.name, e1.project_id, e1.amount, e1.doa, e1. faculty_id, e1.reason  FROM expenditures e1, project p1 WHERE e1.status1 = 1 AND p1.id = e1.project_id AND p1.action_by_id = $_SESSION[faculty_id]";
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


    $sql = "SELECT e1.id, p1.name, e1.project_id, e1.amount, e1.doa, e1. faculty_id, e1.reason  FROM expenditures e1, project p1 WHERE e1.status1 = 1 AND p1.id = e1.project_id AND p1.action_by_id = $_SESSION[faculty_id]";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
?>
    <table class="w3-table w3-striped w3-bordered">
    <tr>
        <th> Expenditure ID </th>
        <th> Project Name </th>
        <th> Project ID </th>
        <th> Amount </th> 
        <th> Time Stamp </th> 
        <th> Requesting Faculty ID </th>
        <th> Reason </th>
        
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


<br><br>
</center>
</body>
</html>