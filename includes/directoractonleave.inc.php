<?php
    
    include_once 'dbh.inc.php';

    $req_id = $_POST['req_id'];
    $yes_no = $_POST['yes_no'];
    $actioner_id = $_POST['actioner_id'];
    $coom = $_POST['coom'];

    $sql = "CALL act_on_leave('$req_id','$yes_no','$actioner_id','$coom')";
    mysqli_query($conn, $sql);
    

    header("Location: ../directorhome.php?Responded_to_leave_request=success");