<?php 

    require_once __DIR__ . "../vendor/autoload.php" ; 
	$mongoDbClient = new MongoDB\Client ;
	$col = $mongoDbClient->faculty22->coll22 ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile Page</title>
</head>
<body>

<h1>Profile</h1>
<br>

<?php  
$cursor = $col->find(
    [
        'facultyID'=>"1", 
    ],
    /*[
        'limit'=>1,
        'projection'=>[
        'name'=>1
        ],
    ]*/
);

foreach ($cursor as $details) {
    echo($details["name"]."\n");
    echo nl2br("\n");
    echo($details["email"]."\n");
    echo nl2br("\n");
    //echo($details["education"]."\n");
};
?>


<h3>OVERVIEW</h3>
<?php 

?>

    
</body>
</html>