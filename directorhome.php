<?php 
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
<h1>Director Home Page</h1>
<p>Appoint HoD</p>
<form action="includes/appointhod.inc.php" method="POST">
    <input type="number" name ="req_id" placeholder="FacultyID of new HoD">
    <br>
    <input type="number" name ="exec_id" placeholder="YourID">
    <br>
    <button type="submit" name ="submit">Submit</button>
    <br>
</form>

<p>Appoint Dean</p>
<form action="includes/appointdean.inc.php" method="POST">
    <input type="number" name ="req_id" placeholder="FacultyID">
    <br>
    <input type="number" name ="exec_id" placeholder="YourID">
    <br>
    <input type="radio" id="FacultyAffairs" name="dept1" value="1">
    <label for="FacultyAffairs">Faculty Affairs</label>
    <br>
    <input type="radio" id="SponsoredProjects" name="dept1" value="2">
    <label for="SponsoredProjects">SponsoredProjects</label>
    <br>
    <button type="submit" name ="submit">Submit</button>
</form>



<p>Act on leaves(For Director)</p>
<form action="includes/directoractonleave.inc.php" method="POST">
    <input type="number" name ="req_id" placeholder="LeaveID">
    <br>
    <input type="radio" id="Allow" name="yes_no" value="1">
    <label for="Allow">Allow</label>
    <br>
    <input type="radio" id="Decline" name="yes_no" value="0">
    <label for="Decline">Decline</label>
    <br>
    <input type="number" name ="actioner_id" placeholder="YourID">
    <br>
    <input type="text" name ="coom" placeholder="Comments">
    <br>
    <button type="submit" name ="submit">Submit</button>
    <br>
</form>
<p>Leave applications<p>

<?php
    $sql = "SELECT l.id,l.faculty_id, f.name, l.from_day, l.to_day, l.faculty_comment  FROM leaves l, faculty f WHERE (status_id =3   OR status_id =4 OR status_id =9 OR status_id =10 OR status_id =8) AND l.faculty_id = f.id;";
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

</body>
</html>