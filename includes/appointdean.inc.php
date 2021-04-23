<?php

    session_start();
    include_once 'dbh.inc.php';

    $req_id = $_POST['req_id'];
    $exec_id = $_SESSION['faculty_id'];
    $dept1 = $_POST['dept1'];

    $sql = "CALL update_dean('$req_id','$exec_id','$dept1')";
    mysqli_query($conn, $sql);
    

    header("Location: ../generalpage.php?update_dean=success");