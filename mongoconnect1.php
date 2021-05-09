<?php
/*require_once __DIR__ . "..\vendor\autoload.php";
$mongoDbClient = new MongoDB\Driver\Manager("mongodb://localhost:27017");


$collection = $mongoDbClient->try1;*/




	require_once __DIR__ . "../vendor/autoload.php" ; 

	$mongoDbClient = new MongoDB\Client ;
	$col_try = $mongoDbClient->faculty_try->collection_try ;

	$insert = $col_try->insertMany([
    [
        'facultyID' => '1',
        'email' => 'faculty1@example.com',
        'name' => 'Harsh Mittal',
    ],
    [
        'facultyID' => '2',
        'email' => 'faculty2@example.com',
        'name' => 'Aman Saraf',
    ],
    [
        'facultyID' => '3',
        'email' => 'faculty3@example.com',
        'name' => 'Jasnoor Singh',
    ],
]);
    echo "Done!"

 ?>


