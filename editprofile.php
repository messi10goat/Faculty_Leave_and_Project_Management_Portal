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
<h2> Name: <?php echo $v1; ?> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <a style="color: rgb(226, 29, 29);" href="editName.php?id=<?php echo $data['id']; ?>">Edit Name</a> </h2>
<h2> Faculty Id: <?php echo $v2; ?> </h2>
</center>
<hr>
<h3> Contact Information : </h3>

<?php
$cursor = $col_f->find(
    ["fid"=> $v2 + 0 , ],
);
$cursor2 = $col_c->find(
    ["fid"=> $v2 + 0 , ],
);
$cursor3 = $col_p->find(
    ["fid"=> $v2 + 0 , ],
);
foreach($cursor as $detail){
    echo($detail["email"]."\n");?>

&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <a style="color: rgb(226, 29, 29);" href="editemail.php?id=<?php echo $data['id']; ?>">Edit Email</a> 

    <?php
    echo nl2br("\n");
    echo($detail["phone"]."\n");?>

&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <a style="color: rgb(226, 29, 29);" href="editphone.php?id=<?php echo $data['id']; ?>">Edit Phone</a> 

    <?php
   
    echo nl2br("\n");
    ?>
    <hr>
    <h3>Bio:</h3>
    <?php
    echo($detail["bio"]."\n");?>


<br>
<br> <a style="color: rgb(226, 29, 29);" href="editbio.php?id=<?php echo $data['id']; ?>">Edit Bio</a> 
<hr>




    <?php
    
    
}

unset($detail);

?>

<h3>Update Courses Taught:</h3>
<table class="w3-table w3-striped w3-bordered">
    <tr>
        <th> Course ID </th>
        <th> Year </th>
        <th> Delete It </th>
    </tr>

<?php

foreach($cursor2 as $detail){
?>
<tr>
<td><?php echo($detail["c"]); ?></td>
<td><?php echo($detail["year"]); ?></td>
<td> <a style="color: rgb(226, 29, 29);" href="deletecourse.php?cid=<?php echo($detail["c"]); ?>&yearr=<?php echo($detail["year"]); ?>">Delete</a> </td>

</tr>

<?php
}
?>
</table>
<br>
<br>
<a style="color: rgb(226, 29, 29);" href="insertcourse.php">Add New Course</a>

<?php
unset($detail);
?>



<hr>
<h3>Update Publications:</h3><br>


<table class="w3-table w3-striped w3-bordered">
    <tr>
        <th> Title </th>
        <th> Year </th>
        <th> Description </th>
        <th> Delete It </th>
    </tr>

<?php

foreach($cursor3 as $detail){
?>
<tr>
<td><?php echo($detail["title"]); ?></td>
<td><?php echo($detail["year"]); ?></td>
<td><?php echo($detail["disc"]); ?></td>
<td> <a style="color: rgb(226, 29, 29);" href="deletepub.php?cid=<?php echo($detail["title"]); ?>&yearr=<?php echo($detail["year"]); ?>">Delete</a> </td>

</tr>

<?php
}
?>
</table>
<br>
<?php
unset($detail);
?>

<a style="color: rgb(226, 29, 29);" href="insertpub.php">Add New Course</a>

<hr>


</body>

</html>
