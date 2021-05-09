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
    <title><?php echo $v1; ?> Delete Publication</title>
    <link rel="stylesheet" type="text/css" href="index.css">

</head>
<body style="padding: 5%;">
<center>



</center>
</body>
</html>




<?php







$updateResult = $col_p->deleteOne(
    [ 'fid' => $v2+0 , 'title' => $_GET['cid'], 'year' => $_GET['yearr'] ]
    
);

if(1>0)
    {
        header("location:editprofile.php?publication_delete=success"); // redirects to all records page
        exit;
    }



?>