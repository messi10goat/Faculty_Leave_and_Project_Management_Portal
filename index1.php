<?php 
    session_start();  
    include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply Leave</title>
    <link rel="stylesheet" type="text/css" href="index.css">    
</head>
<body>
    <center>
<h1>Apply for Leave</h1>
<hr> <br>
<h3> Leaves Remaining: <b><?php 
$sql = "SELECT f.leaves_remaining FROM faculty f WHERE f.id = $_SESSION[faculty_id];";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
            foreach($row as $value) 
            {
                 echo $value;
            }
            
        }
    }

?></b>
 for Faculty(your) Id:<b> <?php echo $_SESSION['faculty_id']; ?> </b>
</h3>

<form action="includes/applyleave.inc.php" method="POST">
    Select the Leave start Date:
    <input class="w3-input" type="date" name ="Start_date" placeholder="StartDate">
    <br><br>
    How many days leave is required:
    <input class="w3-input" type="number" name ="number_of_days" placeholder="Number of days">
    <br><br>
    Any comments:
    <input class="w3-input" type="text" name ="coom" placeholder="Comments">
    <br><br>
    <button   class="w3-button w3-khaki" type="submit" name ="submit">Submit</button>
</form>
</center>
</body>
</html>