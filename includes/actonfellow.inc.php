<?php 
    session_start();  
    include_once 'dbh.inc.php';
?>
<?php
    
    include_once 'dbh.inc.php';

    $req_id = $_POST['req_id'];
    $actioner_id = $_SESSION['faculty_id'];
    $reason1 = $_POST['reason1'];
    $yes_no = $_POST['yes_no'];

    $sql = "CALL act_on_fellow('$req_id','$actioner_id','$reason1','$yes_no')";
    mysqli_query($conn, $sql);
    

    header("Location: ../index11.php?add_fellow=success");