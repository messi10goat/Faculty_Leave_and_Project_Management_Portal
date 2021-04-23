<?php 
    session_start();  
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Act on leaves</title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
    <center>
<h1>Act on leaves</h1><hr><br>
<form action="includes/actonleave.inc.php" method="POST">
    <input class="w3-input" type="number" name ="req_id" placeholder="LeaveID">
    <br><br>
    <input class="w3-input" type="radio" id="Allow" name="yes_no" value="1">
    <label for="Allow">Allow</label>
    <br>
    <input class="w3-input" type="radio" id="Decline" name="yes_no" value="0">
    <label for="Decline">Decline</label>
    <br><br>
    <input class="w3-input" type="number" name ="actioner_id" placeholder="YourID">
    <br><br>
    <input class="w3-input" type="text" name ="coom" placeholder="Comments">
    <br><br>
    <button  class="w3-button w3-khaki" type="submit" name ="submit">Submit</button>
    <br>
</form>
<hr><br>
<h1>Leave applications<h1><br>


<?php
/*
    $sql = "SELECT l.id,l.faculty_id, f.name, l.from_day, l.to_day, l.faculty_comment  FROM leaves l, faculty f WHERE (status_id = 1  OR status_id = 7 ) AND l.faculty_id = f.id;";
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

$sql = "SELECT l.id,l.faculty_id, f.name, l.from_day, l.to_day, l.faculty_comment  FROM leaves l, faculty f WHERE (status_id = 1  OR status_id = 7 ) AND l.faculty_id = f.id;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
    ?>
    <table class="w3-table w3-striped w3-bordered">
    <tr>
        <th> Leave ID </th>
        <th> Faculty ID </th>
        <th> Faculty Name </th>
        <th> Start Day </th> 
        <th> End Day </th>
        <th> Faculty comment </th> 
         
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