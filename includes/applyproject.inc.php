<?php
    session_start();
    include_once 'dbh.inc.php';

    $project_name = $_POST['project_name'];
    $total_budget = $_POST['total_budget'];
    $funding_agency = $_POST['funding_agency'];
    $duration = $_POST['duration'];
    $req_id= $_SESSION['faculty_id'];
    $jrf_pay = $_POST['jrf_pay'];
    $srf_pay = $_POST['srf_pay'];

    $sql = "CALL apply_project('$project_name','$total_budget','$funding_agency','$duration','$req_id','$jrf_pay','$srf_pay')";
    mysqli_query($conn, $sql);
    

    header("Location: ../generalpage.php?Project_application=success");