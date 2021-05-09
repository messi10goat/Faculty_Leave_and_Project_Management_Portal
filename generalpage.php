<?php
include_once 'includes/dbh.inc.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply Leave</title>
    <link rel="stylesheet" type="text/css" href="index.css"> 
</head>
<body>
<div class="w3-panel ">

<right>
<p style="text-align: right; color: white;">
<?php echo date("Y-m-d h:i:sa");  ?>
</p>
</right>
<center>
<img src="https://upload.wikimedia.org/wikipedia/en/f/f9/Indian_Institute_of_Technology_Ropar_logo.png" alt="IIT Ropar" style="width:90px;height:90px;">

<h1>Home Page</h1>
<h3>Welcome, Faculty(your) Id:<b> <?php echo $_SESSION['faculty_id']; ?> </b></h3>
</center>
</div>

<hr>
<br>

<!--<p>Apply for Leave</p>-->
<form action="index1.php" method="POST">
    <center><button  class="w3-button w3-khaki" type="submit" name ="submit">Apply Leave</button></center>
    <br>
</form>




<!--<p>Act on Leave</p>-->
<?php
    if($_SESSION['designation'] == 1 OR $_SESSION['designation'] == 2 OR $_SESSION['designation'] ==3){
?>
    <br>
    <form action="index2.php" method="POST">
    <center><button  class="w3-button w3-khaki" type="submit" name ="submit">Act on leave</button></center>
    <br>
    </form>
<?php
    }
?>
<br>
<!--<p>Previously Applied leaves</p>-->
    <form action="index12.php" method="POST">
    <center><button  class="w3-button w3-khaki" type="submit" name ="submit">Previously Applied leaves</button></center>
    <br>
    </form>
    
    
<!--<p>Appoint Dean and Hod</p>-->
<?php
    if($_SESSION['designation'] == 3){
?>
    <br>
    <form action="index3.php" method="POST">
    <center><button  class="w3-button w3-khaki" type="submit" name ="submit">Appoint Dean</button></center>
    <br>
    </form>
    <br>
    <form action="index4.php" method="POST">
    <center><button  class="w3-button w3-khaki" type="submit" name ="submit">Appoint HoD</button></center>
    <br>
    </form>
<?php
    }
?>
<br>

    <!--start new project-->
    <form action="index5.php" method="POST">
    <center><button  class="w3-button w3-khaki" type="submit" name ="submit">Apply for project</button></center>
    <br>
    </form>

    <br>

    <!-- projects you're a part of'-->
    <form action="index13.php" method="POST">
    <center><button  class="w3-button w3-khaki" type="submit" name ="submit">Your Projects</button></center>
    </form>

    <br>

    <!-- approve expenditure req for Dean SP-->
    <?php
    $sql3 = "SELECT id FROM deans WHERE post=2;";
    $result = mysqli_query($conn, $sql3);
    $row = mysqli_fetch_assoc($result);
    $myid1 = $row['id'];

    if($myid1 == $_SESSION['faculty_id'] ){
        ?>
    <br>
    <form action="index11.php" method="POST">
    <center><button  class="w3-button w3-khaki" type="submit" name ="submit">Approve expenditure req. for Dean SP</button></center>
    </form>

        <?php } ?>

    <br>

    <br>
    <form action="profilepage.php" method="POST">
    <center>
        <button  class="w3-button w3-khaki" type="submit" name ="submit">View Profiles</button>
    </center>
    </form>
    <br><br>



</body>
</html>