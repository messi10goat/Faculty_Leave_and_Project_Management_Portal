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
$sql = "SELECT f.name FROM faculty f WHERE f.id = $_SESSION[view_id] ;"; 
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if($resultCheck > 0)
{
    while($row = mysqli_fetch_assoc($result)) 
    {
        
        foreach($row as $value) 
        {
            
            $v1 = $value;
            
        }
        
    }

    unset($value);
}




error_reporting(0) ;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $v1; ?> Profile</title>
    <link rel="stylesheet" type="text/css" href="index.css">

</head>
<body style="padding: 5%;">
<center>
<h2> Name: <?php echo $v1; ?> </h2>
<h2> Faculty Id: <?php echo $v2; ?> </h2>
</center>
<hr>
<h3> Contact Information : </h3>

<?php
$cursor = $col_f->find(
    ["fid"=> $v2 + 0 , ],
);
foreach($cursor as $detail){
    echo($detail["email"]."\n");
    echo nl2br("\n");
    echo($detail["phone"]."\n");
    $v3 = $detail["bio"];
    echo nl2br("\n");
}

unset($detail);

?>

<br><hr>
<h3> Bio : </h3>
<span><div>
<?php
print $v3;
echo nl2br("\n");
$v4 = $v3;



?>
</div>
</span>
<br><hr>
<h3> Courses : </h3>
<?php
$cursor = $col_c->find(
    ["fid"=> $v2 + 0 , ],
);
foreach($cursor as $detail){
    echo($detail["year"]."\n");
    echo "   ";
    echo " -  ";
    echo "   ";
    echo "   ";
    echo($detail["c"]."\n");
    
    echo nl2br("\n");
    
}
unset($detail);

?>



<?php
$cursor = $col_p->find(
    ["fid"=> $v2 + 0 , ],
);
if(count($cursor)> 0){
?>
<br><hr>
<h3> Publications : </h3>
<?php
foreach($cursor as $detail){
    echo($detail["year"]."\n");
    echo "   ";
    echo " -  ";
    
    echo "   ";
    echo "   ";
    echo($detail["title"]."\n");
    echo "   ";
    echo " -  ";
    echo "   ";
    echo "   ";
    echo($detail["disc"]."\n");
    
    
    echo nl2br("\n");
    
}
unset($detail);
}
?>


<?php
$cursor = $col_e->find(
    ["fid"=> $v2 + 0 , ],
);
if(count($cursor)> 0){
?>
<br><hr>
<h3> Education : </h3>
<?php
foreach($cursor as $detail){
    echo "Phd : ";
    echo($detail["phd"]."\n");
    echo nl2br("\n");
    echo "Masters : ";
    echo($detail["masters"]."\n");
    echo nl2br("\n");
    echo "Bachelors : ";
    echo($detail["bachelors"]."\n");
    
    
    echo nl2br("\n");
    
}
unset($detail);
}
?>


<?php
$sql = "SELECT p.name, p.agency FROM personell_project pp, project p WHERE pp.faculty_id = $_SESSION[view_id] AND pp.project_id = p.id;"; 
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if($resultCheck > 0)
{
    ?>
    <br><hr>
<h3> Projects : </h3>
<?php
    while($row = mysqli_fetch_assoc($result)) 
    {
        
        
        foreach($row as $value) 
        {
             echo $value;
             echo " - ";
        }
        
    }
    unset($value);
}


?>
<br><hr>
<center>
<?php
    if($v2== $vf){
?>
    <br>
    <form action="editprofile.php" method="POST">
    <center><button  class="w3-button w3-khaki" type="submit" name ="submit">Edit Profile</button></center>
    <br>
    </form>
    
<?php
    }
?>


</center>





</body>
</html>





