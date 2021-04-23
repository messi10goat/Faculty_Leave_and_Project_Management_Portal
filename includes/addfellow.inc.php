<?php
    session_start();
    include_once 'dbh.inc.php';

    $req_id = $_POST['req_id'];
    $type1 = $_POST['type1'];
    $duration = $_POST['duration'];
    $aaction_by_id = $_SESSION['faculty_id'];
    $reason1 = $_POST['reason1'];

    $a;
    if($type1 == 1){
        $sql1 = "SELECT jrf_salary FROM project WHERE id = '$req_id';";
        $result1 = mysqli_query($conn, $sql1);
        $row = mysqli_fetch_assoc($result1);
        $a = $row['jrf_salary'];
    }

    else{
        $sql2 = "SELECT srf_salary FROM project WHERE id = '$req_id';";
        $result2 = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($result2);
        $a = $row['srf_salary'];
    }

    $total_cost = $duration * $a;
    $sql = "CALL add_fellow('$req_id','$total_cost','$aaction_by_id','$reason1')";
    mysqli_query($conn, $sql);
    

    header("Location: ../index13.php?act_on_fellow=success");