<?php 

session_start() ;

include_once 'includes/dbh.inc.php';

error_reporting(0) ;

?>

<!DOCTYPE html>
<html lang = "en">

<head>
    <title>Profiles</title>
	<link rel="stylesheet" type="text/css" href="index.css">  
</head>
<body>
<center>

    <form action="" method="POST">
		Enter the required faculty id: 
		<input class="w3-input" type="number" name ="FacultyID1" placeholder="Enter your Faculty ID">
		
		<br>
		<br>
		<button  class="w3-button w3-khaki" type="submit" name ="submit">View Page</button>
		<br>
		
	</form>


    <br><hr>
    <h2> Below are the name and ID of faculty</h2>
    <br>
    <?php

        $sql = "SELECT f.id, f.name FROM faculty f ;"; 
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

    ?>

    <table class="w3-table w3-striped w3-bordered" style="width: 50%; ">
    <tr>
        <th> Faculty ID </th>
        <th> Faculty Name </th>
        
        
        
    </tr>

    <?php
    if($resultCheck > 0)
    {
        while($row = mysqli_fetch_assoc($result)) 
        {
            ?>
            <tr>
            <?php
            foreach($row as $value) 
            {
                ?>
                <td><?php echo $value;?></td>
                <?php
            }
            ?>
            </tr>
            <?php
        }
    }
    ?>

    </table>


<?php

    if(isset($_POST['submit']))
    {

        $view_id = $_POST['FacultyID1'];
        


        if($view_id != "" )
        {
            $_SESSION['view_id'] = $view_id ;
            header('location:profileview.php') ;
            
            
        }
    }
?>


</center>
</body>

</html>