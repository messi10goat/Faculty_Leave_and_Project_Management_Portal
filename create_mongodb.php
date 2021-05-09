<?php

	require_once __DIR__ . "../vendor/autoload.php" ; 
	$mongoDbClient = new MongoDB\Client ;
	$col = $mongoDbClient->faculty22->coll22 ;

	$insert = $col->insertOne
    ([
        'facultyID' => '1',
        'email' => 'director@example.com',
        'name' => 'Name_of_director',
        'education' => ['Education1', 'Education2', 'Education3'],
        'overview' => 'This is the overview of director',
        'projects' =>   ['Project1', 'Project2', 'Project3'],

    ]);
    echo "Done!"

 ?>


