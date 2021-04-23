<?php 
    session_start();  
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Act on fellow</title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
    <center>
<h1>Act on fellow</h1><hr><br>
<form action="includes/actonfellow.inc.php" method="POST">
    <input class="w3-input" type="number" name ="req_id" placeholder="ID">
    <br>
    <br>
    <input class="w3-input" type="text" name ="reason1" placeholder="Reason">
    <br><br>
    <input class="w3-input" type="radio" id="Allow" name="yes_no" value="1">
    <label for="Allow">Allow</label>
    <br>
    <input class="w3-input" type="radio" id="Decline" name="yes_no" value="0">
    <label for="Decline">Decline</label>
    <br><br>
    <button  class="w3-button w3-khaki"  type="submit" name ="submit">Submit</button>
    <br>
</form>
<br>
<hr>
<h1>Pending Requests</h1>
<br>

<?php
    $sql = "SELECT * FROM expenditures WHERE status1 = 3";
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
?>
</center>
</body>
</html>