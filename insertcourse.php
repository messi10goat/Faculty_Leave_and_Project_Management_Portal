<?php 

session_start() ;

include_once 'includes/dbh.inc.php';

require_once __DIR__ . "../vendor/autoload.php" ; 
$mongoDbClient = new MongoDB\Client ;
$col_f = $mongoDbClient->faculty22->faculty;
$col_c = $mongoDbClient->faculty22->courses;
$col_p = $mongoDbClient->faculty22->publications;
$col_e = $mongoDbClient->faculty22->education;

$v1 = "name";
$v2 = $_SESSION['view_id'];
$vf = $_SESSION['faculty_id'];





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $v1; ?>Add Course</title>
    <link rel="stylesheet" type="text/css" href="index.css">

</head>
<body style="padding: 5%;">
<center>


<h3>Add course</h3>
<form method="POST">
  <input class="w3-input" type="text" name="f1" placeholder="Course Id" Required>
  <br>
  <input class="w3-input" type="text" name="f2" placeholder="Year" Required>
  <br>
  <input class="w3-button w3-khaki" type="submit" name="update" value="update">

</form>
</center>
</body>
</html>




<?php

if(isset($_POST['update'])) // when click on Update button
{
$m1 = $_POST['f1'];
$m2 = $_POST['f2'];


$updateResult = $col_c->insertOne(
    [
        "fid" => $v2+0 ,"c" => $m1, "year" => $m2,
    ]
);

if(1>0)
    {
        header("location:editprofile.php?add_course=success"); // redirects to all records page
        exit;
    }


}
?>