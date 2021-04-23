<?php 

session_start() ;

include_once 'includes/dbh.inc.php';

error_reporting(0) ;

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="index.css">  
</head>
<body>
    <h1><center>Login Portal</center></h1>
	<hr>
	<br>
	<center>
    <form action="" method="POST">
		Enter Your faculty ID:
    <input class="w3-input" type="number" name ="FacultyID" placeholder="Enter your Faculty ID">
    <br><br>
		Enter your Password:  
    <input class="w3-input" type="password" name ="Password" placeholder="Enter Password">
    <br>
	<br>
    <button  class="w3-button w3-khaki" type="submit" name ="submit">Login</button>
    <br>
	</center>
</form>
</body>
</html>
<?php

	if(isset($_POST['submit'])){

	$faculty_id = $_POST['FacultyID'];
	$pwd = $_POST['Password'];


	if($faculty_id != "" && $pwd != "" )
	{
		$sql_query = "SELECT * FROM faculty WHERE id = '$faculty_id';" ;	
		$result = mysqli_query($conn,$sql_query) ;
		$data = mysqli_fetch_array($result);
		$designation = $data['position'] ;
		$dept = $data['dept'] ;
		//$fname = $data['name'] ;
		//$total = mysqli_num_rows($result) ;
        $total =1;
		if($total > 0)
		{

			$_SESSION['faculty_id'] = $faculty_id ;
			$_SESSION['designation'] = $designation ;
			$_SESSION['department'] = $dept ;
			//$_SESSION['name'] = $fname ;
            header('location:generalpage.php') ;
		  	/*if ($designation == '3' ){
		  		header('location:directorhome.php') ;
		  	}
		  	elseif ($designation == '0'){
		  		header('location:generalpage.php') ;
		  	}
		  	/*else{
		  		header('location:faculty_home_pg.php') ;
		  	}*/
		}
		else if($total==0)
		{
		  echo "<h5>Plz Enter a Correct Faculty ID or Password</h5>";
		}
	}
}