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

$cursor = $col_f->find(
    ["fid"=> $v2 + 0 , ],
);
foreach($cursor as $detail){
    
    $v3 = $detail["bio"];
    
}

unset($detail);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $v1; ?> Update Bio</title>
    <link rel="stylesheet" type="text/css" href="index.css">

</head>
<body style="padding: 5%;">
<center>


<h3>Update Bio</h3>
<!--
<form method="POST">
  <input class="w3-input" type="text" name="fullname" placeholder="Enter Bio" Required>
  <br>
  <input class="w3-button w3-khaki" type="submit" name="update" value="update">

</form>
-->
<form method="POST" id="usrform">

<input class="w3-button w3-khaki" type="submit" name="update" value="update">
</form>

<br>
<textarea rows="15" cols="150" name="fullname" form="usrform">
<?php echo $v3; ?>
</textarea>


</center>
</body>
</html>




<?php

if(isset($_POST['update'])) // when click on Update button
{
$fullname = $_POST['fullname'];



$updateResult = $col_f->updateOne(
    [ 'fid' => $v2+0 ],
    [ '$set' => [ 'bio' => $fullname ]]
);

if(1>0)
    {
        header("location:editprofile.php?update_bio=success"); // redirects to all records page
        exit;
    }


}
?>