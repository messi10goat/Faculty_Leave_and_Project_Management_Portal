<?php
    
    include_once 'dbh.inc.php';

    $req_id = $_POST['req_id'];
    $exec_id = $_SESSION['faculty_id'];

    $sql = "CALL update_hod('$req_id','$exec_id')";
    mysqli_query($conn, $sql);
    

    header("Location: ../generalpage.php?hod_appointment=success");