<?php
include_once 'includes/dbh.inc.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply Leave</title>
</head>
<body>
<h1>Faculty Home Page</h1>
<p>Apply for Leave</p>
<form action="includes/applyleavefaculty.inc.php" method="POST">
    <input type="number" name ="req_id" placeholder="FacultyID">
    <br>
    <input type="date" name ="Start_date" placeholder="StartDate">
    <br>
    <input type="number" name ="number_of_days" placeholder="Number of days">
    <br>
    <input type="text" name ="coom" placeholder="Comments">
    <br>
    <button type="submit" name ="submit">Submit</button>
</form>

<p>Apply Project</p>
<form action="includes/applyproject.inc.php" method="POST">
    <input type="text" name ="project_name" placeholder="ProjectName">
    <br>
    <input type="number" name ="total_budget" placeholder="TotalBudget">
    <br>
    <input type="text" name ="funding_agency" placeholder="Funding Agency">
    <br>
    <input type="number" name ="duration" placeholder="Duration">
    <br>
    <input type="number" name ="req_id" placeholder="YourID">
    <br>
    <input type="number" name ="jrf_pay" placeholder="JRF Salary">
    <br>
    <input type="number" name ="srf_pay" placeholder="SRF Salary">
    <br>
    <button type="submit" name ="submit">Submit</button>
    <br>
</form>

<p>My Projects<p>
<?php
    $id1 = $_SESSION['faculty_id'];
    $sql = "SELECT * FROM project WHERE action_by_id = '$id1';";
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
    else{echo "You have no active projects";}
?>

<p>Add PI(If you have any active projects)</p>
<form action="includes/addpi.inc.php" method="POST">
    <input type="number" name ="req_id" placeholder="Faculty ID">
    <br>
    <input type="radio" id="BudgetHead" name="pi_position" value="2">
    <label for="BudgetHead">Budget Head</label>
    <br>
    <input type="radio" id="NormalPI" name="pi_position" value="3">
    <label for="NormalPI">Normal PI</label>
    <br>
    <input type="number" name ="req_project_id" placeholder="Project ID">
    <br>
    <button type="submit" name ="submit">Submit</button>
    <br>
</form>



</body>
</html>